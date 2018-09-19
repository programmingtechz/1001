<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require_once(COREPATH."controllers/App_controller.php");

class Account extends App_Controller {
    
  function __construct()
  {
    
    parent::__construct();
    if( is_front_end_logged_in() == false ){
        redirect('home');
    }
    $this->load->model('sales_order_model');
    $this->load->model('sales_order_item_model');
  }

  public function index()
  {      
      redirect('account/my_orders/');
  }
  
  public function my_orders(){
     $this->load->library('pagination'); 
     $config['base_url'] = site_url('account/my_orders/page');
     $config['per_page'] = 20;
     $this->data['header'] = $this->load->view('_partials/header', $this->data, TRUE);
     $this->data['footer'] = $this->load->view('_partials/footer', $this->data, TRUE);

    $page =($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
    $this->data['user_data'] = $this->session->userdata('logged_user_data');
    $this->data['orders'] = $this->sales_order_model->get_orders_by_user($this->data['user_data']['user_id'],$page*$config['per_page']);
   
    $config['total_rows'] = $this->sales_order_model->get_total_orders_by_user($this->data['user_data']['user_id']);
    
    $config["full_tag_open"] = '<ul class="pagination">';
    $config["full_tag_close"] = '</ul>';	
    $config["first_link"] = "&laquo;";
    $config["first_tag_open"] = "<li>";
    $config["first_tag_close"] = "</li>";
    $config["last_link"] = "&raquo;";
    $config["last_tag_open"] = "<li>";
    $config["last_tag_close"] = "</li>";
    $config['next_link'] = '&gt;';
    $config['next_tag_open'] = '<li>';
    $config['next_tag_close'] = '<li>';
    $config['prev_link'] = '&lt;';
    $config['prev_tag_open'] = '<li>';
    $config['prev_tag_close'] = '<li>';
    $config['cur_tag_open'] = '<li class="active"><a href="#">';
    $config['cur_tag_close'] = '</a></li>';
    $config['num_tag_open'] = '<li>';
    $config['num_tag_close'] = '</li>';
    $this->pagination->initialize($config);
    $this->data['pagination']= $this->pagination->create_links();
    //echo '<pre>';print_r($this->data['orders']);

    $this->layout->view('orders/list');
  }

  public function order_view($order_id){
    $this->data['header'] = $this->load->view('_partials/header', $this->data, TRUE);
    $this->data['footer'] = $this->load->view('_partials/footer', $this->data, TRUE);

    $this->data['order_id'] = $order_id;

    $order_details = $this->sales_order_model->get_order_data( $order_id );
    // echo '<pre>';print_r($order_details);die;
    $this->data = array_merge($this->data, $order_details);

    $this->data['order_total']  = numberToCurrency( $order_details['total_amount'] );
    $this->data['order_date']   = strToDate($order_details['created_time'], 'd M Y');

    $this->data['sub_total'] = $order_details['total_amount']-$order_details['total_discount'];
    

    $this->data['order_items'] = $this->sales_order_item_model->get_order_items( $order_id );
    //echo $this->db->last_query();
    $order_status_list = array('PENDING' => 'PENDING', 'ACCEPTED' => 'ACCEPTED', 'COMPLETED' => 'COMPLETED', 'FAILED' => 'FAILED');
    $this->data['order_status_list'] = $order_status_list;

    
    

    $this->layout->view('orders/view');
  }
  
   public function profile(){
    
    $this->data['header'] = $this->load->view('_partials/header', $this->data, TRUE);
    $this->data['footer'] = $this->load->view('_partials/footer', $this->data, TRUE);
   
   
     try
      {
        
          $edit_data = array(); 
          $logged_in_user_data = is_front_end_logged_in();
          
          if(empty($logged_in_user_data)) redirect('home');
          
          $this->load->model('users_model');
          $edit_id = $logged_in_user_data['user_id'];
          
          $this->form_validation->set_rules('name','Name','trim|required');
          $this->form_validation->set_rules('email','Email','trim|required');

          $this->form_validation->set_error_delimiters('<span class="help-block">', '</span>');
    
          if ($this->form_validation->run())
          {

              //seller contact details
              $ins_data = array();
              $ins_data['name']      = $this->input->post('name');
              $ins_data['email']      = $this->input->post('email');
              $ins_data['city']      = $this->input->post('city');
              $ins_data['state']      = $this->input->post('state');
              $ins_data['area']      = "";//$this->input->post('area');
              $ins_data['language']      = $this->input->post('language');
              $ins_data['tz']      = "Asia/Kolkata";///$this->input->post('tz');
             
              
              //$ins_data = add_created_info($ins_data,$edit_id);
              
              if( $this->users_model->get_where( array("email" => $ins_data['email'],'id!=' => $edit_id ))->num_rows() ) {
                $msg = 'Email Already Exist';
                $flash_msg_type = 'error_msg';
              }
              else if($edit_id)
              {
                $this->users_model->update( array("id" => $edit_id), $ins_data  );
                $msg = 'Profile updated successfully';
                 $flash_msg_type='success_msg';
              }

              $this->session->set_flashdata($flash_msg_type,$msg,TRUE);
          }
      }
      catch (Exception $e)
      {
        $this->data['status']   = 'error';
        $this->data['message']  = $e->getMessage();                
      }

      if($edit_id)
      {
        $edit_data =  $this->users_model->get_where(array("id" => $edit_id))->row_array();;
      }
      
      $fom_fields = array();
      
      $form_fields[] = array(
          'name' => 'name',
          'id' => 'name',
          'label' => 'Name',
          'value' => set_value('name',safe_value_isset($edit_data,'name')),
          'type' => 'text',
          'attributes' => ' required maxlength="40" pattern="[a-zA-Z\s]+" ',
          'format' => 'Only Letters'
      );
      
      $form_fields[] = array(
          'name' => 'email',
          'id' => 'email',
          'label' => 'Email',
          'value' => set_value('email',safe_value_isset($edit_data,'email')),
          'type' => 'email',
          'attributes' => ' required maxlength="50" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" ',
          'format' => 'Ex:info@dakbro.com'
      );
      
      
      $form_fields[] = array(
          'name' => 'phone',
          'id' => 'phone',
          'label' => 'phone Number',
          'value' => set_value('phone',safe_value_isset($edit_data,'phone')),
          'type' => 'tel',
          'attributes' => ' disabled=disabled required maxlength="10" pattern="^\d{10}$" ',
          'format' => 'Ex:9176599630'
      );
      
      $form_fields[] = array(
          'name' => 'state',
          'id' => 'state',
          'label' => 'State',
          'value' => set_value('state',safe_value_isset($edit_data,'state')),
          'options' => get_states(),
          'type' => 'selectdropdown',
          'class' =>'form-control'
      );
      
      $form_fields[] = array(
          'name' => 'city',
          'id' => 'city',
          'label' => 'City',
          'value' => set_value('city',safe_value_isset($edit_data,'city')),
          'options' => get_cities(),
          'type' => 'selectdropdown',
          'class' =>'form-control'
      );
      
     /* $form_fields[] = array(
          'name' => 'area',
          'id' => 'area',
          'label' => 'Area',
          'value' => set_value('area',safe_value_isset($edit_data,'area')),
          'options' => get_areas(),
          'type' => 'selectdropdown',
          'class' =>'form-control'
      );*/
      
     /* $form_fields[] = array(
          'name' => 'tz',
          'id' => 'tz',
          'label' => 'Timezone',
          'value' => set_value('tz',safe_value_isset($edit_data,'tz')),
          'options' => get_tz(),
          'type' => 'selectdropdown',
          'class' =>'form-control'
      );*/
    

      $this->data['form_fields']= add_fields($form_fields);      
     
      $this->layout->view('profile');
   }
      
      
}
