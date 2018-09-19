<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

require_once(COREPATH.'libraries/models/App_model.php');

class Holidays_model extends App_model
{
  function __construct()
  {
    parent::__construct();
    $this->_table = 'holidays';
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

  function get_holiday_by_timestamp($timestamp,$shop_id){
    
    $sql ="Select owner_id from shops where id='$shop_id'";
    $result = $this->db->query($sql);

    $shop =  $result->row_array();
    $id = (isset($shop['id']))?$shop['id']:"";
    
    if( empty($id)) return array();
    
    $sql = "SELECT *, DATE(FROM_UNIXTIME(h.date)) as formatted_date 
              FROM holidays WHERE created_id = '$id' AND DATE(FROM_UNIXTIME(h.date)) = DATE(FROM_UNIXTIME($timestamp))";
    
    $result = $this->db->query($sql);

    return $result->row_array();
  }


    
}
?>