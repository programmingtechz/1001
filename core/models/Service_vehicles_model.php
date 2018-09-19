<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

require_once(COREPATH.'libraries/models/App_model.php');

class Service_vehicles_model extends App_model
{
  function __construct()
  {
    parent::__construct();
    $this->_table = 'service_vehicles';
  }
  
  function listing( $args = array())
  {  
    
    $this->_fields = "concat(v.name,' ( ',v.type,' ) ') as vehicle_name,service_vehicles.id";
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
          $this->db->like("v.name",$value);
        break;
        case 'created_time':
          $this->db->where( 'service_vehicles.created_time >=', date( 'Y-m-d H:i:s', strtotime( "$value 00:00:00" ) ) );
        break;

      }
    }
    $this->db->join('vehicles as v', 'v.id = service_vehicles.vehicle_id', 'left',false);
    $this->db->where( 'service_id',$service_id);
    
    
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