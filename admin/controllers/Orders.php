<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once(COREPATH."controllers/Admin_controller.php");

class Orders extends Admin_Controller
{
	function __construct()
	{
		parent::__construct();

		$this->load->model('sales_order_model');
		$this->load->model('sales_order_item_model');

		$this->load->library('order_Manager');
		$this->load->library('email_Manager');
		$this->load->helper('form');
		$this->load->library('cart');

		$this->output->delete_cache();
	}

	public function index()
	{
		//JAVASCRIPTS
		$this->layout->add_javascripts(array('listing'));

		//LIBRARIES
		$this->load->library('listing');

		//SEARCH
		$this->simple_search_fields = array(
		                  'so_id' => 'Order ID',
		                  "shop" =>"Shop",
		                  "order_status" => "Order Status"
		                  );

		//ADVANCED SEARCh
		$this->_narrow_search_conditions = array("created_between", "order_status");

		//ACTION BUTTONS
		$str = '<a href="'.site_url('orders/view/{id}').'" class="btn btn btn-padding yellow table-action"><i class="fa fa-eye"></i></a>';    
		$this->listing->initialize(array('listing_action' => $str));

		$listing = $this->listing->get_listings('sales_order_model', 'listing');
		
		//If it is AJAX call, return only JSON data instead of HTML view. 
		if($this->input->is_ajax_request())
		{
		  $this->_ajax_output(array('listing' => $listing), TRUE);
		}

		$this->data['bulk_actions'] = array('' => 'select'/*, 'delete' => 'Delete'*/);
		$this->data['simple_search_fields'] = $this->simple_search_fields;
		$this->data['search_conditions'] = $this->session->userdata($this->namespace.'_search_conditions');
		$this->data['per_page'] = $this->listing->_get_per_page();
		$this->data['per_page_options'] = array_combine($this->listing->_get_per_page_options(), $this->listing->_get_per_page_options());
		$this->data['search_bar'] = $this->load->view('listing/search_bar', $this->data, TRUE);
		$this->data['listing'] = $listing;
		$this->data['grid'] = $this->load->view('listing/view', $this->data, TRUE);

		// orders count
		$this->data['status_count'] = $this->sales_order_model->get_orders_count_by_status();

		$this->layout->view('/pages/orders/index');
	}

	function view( $order_id )
	{
		$this->data['order_id'] = $order_id;

		$order_details = $this->sales_order_model->get_order_data( $order_id );
		// echo $this->db->last_query();
		// echo '<pre>';print_r($order_details);die;
		$this->data = array_merge($this->data, $order_details);

		$this->data['order_total'] 	= numberToCurrency( $order_details['total_amount'] );
		$this->data['order_date'] 	= strToDate($order_details['service_date'], 'd M Y');

		$this->data['sub_total'] = $order_details['total_amount']-$order_details['total_discount'];
		

		$this->data['order_items'] = $this->sales_order_item_model->get_order_items( $order_id );
		//echo $this->db->last_query();
		$order_status_list = array('PENDING' => 'PENDING', 'ACCEPTED' => 'ACCEPTED', 'COMPLETED' => 'COMPLETED', 'FAILED' => 'FAILED');
		$this->data['order_status_list'] = $order_status_list;

		//echo '<pre>';print_r($this->data);die;
		$this->layout->view('/pages/orders/view');
	}

	function add()
	{
		$this->cart->destroy();

		$fom_fields = array();
      	$edit_data = array();

		$form_fields[] = array(
		  'name' => 'type',
		  'id' => 'type',
		  'label' => 'Vehicle Type',
		  'value' => set_value('type',safe_value_isset($edit_data,'type')),
		  'options' => get_vehicles_type(),
		  'type' => 'selectdropdown',
		);

		$form_fields[] = array(
		  'name' => 'service_id',
		  'id' => 'service_id',
		  'label' => 'Service',
		  'value' => set_value('service_id',safe_value_isset($edit_data,'service_id')),
		  'options' => get_services(),
		  'type' => 'selectdropdown',
		);

		$form_fields[] = array(
		  'name' => 'vehicle_id',
		  'id' => 'vehicle_id',
		  'label' => 'Vehicle',
		  'value' => set_value('vehicle_id',safe_value_isset($edit_data,'vehicle_id')),
		  'options' => get_vehicles(array(),"name,id"),
		  'type' => 'selectdropdown',
		);

		$form_fields[] = array(
		  'name' => 'shop_id',
		  'id' => 'shop_id',
		  'label' => 'Shop',
		  'value' => set_value('shop_id',safe_value_isset($edit_data,'shop_id')),
		  'options' => array(),
		  'type' => 'selectdropdown',
		);

		$this->data['form_fields']= add_fields($form_fields);  

		$this->layout->view('/pages/orders/add');
	}

