<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

require_once("App_controller.php");

class Admin_Controller extends App_Controller
{

    public $namespace;
    public $_search_conditions          = array("search_type", "search_text");
    public $_narrow_search_conditions   = array();
    public $_session_namespace;
    public $_session_narrow_namespace;
    public $previous_url                = '';

    protected $_logged_in_only         =    false;
    public $error_message              =    '';
    public $data                       =    array();
    public $role                       =    '';
    public $load_css                   =    array();
    public $load_js                    =    array();
    public $ins_data                   =    array();
    
    protected $useradd_validation_rules =    array();  
    protected $role_validation_rules    =    array();
    public $init_scripts = array();
    
    public function __construct()
    {
        parent::__construct(); 

        $this->namespace = strtolower($this->uri->segment(1, 'admin').'_'.$this->uri->segment(2, 'index'));
      
        $sess_keys = array_keys($this->session->all_userdata());
       
        /*unset session-data stored by using namespaces.But except the current controller-methos pair's data.
        There are list of methods if current method is one of those, dont unset the session.*/
        $current_method = $this->uri->segment(2, 'index');
        $methods_list = array('index');// these are the methods which are having grid-view
        if(in_array($current_method, $methods_list))
        {
            $keys = array('search_conditions','search_narrow_conditions','fields','per_page','order_field','direction');
            foreach ($sess_keys as $key => $value)
            {
                foreach ($keys as $key)
                {
                    $position1 = strpos($value, $key);
                    $position2 = strpos($value, $this->namespace);
                    if($position2 !== 0 && $position1 !== false && $position1 != 0)
                        $this->session->unset_userdata($value);
                }
            }
        }

        $this->data = array();
        //$this->role = get_user_role();
        
        $this->load->library("form_validation");

        if(!is_logged_in() && $this->router->fetch_class() !== 'login' )
        {
            redirect('login');
        }
        
        $allow_pages = array("home","shops","orders","holidays","login","dashboard");
        
        if( is_logged_in() && all_settings('user_role') != 'admin'  && !in_array($this->router->fetch_class(),$allow_pages)){
            
            
            if( $this->router->fetch_class() == 'users' &&  $this->router->fetch_method() == "add"){
                
            }else {
                
                redirect('orders');
            }
        }

    }
    
    
    public function _ajax_output($data, $json_format = FALSE)
    {
    	if(is_array($data) && $json_format)
        	echo json_encode($data);
    	else 
    		echo $data;
    	
        exit();
    }

    /**
     * This function returns the advance filter form.
     *@param string namespace <p>
     * It is the namespace of current grid-view page.
     * </p>
     * @return string HTML-Form.
     */
    function get_advance_filter_form( $namespace = '' )
    {
        //load pagination config
        $this->load->config("listing", TRUE);
        
        //get current grid's config by using namespace.
        $pagination = $this->config->item($namespace, 'listing');
        
        //print_r($pagination);die;
        //To populate the form, get the previous data if available in session.
        $this->data = $this->session->userdata($namespace.'_search_narrow_conditions');
        
        //now get the form
        $form = $this->load->view($pagination['advance_search_view'], $this->data, TRUE);
        
        if($this->input->is_ajax_request())
            $this->_ajax_output(array('advance_filter_form' => $form), TRUE);
        
        return TRUE;
    }
    
    
  
}

?>
