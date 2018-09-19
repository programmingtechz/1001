<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class App_Controller extends CI_Controller
{
    public $logged_in                  = FALSE;
    public $error_message              =    '';
    public $data                       =    array();
    public $role                       =    0;
    public $init_scripts               = array();
    public $criteria                   = array(); 
    
   
    
    public function __construct()
    {
        parent::__construct(); 
    
    //print_r($this->session->userdata('user_data'));die;        

        //if($this->uri->segment(1,'')
        $this->load->library("form_validation");        
        
        $this->load->library("layout");
        
        
        $this->data['img_url']=$this->layout->get_img_dir();  

        $this->_init_layout();   
        
         $meta = get_page_meta();
      
        if( isset($meta['page_title'])){
            $this->layout->title = $meta['page_title'];
        }
        if( isset($meta['meta_key'])){
            $this->layout->set_meta('keywords',$meta['meta_key']);
        }
        if( isset($meta['meta_desc'])){
            $this->layout->set_meta('description',$meta['meta_desc']);
            $this->layout->set_meta('og:description',$meta['meta_desc']);
        }
        
        if( isset($meta['image'])){
        
        $meta_img = json_decode($meta['image'],true);
        if( isset($meta_img[0]['s3_url']))
            $this->layout->set_meta('og:image',"https://s3.amazonaws.com/".$meta_img[0]['s3_url']);
        } 

    }
    
    protected function _init_layout()
    {
        
        $this->layout->initialize($this->config->item('default', 'layout'));
               
    }



    public function index()
    {
       
    }
    
    public function _ajax_output($data, $json_format = FALSE)
    {
        if(is_array($data) && $json_format)
            echo json_encode($data);
        else 
            echo $data;
        
        exit();
    }
    
    
  
}

?>
