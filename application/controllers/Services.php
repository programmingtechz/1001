<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require_once(COREPATH."controllers/App_controller.php");

class Services extends App_Controller {
    
  function __construct()
  {
    parent::__construct();
  }

  public function index()
  {   
      $this->data['header'] = $this->load->view('_partials/header', $this->data, TRUE);
      $this->data['footer'] = $this->load->view('_partials/footer', $this->data, TRUE);
      $this->layout->view('services');
  }
  
  public function detail($name =""){
    
    if( empty($name)) redirect('services');
    
    $service_data = get_services(array('name'=>trim(str_replace("-"," ",$name),"/")),'*',false);
    
    if( empty($service_data)) redirect('services');
    
    $this->data['service_data'] = $service_data[0];
    $this->data['header'] = $this->load->view('_partials/header', $this->data, TRUE);
    $this->data['footer'] = $this->load->view('_partials/footer', $this->data, TRUE);
    $this->layout->view('services/detail');
  }
      
      
}
