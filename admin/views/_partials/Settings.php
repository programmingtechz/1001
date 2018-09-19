<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once(COREPATH."controllers/Admin_controller.php");

class Settings extends Admin_Controller
{
	protected $_settings_validation_rules = array (
                                    array('field' => 'address1', 'label' => 'Address 1', 'rules' => 'trim|required'),
                                    array('field' => 'address2', 'label' => 'Officer Name', 'rules' => 'trim'),
                                    array('field' => 'city', 'label' => 'City', 'rules' => 'trim|required'),
                                    array('field' => 'state', 'label' => 'State', 'rules' => 'trim|required'),
                                    array('field' => 'country', 'label' => 'Country', 'rules' => 'trim|required'),
                                    array('field' => 'zipcode', 'label' => 'Zipcode', 'rules' => 'trim|required|numeric'),
                                    array('field' => 'phone', 'label' => 'Phone', 'rules' => 'trim|required|numeric'),
                                    array('field' => 'email', 'label' => 'Email', 'rules' => 'trim|required|valid_email'),
                                    array('field' => 'facebook', 'label' => 'Facebook', 'rules' => 'trim'),
                                    array('field' => 'twitter', 'label' => 'Twitter', 'rules' => 'trim'),
                                    array('field' => 'google', 'label' => 'Google', 'rules' => 'trim'),);
  function __construct()
  {
    parent::__construct();
    
    if(!is_logged_in())
      redirect('login');

    $this->load->model('settings_model');
  }
  public function index($edit_id='')
  {
  	$this->db->query("CREATE TABLE `settings` (
  `id` int(11) NOT NULL,
  `address1` varchar(255) NOT NULL,
  `address2` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `zipcode` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `facebook_url` varchar(255) NOT NULL,
  `twitter_url` varchar(255) NOT NULL,
  `google_url` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
");
  	exit;
  	
  	$this->form_validation->set_rules($this->_settings_validation_rules);
  	$this->form_validation->set_error_delimiters('<span class="help-block">', '</span>');
    if($this->form_validation->run())
    {
    	$form = $this->input->post();
    	$edit_id  = $form['id'];
    	$ins['address1']  = $form['address1'];
    	$ins['address2']  = $form['address2'];
    	$ins['city']  = $form['city'];
    	$ins['state']  = $form['state'];
    	$ins['country']  = $form['country'];
    	$ins['zipcode']  = $form['zipcode'];
    	$ins['phone']  = $form['phone'];
    	$ins['email']  = $form['email'];
    	$ins['facebook_url']  = $form['facebook'];
    	$ins['twitter_url']  = $form['twitter'];
    	$ins['google_url']  = $form['google'];
    	if($edit_id!='')
    	{
    		$ins_id = $this->settings_model->update(array("id"=>$edit_id),$ins,"settings");
    		$this->session->set_flashdata("success_msg","Settings updated successfully");
    	}
    	else
    	{
    		$ins_id = $this->settings_model->insert($ins,"settings");
    		$this->session->set_flashdata("success_msg","Settings inserted successfully");
    	}
    	redirect('settings');
    }
  	$chk = $this->settings_model->select_single('','settings');
    if(!$chk)
  		$this->data['editdata'] = array("id"=>"","address1"=>"","address2"=>"","city"=>"","state"=>"","country"=>"","zipcode"=>"","email"=>"","phone"=>"","facebook"=>"","twitter"=>"","google"=>"");
  	else
  		$this->data['editdata'] = $chk;
  	$this->layout->view("frontend/settings");
  }
}?>