<?php

require_once(COREPATH."libraries/models/App_model.php");
class Api_model extends App_Model {
    
    
    function __construct()
    {
        parent::__construct();
       
    }
   
	function login($name = "",$password = "")
	{
		$where=array('username'=>$name,'password'=>md5($password));
		
		$this->db->select("id,first_name,last_name,company_name,active,office_phone,cell_phone,email1,address1,city,state,zip",FALSE);
		$this->db->from('contractor');
		$this->db->where($where);

		$user = $this->db->get()->row_array();

		return $user;
		
	}
    
}
?>
