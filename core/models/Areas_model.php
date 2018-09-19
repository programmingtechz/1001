<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

require_once(COREPATH.'libraries/models/App_model.php');

class Areas_model extends App_model
{
  function __construct()
  {
    parent::__construct();
    $this->_table = 'areas';
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
        case 'code':
          $this->db->like($key, $value);
        break;
        case 'created_time':
          $this->db->where( 'areas.created_time >=', date( 'Y-m-d H:i:s', strtotime( "$value 00:00:00" ) ) );
        break;

      }
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