<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once(COREPATH."controllers/Admin_controller.php");

class dashboard extends Admin_Controller
{
  function __construct()
  {
    parent::__construct();
  }

  public function index()
  {
    //$this->output->enable_profiler(TRUE);
    
    $this->layout->view('/dashboard');
  }


  
}
?>