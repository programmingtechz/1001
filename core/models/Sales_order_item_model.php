<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

require_once(COREPATH.'libraries/models/App_model.php');

class Sales_order_item_model extends App_model
{
	function __construct()
	{
		parent::__construct();
		$this->_table = 'sales_order_item';
	}

	function get_order_items( $so_id = 0 )
	{
		$query = "SELECT 	soi.*,
							(soi.unit_price*soi.quantity) as sub_total,
							s.name as service_name
					FROM sales_order so
						JOIN sales_order_item soi ON(so.id=soi.sales_order_id) 
						JOIN shop_services ss ON(soi.service_id=ss.id) 
						JOIN services s ON(ss.service_id=s.id)
					WHERE so.id = '$so_id'
					";

		$result = $this->db->query($query);

		return $result->result_array();
	}


}