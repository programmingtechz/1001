<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require_once(COREPATH."controllers/App_controller.php");

class Login extends App_Controller {
    
  function __construct()
  {
    parent::__construct();
  }

  public function index()
  {   
      $output = array();
      $msg ='';
      
      $data = $this->security->xss_clean($this->input->post());
      if(empty($data)){
        die;
      }
      $phone_no = $data['phone_no'];
      if($this->session->userdata('logged_phone_no')) {
        
        if( $this->session->userdata($data['phone_no'].'count') && $this->session->userdata($data['phone_no'].'count') > 5 ){
            
            
            $starting_time = $this->session->userdata($data['phone_no'].'time');
        
           
            $current_time =strtotime(date('Y-m-d H:i:s'));
            
            $diff =  round(($current_time - $starting_time) / (60 * 60));
            
            if( $diff > 300 ){
                 $this->session->set_userdata($data['phone_no'].'time',strtotime(date('Y-m-d H:i:s')));
                 
            }else{
                $msg = 'You have attempted maximum login attempts. Please try again later.';
                $output['diff'] = $diff;
            }
            
        }else{
            $this->session->set_userdata($data['phone_no'].'count',$this->session->userdata($data['phone_no'].'count')+1);
        }        
      }
      else{
        $this->session->set_userdata($data['phone_no'].'time',strtotime(date('Y-m-d H:i:s')));
      }
      
      if( !empty($msg)){
        $output['status'] = 'error';
        $output['msg'] = $msg;  
          
      }else{
        
          $otp = rand ( 1000 , 9999 );
          $smsmsg = "Dear Customer,\n".$otp." is your one time password (OTP). Please enter the OTP to proceed.\n\nThank you,\nDakbro Team"; 
          //Dear Customer,\nYour Order ##orderno# created successfully.\n\nThank you,\nDakbro Team
          //Hello,\n\nNew Order %##orderno# has been created. \n\nThank you,\nDakbro Team
          $sms = send_sms(array($phone_no),$smsmsg);
          
          if( $sms ) {
            
            $this->session->set_userdata('logged_phone_no',$phone_no);
            $this->session->set_userdata('logged_phone_no_key',$otp);
            $output['status'] = 'success';
          }else{
             $output['status'] = 'error';
             $output['msg'] = 'Message sending failed. Please try again.';  
          } 
          
      }
      
      $this->_ajax_output($output, TRUE);
  }
  
  function verify(){
    
    $output = array();
    $success = true;
    
    if($this->session->userdata('logged_user_data')){
       $this->_ajax_output(array('status'=>'success','msg'=>'Already loggedin.'), TRUE); 
    }
    
    $data = $this->security->xss_clean($this->input->post());
    
    $phone_no = $data['phone_no'];
    
    if( $this->session->userdata('logged_phone_no') != $phone_no ){
        $success = false;
        $msg = 'Verification Failed.';
    }
    $logged_phone_no_key = "";
    
    foreach( $data['verify_data'] as $k => $v ){
        
        if( strpos($v['name'],'val-number') !== false ){
            $logged_phone_no_key .= $v['value'];
        }
    }
    
    if( $this->session->userdata('logged_phone_no_key') != $logged_phone_no_key ){
         $success = false;
         $msg = 'Verification Failed.';
    }
    if( $success) {
        $this->load->model('users_model');
        $user = $this->users_model->get_user_information_by_phone_no($phone_no);
        
        if( empty($user)) {
            
              $ins_data = array();
              $ins_data['id']      = gen_uuid();
              $ins_data['phone']      = $phone_no;
              $ins_data['role']      = 'customer';
              $ins_data['status']      = 'active';

              $user_id    = $this->users_model->insert(  $ins_data,  "users");
                
                
            $user = $this->users_model->get_user_information_by_phone_no($phone_no);
        }
       
        if( $user['user_status'] != 'active' ) {
            $success = false;
            $msg ='Your account blocked. Please contact support.';
            $output['status'] = 'error';
            $output['msg'] = $msg;
        }else{
            $this->session->unset_userdata($data['phone_no'].'time');
            $this->session->unset_userdata($data['phone_no'].'count');
            $output['status'] = 'success';
            $output['data'] = $user;
             $this->session->set_userdata('logged_user_data',$user);
        }
    }else{
        $output['status'] = 'error';
        $output['msg'] = $msg;
    }
    
    
    
    $this->_ajax_output($output, TRUE);
    
  }
  
  function logout(){
    //$this->session->sess_destroy();
    
    $this->session->unset_userdata('logged_user_data');
    $this->session->unset_userdata('logged_phone_no');
    $this->session->unset_userdata('logged_phone_no_key');
    
    redirect('home');
  }
  
   function custom_destroy(){
    $this->session->sess_destroy();
    
    redirect('home');
  }
      
      
}
