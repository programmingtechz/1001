<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

require_once(COREPATH.'libraries/models/App_model.php');

class Services_model extends App_model
{
  function __construct()
  {
    parent::__construct();
    $this->_table = 'services';
  }
  
  function listing( $args = array() )
  {  
    
    $this->_fields = "*";
    //$this->db->where("is_frontend","yes");
    //$this->db->group_by('id');
   
    $service_id = "";

    if( isset( $args['custom_query_args'] ) ){
        foreach( $args['custom_query_args'] as $k => $v ){
            
            if( $k == 'service_id'){
                $service_id = $args['custom_query_args'][$k];
            }
        }
    }
    
    foreach ($this->criteria as $key => $value)
    {
      if( !is_array($value) && strcmp($value, '') === 0 ) continue;

      switch ($key)
      {
        case 'name':
        case 'type':
          $this->db->like($key, $value);
        break;
        case 'created_time':
          $this->db->where( 'services.created_time >=', date( 'Y-m-d H:i:s', strtotime( "$value 00:00:00" ) ) );
        break;

      }
    }

    if( $service_id )
        $this->db->where( 'parent_id',$service_id);
    else
        $this->db->where( 'parent_id',0);
        
   
        
    return parent::listing();
  }

  function get_data($table_name = 'services', $where = array(), $field_name = '*')
  { 
    
    if(count($where))
    {
      if($field_name!='')
        $this->db->select($field_name); 
     
      $this->db->order_by('order_no', 'ASC');

      $result = $this->db->get_where($table_name,$where);
    }
    else
    {
      if($field_name!='')
        $this->db->select($field_name); 

      $this->db->order_by('order_no', 'ASC');
      
      $result = $this->db->get($table_name);
    }
    return $result;
  }
  
  function check_unique($id)
  {
    $this->db->select("*");
    $this->db->from($this->_table);
    $this->db->where("id", $id );
    
    return $this->db->get()->row_array();
    
  }
    
}
?>