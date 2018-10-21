<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require_once(COREPATH."controllers/App_controller.php");

class Contact extends App_Controller {
    
  function __construct()
  {
    parent::__construct();
  }

  public function index()
  {        
      $this->data['header'] = $this->load->view('_partials/header', $this->data, TRUE);
      $this->data['footer'] = $this->load->view('_partials/footer', $this->data, TRUE);
      $this->layout->view('contact');
  }
  
  public function add(){
    
    $output = array();
    $msg ='';
    $form_fields = array();
      
    $data = $this->security->xss_clean($this->input->post());
    
    if ( empty($data)){
        redirect(base_url().'404');die;
    }
    foreach( $data['data'] as $key => $val ){
        $form_fields[ $val['name'] ] = trim($val['value']);
    }
    
    $verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret=6LdSRU8UAAAAACsitx9xyiVAujKiDC91mpvygzL4&response='.$form_fields['g-recaptcha-response']);
    $responseData = json_decode($verifyResponse);
   
    if( !isset($form_fields['g-recaptcha-response']) || !$responseData->success ){
        $msg = "Invalid Request.";
    }
    else if( empty($form_fields['contact-form-name']) || empty($form_fields['contact-form-email']) || empty($form_fields['contact-form-phone']) || empty($form_fields['contact-form-message']) )
    {
       $msg = 'Please enter all required fields.'; 
    }
    else if( !validateEmail($form_fields['contact-form-email']) ){
         $msg = 'Please enter valid email.'; 
    }
    else if( !preg_match('/^\d{10}$/',$form_fields['contact-form-phone']) ){
         $msg = 'Please enter valid Phone number.'; 
    }
    
    if( !empty($msg)){
        $output['status'] = 'error';
        $output['msg'] = $msg;
    }else{
        $this->load->model('contact_model');
        $this->load->library('Email_Manager');
        
        $ins_data = array();
        $ins_data['id']      = gen_uuid();
        $ins_data['name'] = $form_fields['contact-form-name'];
        $ins_data['email'] = $form_fields['contact-form-email'];
        $ins_data['phone'] = $form_fields['contact-form-phone'];
        $ins_data['subject'] = "";
        $ins_data['comments'] = $form_fields['contact-form-message'];
        $ins_data['created_time'] = date("Y-m-d H:i:s");
        
       
        $flag = $this->email_manager->send_email('incrediblepolishing@gmail.com','Admin','support@dakbroincredible.com','Dakbro Incredible Polishing Studio', "DakBro - New Contact Info", $this->load->view('email/contact.php',array('data'=>$ins_data),TRUE), array(), array());
        if( $flag ){
             $this->contact_model->insert(  $ins_data,  "contact");
        }
        $output['status'] = 'success';
        $output['msg'] = "Your details submitted successfully. We will contact you as soon as possible.";
    }
    
    $this->_ajax_output($output, TRUE);
  }
      
      
}
