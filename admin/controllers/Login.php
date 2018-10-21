<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once(COREPATH."controllers/Admin_controller.php");

class Login extends Admin_Controller 
{
    protected $_login_validation_rules =    array (
                                                    array('field' => 'email', 'label' => 'Email', 'rules' => 'trim|required|valid_email'),
                                                    array('field' => 'password', 'label' => 'Password', 'rules' => 'trim|required')
                                                  );
    function __construct()
    {
        parent::__construct();  
        
        $this->load->model('login_model');
        $this->load->library('email_Manager');
       
    }  
    public function index()
    {
        $this->layout->add_javascripts(array('plugins/iCheck/icheck.min'));
        //$this->layout->add_stylesheets(array('login'));
       
        $this->form_validation->set_rules($this->_login_validation_rules);
       
        if($this->form_validation->run())
        {
            $form = $this->input->post();

            if($this->login_model->login($form['email'], $form['password']))
            {
                $this->session->set_userdata('cache_id', gen_uuid());
                
                redirect("users");
            }else{

                $this->session->set_flashdata("login_fail1","Invalid Username or Password",TRUE);
            }
            
        }

        if(is_logged_in()) 
        {
            redirect("users");
        } 
        
        $this->layout->view("login/index");
        
    }
    
    public function forgot($status="",$id="",$time = "")
    {
        
        $this->load->library('encryption');
        $this->layout->add_javascripts(array('plugins/iCheck/icheck.min'));
        if(is_logged_in()) 
        {
            redirect("users");
        }
        
        if( $status && $id && $time ){
            $this->forgot_update($status,$id,$time);return;
        }
        $this->form_validation->set_rules(array (
                                                    array('field' => 'email', 'label' => 'Email', 'rules' => 'trim|required|valid_email')
                                                  ));
       
        if($this->form_validation->run())
        {
            $form = $this->input->post();
            $user_id = $this->login_model->check_email($form['email']);
            if( $user_id )
            {
                 $this->session->set_flashdata("success_msg","Reset Password link has been sent to your email id. Please check.",TRUE);
                 $message = $this->load->view('/email/resetpassword', array('link'=>md5($user_id).'/'.$this->encryption->encrypt(strtotime(date('Y-m-d h:i:s'))),'email'=>$form['email']), TRUE);
                 $this->email_manager->send_email($form['email'], $form['email'], 'support@dakbroincredible.com', 'DakBro incredible polishing studio', "DakBro - Reset password", $message, array(), array());
                redirect("login/forgot");
            }else{

                $this->session->set_flashdata("error_msg","Invalid Username",TRUE);
            }
            
        }
            
        $this->layout->view("login/forgot");
        
    }
    
    public function forgot_update($status="",$id="",$time=""){
      
        if( round((strtotime(date('Y-m-d h:i:s')) - $this->encryption->decrypt($time))/60, 1) > 60  ){
            redirect("login");die;
        }
        $email = $this->login_model->validate_forgot_email($id);
        
        if( !$email){
            redirect("login");
        }
           
        $this->form_validation->set_rules(array (
                                                     array('field' => 'password', 'label' => 'Password', 'rules' => 'trim|required'),
                                                      array('field' => 'confpassword', 'label' => 'Confirm Password', 'rules' => 'trim|required|matches[password]')
                                                  ));
       
        if($this->form_validation->run())
        {
            $form = $this->input->post();
         
            $user_id = $this->login_model->update_password($form['password']);
            if( $user_id )
            {
                 $this->session->set_flashdata("login_success","Password has been updated successfully.",TRUE);
                 $message = $this->load->view('/email/updatedpassword', array('link'=>md5($user_id),'email'=>$email), TRUE);
                 $this->email_manager->send_email($email, $email, 'support@dakbroincredible.com', 'DakBro incredible polishing studio', "DakBro - Admin password updated", $message, array(), array());
                redirect("login");
            }else{

                $this->session->set_flashdata("error_msg","Invalid Username",TRUE);
            }
            
        }
            
        $this->layout->view("login/forgot_update");
    }
    
    public function logout()
	{
	   
		$this->session->sess_destroy();
	
		  $this->session->set_flashdata('logout_success','logged out successfully');
	
		redirect('login');
	}
    
}
?>