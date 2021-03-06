<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once(COREPATH."controllers/Admin_controller.php");

class Testimonials extends Admin_Controller
{
  function __construct()
  {
    parent::__construct();
    
    $this->load->model('testimonials_model');
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
                      'name' => 'Name'
                      );

    //ADVANCED SEARCh
    $this->_narrow_search_conditions = array("created_time");

    //ACTION BUTTONS
    $str = '<a href="'.site_url('testimonials/add/{id}').'" class="btn btn btn-padding yellow table-action"><i class="fa fa-edit edit"></i></a><a href="javascript:void(0);" data-original-title="Remove" data-toggle="tooltip" data-placement="top" class="table-action btn-padding btn red" onclick="delete_record(\'testimonials/delete/{id}\',this);"><i class="fa fa-trash-o trash"></i></a>';    
    $this->listing->initialize(array('listing_action' => $str));

    $listing = $this->listing->get_listings('testimonials_model', 'listing');
    
    $this->data['btn'] = "<a href=".site_url('testimonials/add')." class='btn btn-primary'>Add New <i class='fa fa-plus'></i></a>";

    //If it is AJAX call, return only JSON data instead of HTML view. 
    if($this->input->is_ajax_request())
    {
      $this->_ajax_output(array('listing' => $listing), TRUE);
    }

    $this->data['bulk_actions'] = array('' => 'select', 'delete' => 'Delete','export' => 'Export');
    $this->data['simple_search_fields'] = $this->simple_search_fields;
    $this->data['search_conditions'] = $this->session->userdata($this->namespace.'_search_conditions');
    $this->data['per_page'] = $this->listing->_get_per_page();
    $this->data['per_page_options'] = array_combine($this->listing->_get_per_page_options(), $this->listing->_get_per_page_options());
    $this->data['search_bar'] = $this->load->view('listing/search_bar', $this->data, TRUE);
    $this->data['listing'] = $listing;
    $this->data['grid'] = $this->load->view('listing/view', $this->data, TRUE);

    $this->layout->view('/pages/testimonials/index');
  }


  function bulk_actions()
  {
     $bulk_all = $_POST['bulk_all'];
     $selected_ids = $_POST['op_select'];
     $action = $_POST['bulk_action'];
     
     switch( $action ){
        
        case 'delete':
        
            if( $bulk_all ){
               // $this->testimonials_model->empty_table();
                $this->testimonials_model->delete(array('1'=>'1'));
                
            }else {
                $delete_ids = array('id' => $selected_ids);
                $this->testimonials_model->delete($delete_ids);
            }
            
            $this->session->set_flashdata('success_msg','Deleted Successfuly.',TRUE);
            
            redirect('testimonials');
            
            break;
        case 'export':
            
            $this->load->dbutil();
            
             if( $bulk_all ){
                $selected_ids = array();
                
            }else {
                $selected_ids = array('id' => $selected_ids);
            }

            $query = $this->testimonials_model->get_where($selected_ids,'name,message');
            
            header('Content-Type: application/csv');
            header('Content-Disposition: attachment; filename="Testimonials.csv";');
            
            echo $this->dbutil->csv_from_result($query);

            break;
     }
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
          $this->form_validation->set_rules('message','message','trim|required');

          $this->form_validation->set_error_delimiters('<span class="help-block">', '</span>');
    
          if ($this->form_validation->run())
          {

              //seller contact details
              $ins_data = array();
              $ins_data['name']      = $this->input->post('name');
              $ins_data['message']      = $this->input->post('message');
              
              $ins_data = add_created_info($ins_data,$edit_id);
              $flash_msg_type = 'success_msg';
              
              if($edit_id)
              {
                $this->testimonials_model->update( array("id" => $edit_id), $ins_data  );
                $msg = 'Record updated successfully';
              }
              else
              { 
                $insert_id    = $this->testimonials_model->insert(  $ins_data,  "testimonials");
                
                $msg = 'Testimonials added successfully';
              }

              $this->session->set_flashdata($flash_msg_type,$msg,TRUE);
              redirect('testimonials');
          }
      }
      catch (Exception $e)
      {
        $this->data['status']   = 'error';
        $this->data['message']  = $e->getMessage();                
      }

      if($edit_id)
      {
        $edit_data =  $this->testimonials_model->get_where(array("id" => $edit_id))->row_array();;
      }
      
      $fom_fields = array();
      
     
      
      $form_fields[] = array(
          'name' => 'name',
          'id' => 'name',
          'label' => 'Name',
          'value' => set_value('name',safe_value_isset($edit_data,'name')),
          'type' => 'text',
          'attributes' => ' required maxlength="40" pattern="[a-zA-Z\s]+" ',
          'format' => 'Only Letters'
      );
      $form_fields[] = array(
          'name' => 'message',
          'id' => 'message',
          'label' => 'Message',
          'value' => set_value('message',safe_value_isset($edit_data,'message')),
          'type' => 'textarea',
          'attributes' => ' required  pattern="[a-zA-Z_0-9@\s&?\(\)#%]+" ',
          'format' => 'Ex: Excellent Service.'
      );
      $this->data['form_fields']= add_fields($form_fields);      
     
      $this->layout->view('pages/testimonials/add');
   }


  function delete($del_id)
  {

    $access_data = $this->testimonials_model->get_where(array("id"=>$del_id),'id')->row_array();     
  
    $output=array();
  
    if(count($access_data) > 0)
    {
      $this->testimonials_model->delete(array("id"=>$del_id));
      $output['message'] ="Record deleted successfuly.";
      $output['status']  = "success";
    }
    else
    {
      $output['message'] ="No record found.";
      $output['status']  = "error";
    }      
    
    $this->_ajax_output($output, TRUE);            
  }

}
?>