<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Order_Manager
{

	private $_CI;
	
	public $prices = array();
	public $sku_list = array(); 
	public $order_item_ids = array();
	public $shipping_costs = array();
	public $admin_id = 0;
	public $email_flag = FALSE;
	
	public function __construct($options = array())
	{
		$this->_CI = & get_instance();
		$this->_CI->error_message = '';
		foreach($options as $key => $value)
		{
			$this->_CI->$key = $value;
		}
		
		$user_data = get_user_data();
		if( $user_data['role'] == 'admin' ) 
		{
			$this->admin_id = $user_data['id'];
		}

		$this->_CI->load->model('sales_order_model');
		$this->_CI->load->model('sales_order_item_model');
		
		
	}

	function create_sales_order($cart = array(), $data = array())
	{
		try
		{
			//prepare required fields
			$required_fields = array(
									'user_id', 
									'shop_id',
									'amount',
									'discount',
									'tax',
									'payment_type',
									'txn_id'
									);


			//check if the inputs are valid
			if(!count($cart) || !count($data))
				throw new Exception("Invalid Input.");


			//check if all required fields are available
			if(!$this->check_required_fields($data, $required_fields))
				throw new Exception("Invalid Input.");

			if(!isset($data['vehicle_model'])) $data['vehicle_model'] = '';
			if(!isset($data['vehicle_number'])) $data['vehicle_number'] = '';
			if(!isset($data['message'])) $data['message'] = '';
			if(!isset($data['pickup'])) $data['pickup'] = '0';
			if(!isset($data['donate'])) $data['donate'] = '0';
			
			//get current loggedin user ( admin/user)
			$user_data = get_user_data();
			
			//prepare created id and time
			$created_id = 'system';
			if( is_array($user_data) && $user_data['role'] != 'admin' )  
			{
				$created_id = $user_data['id'];
			}
			$created_time = date('Y-m-d H:i:s');

			//Transaction starts here
			$this->_CI->db->trans_begin();

			$so_data = array(
								'id' 			=> gen_uuid(),
								'so_id'         => time(),
								'user_id' 		=> $data['user_id'],
			  					'shop_id' 		=> $data['shop_id'],
			  					'total_amount' 	=> $data['amount'],
			  					'total_discount' => $data['discount'],
			  					'total_tax' 	=> $data['tax'],
			  					'payment_type' 	=> $data['payment_type'],
			  					'txn_id' 		=> $data['txn_id'],
			  					'vehicle_model' => $data['vehicle_model'],
			  					'vehicle_number' => $data['vehicle_number'],
			  					'message'       => $data['message'],
			  					'pickup'       	=> $data['pickup'],
			  					'donate'       	=> $data['donate'],
			  					'created_id' 	=> $created_id,
								'updated_id' 	=> $created_id,
			  					'created_time' => $created_time
							);

			//now create sales order
			$this->_CI->sales_order_model->insert($so_data);


			foreach ($cart as $val)
			{
				$soi_data = array(
									'id' 		 => gen_uuid(),
									'service_id' => $val['id'],
									'unit_price' => $val['price'],
									'quantity'   => $val['qty'],
									'sales_order_id' => $so_data['id'],
									'created_id' => $created_id,
									'updated_id' => $created_id,
									'created_time' => $created_time
								);

				$this->_CI->sales_order_item_model->insert( $soi_data );
			}

			//now end the trnascation.
			if ($this->_CI->db->trans_status() === FALSE)
			{
				throw new Exception("Query failed.");
			}
			else
			{
				$this->_CI->db->trans_commit();
			}
	
			return $so_data['id'];


		}
		catch(Exception $e)
		{
			$this->_CI->db->trans_rollback();
			
			//set error message if the variable is available
			if(isset($this->_CI->error_message))
				$this->_CI->error_message = $e->getMessage();

			return FALSE;
		}
	}


	function check_required_fields($input = array(), $fields = array())
	{
		foreach ($fields as $value) {
			if(!isset($input[$value]))
				return false;
		}
	
		return true;
	}
	
	
	
	 
}