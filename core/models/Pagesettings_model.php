<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

require_once(COREPATH.'libraries/models/App_model.php');

class Pagesettings_model extends App_model
{
  function __construct()
  {
    parent::__construct();
    $this->_table = 'page_settings';
  }
  
  function listing( $args = array() )
  {  
    
    $this->_fields = "*";
    //$this->db->where("is_frontend","yes");
    //$this->db->group_by('id');
   
    
    foreach ($this->criteria as $key => $value)
    {
      if( !is_array($value) && strcmp($value, '') === 0 ) continue;

      switch ($key)
      {
        case 'name':
          $this->db->like($key, $value);
        break;
        case 'created_time':
          $this->db->where( 'page_settings.created_time >=', date( 'Y-m-d H:i:s', strtotime( "$value 00:00:00" ) ) );
        break;

      }
    }
    $order_key = $this->uri->segment(4);
    $order_type =  $this->uri->segment(5);
    
    if( $order_type &&  $order_key){
        $this->db->order_by($order_key,$order_type);
    }
    return parent::listing();
  }

  function get_data($table_name,$where,$field_name)
  { 
    
    if(count($where))
    {
      if($field_name!='')
        $this->db->select($field_name); 
          
      $result = $this->db->get_where($table_name,$where);
    }
    else
    {
      if($field_name!='')
        $this->db->select($field_name); 

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