	function updateOrderStatus()
	{
		$data = array();
		$data['order_status'] = $_POST['status'];
        $data['payment_status'] = 'PAID';
		$where = array(); 
		$where['id'] = $_POST['id'];
		

		$this->sales_order_model->update($where, $data);

		if ($data['order_status'] === 'COMPLETED') {
			// send SMS and email
			$this->email_manager->send_order_complete_mail($_POST['id']);
		}

		$output = array();
		$output['status'] = 'success';

		echo json_encode($output);die;
	}
	
	public function create()
	{
		

		$cart = $this->cart->contents();

		$data = array(
		'user_id' => $this->input->post('user_id'),
		'shop_id' => $this->input->post('shop_id'),
		'vehicle_model' => $this->input->post('vehicle_model'),
		'vehicle_number' => $this->input->post('vehicle_number'),
		'message' => $this->input->post('message'),
		'amount' => $this->cart->total(),
		'discount' => 0,
		'tax' 	=> 0,
		'payment_type' => 'cash',
		'txn_id' => '',
        'service_date' => date('Y-m-d',strtotime($this->input->post('service_date')))
		);
        
        $new_user = $this->input->post('new_user');
        if( empty($data['user_id']) && !empty($new_user) ){
             $inser_data = array();
            $inser_data['id']   =  gen_uuid();
            $inser_data['name']   =  "";
            $inser_data['email']  =  "";
            $inser_data['phone']  =  $new_user;
            $inser_data['role'] = 'customer';
            $inser_data['language'] = 'eng';
            $inser_data['status'] = 'active';
            
            $this->users_model->insert($inser_data, 'users');
    
            $user_id = $inser_data['id'];
            $data['user_id'] = $user_id;
        }

		$so_id  = $this->order_manager->create_sales_order($cart, $data);

		$output = array('status' => 'SUCCESS');
		if( $so_id === FALSE )
		{
			$output = array('status' => 'ERROR');
			$output['message'] = $this->error_message;
		}
		else
		{
			$output['so_id'] = $so_id;
		}

		echo json_encode($output);die;
	}

	public function getShops(){
		$service_id = $this->input->post('service_id');
		$vehicle_id = $this->input->post('vehicle_id');

		$sql = "SELECT ss.id as item_id, ss.price,ss.discount, s.id, concat(s.name,'(',a.name,')') as shop_name  FROM shop_services  ss
					JOIN shops s ON(s.id=ss.shop_id) 
                    JOIN areas a ON(a.id=s.area_id) 
					WHERE ss.service_id='$service_id' AND ss.vehicle_id='$vehicle_id' ";
                    
        if( get_current_user_role() != 'admin' ){
          $sql .="AND s.owner_id = '".get_current_user_id()."' ";
        }
		//echo $sql;die;
		$resp = $this->db->query($sql);

		echo json_encode($resp->result_array());die;
	}

	public function addItemToCart(){
		$this->load->model('shop_services_model');
		try
		{
			$item_id 	= $this->input->post('item_id');
			$qty 		= 1 ;//$this->input->post('qty');

			$flag = true;
			$cart = $this->cart->contents();
			foreach ($cart as $rowid => $row) {
				if($row['id'] == $item_id) 
				{
					$flag = false;
				}
			}

			if(!$flag){
				throw new Exception("This service is already added.");				
			}

			if($item_id){
				$item_data = $this->shop_services_model->get_item_data($item_id);
			}
            
             $discount = $item_data['price']*($item_data['discount']/100);
             
			$data = array(
			'id'      => $item_id,
			'qty'     => $qty,
			'price'   => ($item_data['price']-$discount),
			'name'    => $item_data['service_name']
			);

			$this->cart->insert($data);

			$output = array('status' => 'SUCCESS');
			$output['cart_data'] = $this->cart->contents();
			
		}
		catch(Exception $e){
			$output['status'] = 'ERROR';
			$output['message'] = $e->getMessage();
		}

		echo json_encode($output);die;
		
	}

	public function removeItemFromCart(){
		$rowid 	= $this->input->post('rowid');
		$this->cart->remove($rowid);

		$output = array('status' => 'SUCCESS');
		$output['cart_data'] = $this->cart->contents();
		echo json_encode($output);die;
	}
    
    public function getLastestOrders(){
        
        $output = array('status'=>'SUCCESS');
        
        $orders =$this->sales_order_model->get_latest_order( $this->input->post('time'));
        $output['orders'] = $orders;
        
        echo json_encode($output);die;
    }
}