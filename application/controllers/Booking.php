<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require_once(COREPATH."controllers/App_controller.php");

class Booking extends App_Controller {
    
  function __construct()
  {
    parent::__construct();

    $this->load->model('shops_model');
    $this->load->model('shop_services_model');
    $this->load->model('vehicles_model');
    $this->load->model('services_model');
    $this->load->model('users_model');

    $this->load->model('sales_order_model');
    $this->load->model('sales_order_item_model');
    $this->load->library('cart');
    $this->load->library('order_Manager');
    $this->load->library('email_Manager');
    
  }

  public function index()
  {        
    $this->layout->add_javascripts(array('booking_manager'));
    $this->data['header'] = $this->load->view('_partials/header', $this->data, TRUE);
    $this->data['footer'] = $this->load->view('_partials/footer', $this->data, TRUE);

    $this->data['areas']  = get_areas();
    $this->data['shops']  = $this->shops_model->get_data()->result_array();
    $this->data['vehicles']  = $this->vehicles_model->get_data()->result_array();
    $this->data['services']  = $this->services_model->get_data()->result_array();
    $this->data['raw_data'] = $this->shop_services_model->get_raw_data();

    $user_data = array();
    $user_data['fname'] = '';
    $user_data['lname'] = '';
    $user_data['email'] = '';
    $user_data['phone'] = '';
    if ($this->session->userdata('logged_user_data')) {
      $tmp = $this->session->userdata('logged_user_data');
      $name = explode(' ', $tmp['user_name']);
      $user_data['fname'] = $name[0];
      $user_data['lname'] = (count($name)>1)?$name[1]:'';
      $user_data['email'] = $tmp['user_email'];;
      $user_data['phone'] = $tmp['phone'];;
    }
    
    $this->data['user_data'] = $user_data;

    $this->layout->view('booking');
  }

  public function confirmation($order_id, $print = ''){
    $this->data['print'] = TRUE;
    if ($print !== 'print') {
      $this->data['header'] = $this->load->view('_partials/header', $this->data, TRUE);
      $this->data['footer'] = $this->load->view('_partials/footer', $this->data, TRUE);
      $this->data['print'] = FALSE;
    }    

    $this->data['order_id'] = $order_id;

    $order_details = $this->sales_order_model->get_order_data( $order_id );
    //echo '<pre>';print_r($order_details);die;
    $this->data = array_merge($this->data, $order_details);

    $this->data['order_total']  = numberToCurrency( $order_details['total_amount'] );
    $this->data['order_date']   = strToDate($order_details['created_time'], 'd M Y');

    $this->data['sub_total'] = $order_details['total_amount']-$order_details['total_discount'];
    

    $this->data['order_items'] = $this->sales_order_item_model->get_order_items( $order_id );
    //echo $this->db->last_query();
    $order_status_list = array('PENDING' => 'PENDING', 'ACCEPTED' => 'ACCEPTED', 'COMPLETED' => 'COMPLETED', 'FAILED' => 'FAILED');
    $this->data['order_status_list'] = $order_status_list;

    
    

    $this->layout->view('booking/confirmation');
  }


