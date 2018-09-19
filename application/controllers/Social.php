<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require_once(COREPATH."controllers/App_controller.php");

class Social extends App_Controller {
    
  function __construct()
  {
    parent::__construct();
  }

  public function index()
  {        
      $this->data['header'] = $this->load->view('_partials/header', $this->data, TRUE);
      $this->data['footer'] = $this->load->view('_partials/footer', $this->data, TRUE);
      $this->layout->view('social-activities');
  }
      
      
}
