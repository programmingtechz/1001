<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

require_once(COREPATH.'libraries/models/App_model.php');

class Sales_order_model extends App_model
{
	function __construct()
	{
		parent::__construct();
		$this->_table = 'sales_order';
	}

	function listing( $args = array() )
	{  

		$this->_fields = "sales_order.*, shops.name as shop_name, shops.owner_id,areas.name as area";
		
		$this->db->join('shops', "sales_order.shop_id=shops.id", "left");
        $this->db->join('areas', "shops.area_id=areas.id", "left");
		//echo '<pre>';print_r($this->criteria);die;
		foreach ($this->criteria as $key => $value)
		{
			if( !is_array($value) && strcmp($value, '') === 0 ) continue;

			switch ($key)
			{
				case 'id':
					$this->db->where('sales_order.id', $value);
				break;
				case 'so_id':
					$this->db->where('sales_order.so_id', $value);
				break;
				case 'shop':
					$this->db->like('shops.name', $value);
				break;
				case 'created_between':
					
					$between = explode('-', $value);
					
					$start_date = date( 'Y-m-d H:i:s', strtotime( $between[0]." 00:00:00" ) );
					$end_date 	= date( 'Y-m-d H:i:s', strtotime( $between[1]." 23:59:59" ) );
					
					$this->db->where( 'sales_order.created_time >=',  $start_date);
					$this->db->where( 'sales_order.created_time <=',  $end_date);
				break;

				case 'order_status':
					$this->db->where('sales_order.order_status', $value);
				break;

			}
		}
        
        if( get_current_user_role() != 'admin' ){
            $this->db->where_in('shops.owner_id',get_current_user_id());
        }
        
       
		return parent::listing();
	}

	function get_order_data( $so_id = 0 )
	{
		$query = "SELECT so.*, 
							sh.name as shop_name,
							sh.phone as shop_phone, 
							sh.email as shop_email,
							a.name as area_name,
							u.name as user_name,
							u.email,
							u.phone
					FROM sales_order so
						JOIN shops sh ON(so.shop_id=sh.id) 
						JOIN users u ON(so.user_id=u.id) 
						JOIN areas a ON(a.id=sh.area_id) 
					WHERE so.id = '$so_id'
					";

		$result = $this->db->query($query);

		return $result->row_array();
	}

	function get_orders_count_by_status()
	{
		$query = "SELECT so.order_status, count(so.id) as count
					FROM sales_order so
						JOIN shops sh ON(so.shop_id=sh.id) 
						JOIN users u ON(so.user_id=u.id) 
						JOIN areas a ON(a.id=sh.area_id) 
						GROUP BY so.order_status
					";

		$result = $this->db->query($query)->result_array();

		$status_counts = array();

		foreach ($result as $row) {
			$status_counts[$row['order_status']] = $row['count'];
		}

		return $status_counts;
	}

	function get_orders_by_user( $user_id = 0 ,$start=0)
	{
		$query = "SELECT so.*, 
							sh.name as shop_name, 
							u.name as user_name,
							u.email,
							u.phone,
                            a.name as branch
					FROM sales_order so
						JOIN shops sh ON(so.shop_id=sh.id) 
						JOIN users u ON(so.user_id=u.id)
                        JOIN areas a ON(a.id=sh.area_id) 
					WHERE so.user_id = '$user_id'  
					ORDER BY so.so_id DESC LIMIT $start,20
					";

		$result = $this->db->query($query);

		return $result->result_array();
	}

	function get_total_orders_by_user( $user_id = 0 )
	{
		$query = "SELECT so.id
					FROM sales_order so
						JOIN shops sh ON(so.shop_id=sh.id) 
						JOIN users u ON(so.user_id=u.id)
                        JOIN areas a ON(a.id=sh.area_id) 
					WHERE so.user_id = '$user_id'  
					ORDER BY so.so_id DESC
					";

		$result = $this->db->query($query);

		return $result->num_rows();
	}
    
    function get_latest_order( $time ){
                
        $query = "SELECT so.id,so.so_id
					FROM sales_order so
						JOIN shops sh ON(so.shop_id=sh.id) WHERE 1=1  AND UNIX_TIMESTAMP( so.created_time ) >= $time ";
        if( get_current_user_role() != 'admin' ){
          $query .="AND sh.owner_id = '".get_current_user_id()."' ";
        }
        
        $query .="ORDER BY so.so_id DESC";

		$result = $this->db->query($query);

		return $result->result_array();
        
       
    }



	
}