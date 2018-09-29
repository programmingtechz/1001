<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Email_Manager
{

	private $_CI;
	
	private $_cc = array();
	private $_bcc = array();

	public function __construct()
	{
		$this->_CI = & get_instance();
		$this->_CI->error_message = '';

		$this->_CI->load->model('sales_order_model');
		$this->_CI->load->model('sales_order_item_model');
		
		
	}

	public function send_email($to, $toname, $from, $from_name, $subject, $message, $bcc = array(),$attachments = array(),$cc=array())
	{
		//$this->_CI->config->load('email_config');
	
		$this->_CI->load->library('email');
        
		$this->_CI->email->clear(TRUE);
        $config = array();
        $config['protocol'] = 'sendmail';
        $config['mailpath'] = '/usr/sbin/sendmail';
        $config['charset'] = 'iso-8859-1';
        $config['wordwrap'] = TRUE;
        $config['mailtype'] = 'html';
        $config['smtp_host'] = 'smtp.gmail.com';
        $config['smtp_user'] = 'incrediblepolishing@gmail.com';
        $config['smtp_pass'] = 'Inc@12345';
        $config['smtp_port'] = '587';

        
        $this->_CI->email->initialize($config);

        $this->_CI->email->set_priority(1);
		$this->_CI->email->set_newline("\r\n");
 
		$this->_CI->email->from($from,$from_name);
		$this->_CI->email->to($to);
		$this->_CI->email->cc( $cc );
		$this->_CI->email->bcc( $bcc);

		$this->_CI->email->subject($subject);
		$this->_CI->email->message($message);
		foreach ($attachments as $file)
			$this->_CI->email->attach($file);
		
		if ( ! $this->_CI->email->Send())
			return FALSE;
		
		return TRUE;
	}

	function send_order_mail($so_id = 0, $status = null)
	{
		$data = array();
		
		if(!$so_id)
			return FALSE;
		
		// $data['so_id'] = $so_id;

		//get sales_order details
		$this->_CI->load->model('sales_order_model');
		$this->_CI->load->model('sales_order_item_model');

		$order_details = $this->_CI->sales_order_model->get_order_data( $so_id );
			
		if(!count($order_details))
			return FALSE;

		$data = array_merge($data, $order_details);

		$data['order_total'] 	= numberToCurrency( $order_details['total_amount'] );
		$data['order_date'] 	= strToDate($order_details['created_time'], 'd M Y');

		$data['sub_total'] = $order_details['total_amount']-$order_details['total_discount'];

		$data['order_items'] = $this->_CI->sales_order_item_model->get_order_items( $so_id );

		$cart_total = 0;
		foreach($data['order_items'] as $order_item){
			$cart_total += ($order_item['quantity']*$order_item['unit_price']);
		}
		$data['cart_total'] = $cart_total;

		$data['message'] = $this->_CI->load->view('/email/order_confirmation', $data, TRUE);

		$message = $this->_CI->load->view('/system_email_template', $data, TRUE);
		
		$cc = get_admin_emails();
		$cc[] = $data['shop_email'];
          //  $cc = array();
		$customer_phone = $data['phone'];
		if ($customer_phone !== '') {
			// send mail to customer
			$smsmsg = "Dear Customer,\nYour Order ".$data['so_id']." created successfully. \nThank you,\nDakbro Team";
            
	        $sms = send_sms(array($customer_phone),$smsmsg);
		}		

		$shop_phone = $data['shop_phone'];
		if ($shop_phone !== '') {
	        // send mail to shop owner
			$smsmsg = "Hello,\n\nNew Order ".$data['so_id']."  has been created. \n\nThank you,\nDakbro Team";
            
	        $sms = send_sms(array($shop_phone),$smsmsg);
	    }

		$flag = $this->send_email($data['email'], $data['user_name'], 'support@dakbroincredible.com', 'DakBro incredible polishing studio', "DakBro - Invoice #".$data['so_id'], $message, $cc, array());

		
		return $flag;

	}

	function send_order_complete_mail($so_id = 0, $status = null)
	{
		$data = array();
		
		if(!$so_id)
			return FALSE;
		
		// $data['so_id'] = $so_id;

		//get sales_order details
		$this->_CI->load->model('sales_order_model');
		$this->_CI->load->model('sales_order_item_model');

		$order_details = $this->_CI->sales_order_model->get_order_data( $so_id );
			
		if(!count($order_details))
			return FALSE;

		$data = array_merge($data, $order_details);

		$data['order_total'] 	= numberToCurrency( $order_details['total_amount'] );
		$data['order_date'] 	= strToDate($order_details['created_time'], 'd M Y');

		$data['sub_total'] = $order_details['total_amount']-$order_details['total_discount'];

		$data['order_items'] = $this->_CI->sales_order_item_model->get_order_items( $so_id );

		$cart_total = 0;
		foreach($data['order_items'] as $order_item){
			$cart_total += ($order_item['quantity']*$order_item['unit_price']);
		}
		$data['cart_total'] = $cart_total;

		$data['message'] = $this->_CI->load->view('/email/order_completion', $data, TRUE);

		$message = $this->_CI->load->view('/system_email_template', $data, TRUE);
		
		$cc = get_admin_emails();
		$cc[] = $data['shop_email'];
        //$cc = array();
		$customer_phone = $data['phone'];
		if ($customer_phone !== '') {
			// send mail to customer
            $form_link = get_google_form_link($customer_phone,$data['so_id'],$data['shop_name']."(".$data['area_name'].")");
            
            $short_link = create_short_link($form_link);
            if( $short_link )
                $link = "Visit $short_link for feedback.\n";
            else 
             $link="";
			$smsmsg = "Dear Customer,\nYour vehicle service ".$data['so_id']." is completed. \n".$link."Thank you,\nDakbro Team";
			
	        $sms = send_sms(array($customer_phone),$smsmsg);
		}		

		$shop_phone = $data['shop_phone'];
		if ($shop_phone !== '') {
	        // send mail to shop owner
	        $smsmsg = "Hello,\nService ".$data['so_id']." is completed. \nThank you,\nDakbro Team";
            
	        $sms = send_sms(array($shop_phone),$smsmsg);
	    }

		$flag = $this->send_email($data['email'], $data['user_name'], 'support@dakbroincredible.com', 'DakBro incredible polishing studio', "DakBro - Invoice #".$data['so_id'], $message, $cc, array());

		
		return $flag;

	}
	
	
	
	 
}