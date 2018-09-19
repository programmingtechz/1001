<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once(COREPATH."controllers/Admin_controller.php");

class contact extends Admin_Controller
{
  function __construct()
  {
    parent::__construct();
    
    $this->load->model('contact_model');
  }

  public function index()
  {
    //$this->output->enable_profiler(TRUE);
    
    //JAVASCRIPTS
    $this->layout->add_javascripts(array('listing'));

    //LIBRARIES
    $this->load->library('listing');

    //SEARCH
    $this->simple_search_fields = array(
                      'name' => 'Name',
                      "email" =>"Email",
                      'subject' => 'Subject',
                      );

    //ADVANCED SEARCh
    $this->_narrow_search_conditions = array("created_time");

    //ACTION BUTTONS
    $str = '<a href="'.site_url('contact/view/{id}').'" class="btn btn btn-padding yellow table-action"><i class="fa fa-eye "></i>View</a>';    
    $this->listing->initialize(array('listing_action' => $str));

    $listing = $this->listing->get_listings('contact_model', 'listing');
    
    $this->data['btn'] = "";

    //If it is AJAX call, return only JSON data instead of HTML view. 
    if($this->input->is_ajax_request())
    {
      $this->_ajax_output(array('listing' => $listing), TRUE);
    }

    $this->data['bulk_actions'] = array('' => 'select','export' => 'Export');
    $this->data['simple_search_fields'] = $this->simple_search_fields;
    $this->data['search_conditions'] = $this->session->userdata($this->namespace.'_search_conditions');
    $this->data['per_page'] = $this->listing->_get_per_page();
    $this->data['per_page_options'] = array_combine($this->listing->_get_per_page_options(), $this->listing->_get_per_page_options());
    $this->data['search_bar'] = $this->load->view('listing/search_bar', $this->data, TRUE);
    $this->data['listing'] = $listing;
    $this->data['grid'] = $this->load->view('listing/view', $this->data, TRUE);

    $this->layout->view('/pages/contact/index');
  }


  function bulk_actions()
  {
     $bulk_all = $_POST['bulk_all'];
     $selected_ids = $_POST['op_select'];
     $action = $_POST['bulk_action'];
     
     switch( $action ){
        
    
        case 'export':
            
            $this->load->dbutil();
            
             if( $bulk_all ){
                $selected_ids = array();
                
            }else {
                $selected_ids = array('id' => $selected_ids);
            }

            $query = $this->contact_model->get_where($selected_ids,'name, email,phone,subject,comments,created_time');
            
            header('Content-Type: application/csv');
            header('Content-Disposition: attachment; filename="contact.csv";');
            
            echo $this->dbutil->csv_from_result($query);

            break;
     }
  }
  
  function view($id ='') {
    
    
      if($id)
      {
        $data =  $this->contact_model->get_where(array("id" => $id))->row_array();;
      }
      
     $this->data['data']= $data;
     $this->layout->view('/pages/contact/view');
  }

  function add($edit_id ='')
    {
    
     try
      {
          $edit_data = array();
          if($this->input->post('edit_id'))
          {
            $edit_id = $this->input->post('edit_id');
          }   
          
          $this->form_validation->set_rules('name','Name','trim|required');
          $this->form_validation->set_rules('code','Code','trim|required');
    
          $this->form_validation->set_error_delimiters('<span class="help-block">', '</span>');
    
          if ($this->form_validation->run())
          {
    
              //seller contact details
              $ins_data = array();
              $ins_data['name']      = $this->input->post('name');
              $ins_data['code']      = $this->input->post('code');
              $ins_data['country_id']      = $this->input->post('country_id');
              
              $ins_data = add_created_info($ins_data,$edit_id);
              $flash_msg_type = 'success_msg';
              
              $whr = array("code" => $ins_data['code'],"country_id" => $ins_data['country_id']);
              
              if($edit_id){
                $whr['id!='] = $edit_id;
              }
              
              if( $this->contact_model->get_where( $whr )->num_rows() ){
                $msg = 'State Code Already Exist for Selected Country';
                $flash_msg_type = 'error_msg';
              }
              else if($edit_id)
              {
                $this->contact_model->update( array("id" => $edit_id), $ins_data  );
                $msg = 'Record updated successfully';
              }
              else
              { 
                $state_id    = $this->contact_model->insert(  $ins_data,  "contact");
                
                $msg = 'Submittd successfully. We will get back to you soon!!!';
              }
    
              $this->session->set_flashdata($flash_msg_type,$msg,TRUE);
              redirect('contact');
          }
      }
      catch (Exception $e)
      {
        $this->data['status']   = 'error';
        $this->data['message']  = $e->getMessage();                
      }
    }

}
?>