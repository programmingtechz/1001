<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

require_once(COREPATH.'libraries/models/App_model.php');

class Shop_services_model extends App_model
{
  function __construct()
  {
    parent::__construct();
    $this->_table = 'shop_services';
  }
  
  function listing( $args = array())
  {  
    
    $this->_fields = "s.name as service,v.name as vehicle, shop_services.*";
    //$this->db->where("is_frontend","yes");
    //$this->db->group_by('id');
    $shop_id = "";
    if( isset( $args['custom_query_args'] ) ){
        foreach( $args['custom_query_args'] as $k => $v ){
            
            if( $k == 'shop_id'){
                $shop_id = $args['custom_query_args'][$k];
            }
        }
    }
    
    foreach ($this->criteria as $key => $value)
    {
      if( !is_array($value) && strcmp($value, '') === 0 ) continue;

      switch ($key)
      {
        case 'name':
          $this->db->like("s.name",$value);
        break;
         case 'vehicle_name':
          $this->db->like("v.name",$value);
        break;
        case 'discount':
        case 'price':
          $this->db->where("shop_services.".$key." <=",(int) $value);
        break;
        case 'created_time':
          $this->db->where( 'shop_services.created_time >=', date( 'Y-m-d H:i:s', strtotime( "$value 00:00:00" ) ) );
        break;

      }
    }
     $this->db->join('services as s', 's.id = shop_services.service_id', 'left',false);
    $this->db->join('vehicles as v', 'v.id = shop_services.vehicle_id', 'left',false);
    $this->db->where( 'shop_id',$shop_id);
    
    
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

  function get_item_data($id = 0){

    $sql = "SELECT ss.*, CONCAT(s.name, ' - ',v.name) as service_name 
              FROM shop_services ss
              JOIN services s ON(s.id=ss.service_id) 
              JOIN vehicles v ON(v.id=ss.vehicle_id)
              WHERE ss.id='$id'
            ";

    $result = $this->db->query($sql);
    return $result->row_array();
  }

  function get_raw_data(){

    $sql = "SELECT ss.*, 
                  CONCAT(s.name, ' - ',v.name) as service_name,
                  shops.area_id
              FROM shop_services ss
              JOIN shops  ON(shops.id=ss.shop_id) 
              JOIN services s ON(s.id=ss.service_id) 
              JOIN vehicles v ON(v.id=ss.vehicle_id)
            ";

    $result = $this->db->query($sql);
    return $result->result_array();
  }
    
}
?>