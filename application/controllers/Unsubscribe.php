<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require_once(COREPATH."controllers/App_controller.php");

class Unsubscribe extends App_Controller {
    
  function __construct()
  {
    parent::__construct();
  }

  public function index( $email )
  {   
     $this->data['email'] = $email;
      $this->load->view('unsubscribe', $this->data);
  }
      
      
}
