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
    
    public function forgot()
    {
            
        $this->layout->view("login/forgot");
        
    }
    
    public function logout()
	{
	   
		$this->session->sess_destroy();
	
		  $this->session->set_flashdata('logout_success','logged out successfully');
	
		redirect('login');
	}
    
}
?>