  public function create(){
    //echo json_encode($this->input->post());
    $output = array('status' => 'success');
    try{

      //Order Info
      $order_info = $this->input->post('order_info');

      //Check booking date
      $timestamp = $this->input->post('booking_date');
      $is_holiday = $this->is_holiday($timestamp,$order_info['shop_id']);
      
      if($is_holiday !== FALSE){
        throw new Exception('Please change booking date: '.$is_holiday['reason']);        
      }

      
      if(!isset($order_info['sub_services'])) $order_info['sub_services'] = array();
      //Add Main Service
      $where = array('shop_id' => $order_info['shop_id'], 'vehicle_id' => $order_info['vehicle_id']);
      $where['service_id'] = $order_info['service_id'];
      $main_service_data = $this->shop_services_model->get_data('shop_services', $where, '*')->row_array();

      if(!count($main_service_data)){
        throw new Exception("Invalid Data.");        
      }

      if( $this->add_item_to_cart($main_service_data['id']) === FALSE ){
        throw new Exception("Invalid Data.");  
      }

      //Add Sub Service
      foreach($order_info['sub_services'] as $sub_service_id){
        $where = array('shop_id' => $order_info['shop_id'], 'vehicle_id' => $order_info['vehicle_id']);
        $where['service_id'] = $sub_service_id;
        $sub_service_data = $this->shop_services_model->get_data('shop_services', $where, '*')->row_array();
        
        if(!count($sub_service_data)){
          throw new Exception("Invalid Data.");        
        }

        if( $this->add_item_to_cart($sub_service_data['id']) === FALSE ){
          throw new Exception("Invalid Data.");  
        }
      }

      //Check user
      $name   = $this->input->post('name');
      $email  = $this->input->post('email');
      $phone  = $this->input->post('phone');

      $user_id = 0;
      $udata = $this->users_model->get_data('users', array('phone' => $phone), '*')->row_array();
      if(count($udata)){
        $user_id = $udata['id'];
      }
      else{
        $udata = $this->users_model->get_data('users', array('email' => $email), '*')->row_array();
        if(count($udata)){
          $user_id = $udata['id'];
        }
      }

      if(!$user_id){
        $inser_data = array();
        $inser_data['id']   =  gen_uuid();
        $inser_data['name']   =  $name;
        $inser_data['email']  =  $email;
        $inser_data['phone']  =  $phone;
        $inser_data['role'] = 'customer';
        $inser_data['language'] = 'eng';
        $inser_data['status'] = 'active';
        
        $this->users_model->insert($inser_data, 'users');

        $user_id = $inser_data['id'];
      }
     
      //Now Create Order

      $cart = $this->cart->contents();

      $data = array(
        'user_id' => $user_id,
        'shop_id' => $order_info['shop_id'],
        'amount' => $this->cart->total(),
        'discount' => 0,
        'tax'   => 0,
        'payment_type' => 'cash',
        'txn_id' => '',
        'message' => $this->input->post('message'),
        'vehicle_number' => $this->input->post('vehicle_number'),
        'vehicle_model' => $this->input->post('vehicle_model'),
        'service_date' => date('Y-m-d',$this->input->post('booking_date')),
        'pickup' => $this->input->post('pickup'),
        'donate' => $this->input->post('donate')
      );

      $so_id  = $this->order_manager->create_sales_order($cart, $data); 

      $user = $this->users_model->get_user_information_by_phone_no($phone);
      $this->session->set_userdata('logged_user_data',$user);
      $this->session->set_userdata('logged_phone_no',$phone);

      if( $so_id === FALSE ){
        throw new Exception($this->error_message);        
      }

      $output['so_id'] = $so_id;

      $this->cart->destroy();

      $this->email_manager->send_order_mail($so_id);


    }
    catch(Exception $e){
      $output['status'] = 'error';
      $output['message'] = $e->getMessage();
    }

    echo json_encode($output);
  }

  private function add_item_to_cart($item_id = 0){

    try{

      if(!$item_id){
        throw new Exception("ERROR");        
      }

      $item_data = $this->shop_services_model->get_item_data($item_id);

      if(!count($item_data)){
        throw new Exception("ERROR");        
      }

      $discount = $item_data['price']*($item_data['discount']/100);

      $data = array(
        'id'      => $item_id,
        'qty'     => 1,
        'price'   => ($item_data['price']-$discount),
        'name'    => $item_data['service_name']
      );

      $this->cart->insert($data);

      return TRUE;

    }
    catch(Exception $e){
      return FALSE;
    }
    
  }

  private function is_holiday($timestamp, $shop_id){
    
    $this->load->model('holidays_model');
    
    $data = $this->holidays_model->get_holiday_by_timestamp($timestamp,$shop_id);
    // echo $this->db->last_query();die;
    if(count($data)){
      return $data;
    }

    return FALSE;
  }
      
      
}
