<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Login_Model extends CI_Model
{
   
   function __construct()
   {
     parent::__construct();
   }
   public function login($email, $password)
   {

     $pass = md5($password);
     
        $this->db->select("*");
        $this->db->from('users');
        $this->db->where('email', $email);
        $this->db->where('password', $pass);

        $user = $this->db->get()->row_array();
     
      if(count($user)>0)
      {      
        $this->session->set_userdata('user_data', $user);
        
        return TRUE;
      }
      
      return FALSE;
   }
   
   public function logout()
   {
        $this->session->sess_destroy();
   }
    
}

?>