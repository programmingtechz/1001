<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

require_once(COREPATH.'libraries/models/App_model.php');

class Gallery_images_model extends App_model
{
  function __construct()
  {
    parent::__construct();
    $this->_table = 'gallery_images';
  }
  
  function listing( $args = array())
  {  
    
    $this->_fields = "*";
    //$this->db->where("is_frontend","yes");
    //$this->db->group_by('id');
    $gallery_id = "";
    if( isset( $args['custom_query_args'] ) ){
        foreach( $args['custom_query_args'] as $k => $v ){
            
            if( $k == 'gallery_id'){
                $gallery_id = $args['custom_query_args'][$k];
            }
        }
    }
    
    foreach ($this->criteria as $key => $value)
    {
      if( !is_array($value) && strcmp($value, '') === 0 ) continue;

      switch ($key)
      {
        case 'title':
        case 'description':
          $this->db->like($key, $value);
        break;
        case 'created_time':
          $this->db->where( 'gallery_images.created_time >=', date( 'Y-m-d H:i:s', strtotime( "$value 00:00:00" ) ) );
        break;

      }
    }
    $this->db->where( 'gallery_id',$gallery_id);
  
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