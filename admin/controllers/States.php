<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once(COREPATH."controllers/Admin_controller.php");

class States extends Admin_Controller
{
  function __construct()
  {
    parent::__construct();
    
    $this->load->model('states_model');
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
                      "code" =>"Code"
                      );

    //ADVANCED SEARCh
    $this->_narrow_search_conditions = array("created_time");

    //ACTION BUTTONS
    $str = '<a href="'.site_url('states/add/{id}').'" class="btn btn btn-padding yellow table-action"><i class="fa fa-edit edit"></i></a><a href="javascript:void(0);" data-original-title="Remove" data-toggle="tooltip" data-placement="top" class="table-action btn-padding btn red" onclick="delete_record(\'states/delete/{id}\',this);"><i class="fa fa-trash-o trash"></i></a>';    
    $this->listing->initialize(array('listing_action' => $str));

    $listing = $this->listing->get_listings('states_model', 'listing');
    
    $this->data['btn'] = "<a href=".site_url('states/add')." class='btn btn-primary'>Add New <i class='fa fa-plus'></i></a>";

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

    $this->layout->view('/pages/states/index');
  }


  function bulk_actions()
  {
     $bulk_all = $_POST['bulk_all'];
     $selected_ids = $_POST['op_select'];
     $action = $_POST['bulk_action'];
     
     switch( $action ){
        
        case 'delete':
        
            if( $bulk_all ){
                //$this->states_model->empty_table();
                $this->states_model->delete(array('1'=>'1'));
                
            }else {
                $delete_ids = array('id' => $selected_ids);
                $this->states_model->delete($delete_ids);
            }
            
            $this->session->set_flashdata('success_msg','Deleted Successfuly.',TRUE);
            
            redirect('states');
            
            break;
        case 'export':
            
            $this->load->dbutil();
            
             if( $bulk_all ){
                $selected_ids = array();
                
            }else {
                $selected_ids = array('id' => $selected_ids);
            }

            $query = $this->states_model->get_where($selected_ids,'name, code');
            
            header('Content-Type: application/csv');
            header('Content-Disposition: attachment; filename="state.csv";');
            
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
              
              if( $this->states_model->get_where( $whr )->num_rows() ){
                $msg = 'State Code Already Exist for Selected Country';
                $flash_msg_type = 'error_msg';
              }
              else if($edit_id)
              {
                $this->states_model->update( array("id" => $edit_id), $ins_data  );
                $msg = 'Record updated successfully';
              }
              else
              { 
                $state_id    = $this->states_model->insert(  $ins_data,  "states");
                
                $msg = 'state added successfully';
              }

              $this->session->set_flashdata($flash_msg_type,$msg,TRUE);
              redirect('states');
          }
      }
      catch (Exception $e)
      {
        $this->data['status']   = 'error';
        $this->data['message']  = $e->getMessage();                
      }

      if($edit_id)
      {
        $edit_data =  $this->states_model->get_where(array("id" => $edit_id))->row_array();;
      }
      
      $fom_fields = array();
      
      $form_fields[] = array(
          'name' => 'country_id',
          'id' => 'country_id',
          'label' => 'Country',
          'value' => set_value('country_id',safe_value_isset($edit_data,'country_id')),
          'options' => get_countries(),
          'type' => 'selectdropdown',
      );
      
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
          'name' => 'code',
          'id' => 'code',
          'label' => 'Code',
          'value' => set_value('code',safe_value_isset($edit_data,'code')),
          'type' => 'text',
          'attributes' => ' required maxlength="5" pattern="[a-zA-Z]+" ',
          'format' => 'Ex: TN'
      );

      $this->data['form_fields']= add_fields($form_fields);      
     
      $this->layout->view('pages/states/add');
   }


  function delete($del_id)
  {

    $access_data = $this->states_model->get_where(array("id"=>$del_id),'id')->row_array();     
  
    $output=array();
  
    if(count($access_data) > 0)
    {
      $this->states_model->delete(array("id"=>$del_id));
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