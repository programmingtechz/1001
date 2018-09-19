<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

require_once(COREPATH.'libraries/models/App_model.php');

class Users_model extends App_model
{
  function __construct()
  {
    parent::__construct();
    $this->_table = 'users';
  }
  
  function listing( $args = array())
  {  
    
    $this->_fields = "users.id,users.email,users.name,users.phone,c.name as Country,s.name as State,ci.name as City,a.name as Area,users.status as Status ,users.image as profileImage,users.parent_id as ParentId,users.tz as Timezone,users.language as Language,users.role";
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
          $this->db->like($key, $value);
        break;
        case 'created_time':
          $this->db->where( 'users.created_time >=', date( 'Y-m-d H:i:s', strtotime( "$value 00:00:00" ) ) );
        break;

      }
    }
    $this->db->join('countries as c', 'c.id = users.country', 'left',false);
    $this->db->join('states as s', 's.id = users.state', 'left',false);
    $this->db->join('cities as ci', 'c.id = users.city', 'left',false);
    $this->db->join('areas as a', 'a.id = users.area', 'left',false);
    $this->db->where('users.role !=','admin');
    
    if( get_current_user_role() != 'admin' ){
        $this->db->where('users.created_id',get_current_user_id());
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
    $this->db->where("id",$id);
    return $this->db->get()->row_array();
  }

  function get_user_information_by_id($id){
    
    $this->db->select("users.status as user_status,users.phone,a.name as user_area,users.email as user_email,users.id as user_id,users.name as user_name,c.code as country_code,c.name as country_name, c.id as country_id,s.code as state_code,s.name as state_name, s.id as state_id,ci.code as citycode,ci.name as city_name, ci.id as city_id,users.status as user_status ,users.image as user_image,users.role as user_role,users.parent_id as user_parent_id,users.tz as user_tz,users.language as user_language",false);
    
    $this->db->from($this->_table);
    $this->db->where("users.id",$id);
    $this->db->join('countries as c', 'c.id = users.country', 'left',false);
    $this->db->join('states as s', 's.id = users.state', 'left',false);
    $this->db->join('cities as ci', 'ci.id = users.city', 'left',false);
    $this->db->join('areas as a', 'a.id = users.area', 'left',false);
    
    return $this->db->get()->row_array();
  }
  
  function get_user_information_by_phone_no($no){
    
    $this->db->select("users.status as user_status,users.phone,a.name as user_area,users.email as user_email,users.id as user_id,users.name as user_name,c.code as country_code,c.name as country_name, c.id as country_id,s.code as state_code,s.name as state_name, s.id as state_id,ci.code as citycode,ci.name as city_name, c.id as city_id,users.status as user_status ,users.image as user_image,users.role as user_role,users.parent_id as user_parent_id,users.tz as user_tz,users.language as user_language",false);
    
    $this->db->from($this->_table);
    $this->db->where("users.phone",$no,false);
    $this->db->join('countries as c', 'c.id = users.country', 'left',false);
    $this->db->join('states as s', 's.id = users.state', 'left',false);
    $this->db->join('cities as ci', 'c.id = users.city', 'left',false);
    $this->db->join('areas as a', 'a.id = users.area', 'left',false);
    
    return $this->db->get()->row_array();
  }
  
  function get_user_information($where){
    
    $this->db->select("users.id as Id,users.email as Email,users.phone as Phone,users.name as Name,c.name as Country,s.name as State,ci.name as City,a.name as Area,users.status as Status ,users.image as profileImage,users.parent_id as ParentId,users.tz as Timezone,users.language as Language,UCASE(REPLACE(users.role,'_',' ')) as Role",false);
    
    $this->db->from($this->_table);
	foreach ($where as $f => $v)
    {
    	if(is_array($v))
    		$this->db->where_in($f, $v);
    	else
    		$this->db->where($f, $v);
    };
    $this->db->join('countries as c', 'c.id = users.country', 'left',false);
    $this->db->join('states as s', 's.id = users.state', 'left',false);
    $this->db->join('cities as ci', 'c.id = users.city', 'left',false);
    $this->db->join('areas as a', 'a.id = users.area', 'left',false);
    
    return $this->db->get();
  }

  function get_uers_by_query($query = ''){
    $sql = "SELECT *, users.name as original_name, CONCAT(users.phone, ' ', users.name) as name FROM users 
              WHERE (phone like '%".$query."%' 
                OR email like '%".$query."%' 
                OR name like '%".$query."%') AND role = 'customer'
              ";

    $result = $this->db->query($sql);          
    return $result->result_array();
  }
    
  
}
?>