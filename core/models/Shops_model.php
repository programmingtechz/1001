<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

require_once(COREPATH.'libraries/models/App_model.php');

class shops_model extends App_model
{
  function __construct()
  {
    parent::__construct();
    $this->_table = 'shops';
  }
  
  function listing( $args = array())
  {  
    
    $this->_fields = "shops.id,shops.email,shops.name,start_day,end_day,start_time,end_time,experience,no_of_mechanics,shop_area,shops.phone,c.name as Country,s.name as State,ci.name as City,a.name as Area";
    //$this->db->where("is_frontend","yes");
    //$this->db->group_by('id');
   
    foreach ($this->criteria as $key => $value)
    {
      if( !is_array($value) && strcmp($value, '') === 0 ) continue;

      switch ($key)
      {
        case 'name':
        case 'email':
        case 'phone':
          $this->db->like("shops.".$key, $value);
        break;
        case 'created_time':
          $this->db->where( 'shops.created_time >=', date( 'Y-m-d H:i:s', strtotime( "$value 00:00:00" ) ) );
        break;

      }
    }
    $this->db->join('countries as c', 'c.id = shops.country_id', 'left',false);
    $this->db->join('states as s', 's.id = shops.state_id', 'left',false);
    $this->db->join('cities as ci', 'c.id = shops.city_id', 'left',false);
    $this->db->join('areas as a', 'a.id = shops.area_id', 'left',false);
    
     if( get_current_user_role() != 'admin' ){
        $this->db->where('shops.created_id',get_current_user_id());
    }
    
    return parent::listing();
  }

  function get_data($table_name = 'shops', $where = array(), $field_name = '*')
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
    $this->db->where("id",$id);
    return $this->db->get()->row_array();
  }


  
}
?>