<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once(COREPATH."controllers/Admin_controller.php");

class Pagesettings extends Admin_Controller
{
  function __construct()
  {
    parent::__construct();
    
    $this->load->model('pagesettings_model');
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
    $str = '<a href="'.site_url('pagesettings/add/{id}').'" class="btn btn btn-padding yellow table-action"><i class="fa fa-edit edit"></i></a><a href="javascript:void(0);" data-original-title="Remove" data-toggle="tooltip" data-placement="top" class="table-action btn-padding btn red" onclick="delete_record(\'pagesettings/delete/{id}\',this);"><i class="fa fa-trash-o trash"></i></a>';    
    $this->listing->initialize(array('listing_action' => $str));

    $listing = $this->listing->get_listings('pagesettings_model', 'listing');
    
    $this->data['btn'] = "<a href=".site_url('pagesettings/add')." class='btn btn-primary'>Add New <i class='fa fa-plus'></i></a>";

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

    $this->layout->view('/pages/pagesettings/index');
  }


  function bulk_actions()
  {
     $bulk_all = $_POST['bulk_all'];
     $selected_ids = $_POST['op_select'];
     $action = $_POST['bulk_action'];
     
     switch( $action ){
        
        case 'delete':
        
            if( $bulk_all ){
                //$this->pagesettings_model->empty_table();
                $this->pagesettings_model->delete(array('1'=>'1'));
                
            }else {
                $delete_ids = array('id' => $selected_ids);
                $this->pagesettings_model->delete($delete_ids);
            }
            
            $this->session->set_flashdata('success_msg','Deleted Successfuly.',TRUE);
            
            redirect('pagesettings');
            
            break;
        case 'export':
            
            $this->load->dbutil();
            
             if( $bulk_all ){
                $selected_ids = array();
                
            }else {
                $selected_ids = array('id' => $selected_ids);
            }

            $query = $this->pagesettings_model->get_where($selected_ids,'name, page_title as Page Title , meta_key as Meta Key, meta_desc as Meta Description');
            
            header('Content-Type: application/csv');
            header('Content-Disposition: attachment; filename="page-settings.csv";');
            
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
          $this->form_validation->set_rules('page_title','page Title','trim|required');
          $this->form_validation->set_rules('meta_key','Meta Key','trim|required');
          $this->form_validation->set_rules('meta_desc','Meta Description','trim|required');

          $this->form_validation->set_error_delimiters('<span class="help-block">', '</span>');
    
          if ($this->form_validation->run())
          {

              //seller contact details
              $ins_data = array();
              $ins_data['name']      = $this->input->post('name');
              $ins_data['page_title']      = $this->input->post('page_title');
              $ins_data['meta_key']      = $this->input->post('meta_key');
              $ins_data['meta_desc']      = $this->input->post('meta_desc');
              $ins_data['image']      = $this->input->post('image');
              
              $ins_data = add_created_info($ins_data,$edit_id);
              $flash_msg_type = 'success_msg';
              
              $where = array("name" => $ins_data['name']);
              
              if( $edit_id ){
                $where["id!="] = $edit_id;
              }
              
              if( $this->pagesettings_model->get_where( $where )->num_rows() ){
                $msg = 'Page Settings Already Exist "'.$ins_data['name'].'"';
                $flash_msg_type = 'error_msg';
              }
              else if($edit_id)
              {
                $this->pagesettings_model->update( array("id" => $edit_id), $ins_data  );
                $msg = 'Record updated successfully';
              }
              else
              { 
                $insert_id    = $this->pagesettings_model->insert(  $ins_data,  "page_settings");
                
                $msg = 'Page Settings added successfully';
              }

              $this->session->set_flashdata($flash_msg_type,$msg,TRUE);
              redirect('pagesettings');
          }
      }
      catch (Exception $e)
      {
        $this->data['status']   = 'error';
        $this->data['message']  = $e->getMessage();                
      }

      if($edit_id)
      {
        $edit_data =  $this->pagesettings_model->get_where(array("id" => $edit_id))->row_array();;
      }
      
      $fom_fields = array();
      
     
      
      $form_fields[] = array(
          'name' => 'name',
          'id' => 'name',
          'label' => 'Page',
          'value' => set_value('name',safe_value_isset($edit_data,'name')),
          'options' => get_pages_list(),
          'type' => 'selectdropdown',
      );
      
      $form_fields[] = array(
          'name' => 'page_title',
          'id' => 'page_title',
          'label' => 'Page Title',
          'value' => set_value('page_title',safe_value_isset($edit_data,'page_title')),
          'type' => 'textarea',
          'attributes' => ' required maxlength="70 " pattern="[a-zA-Z\s]+" ',
          'format' => 'Ex: Welcome to Dakbro'
      );
      
      $form_fields[] = array(
          'name' => 'meta_key',
          'id' => 'meta_key',
          'label' => 'Meta Key',
          'value' => set_value('meta_key',safe_value_isset($edit_data,'meta_key')),
          'type' => 'textarea',
          'attributes' => ' required maxlength="160" pattern="[a-zA-Z\s]+" ',
          'format' => 'Ex: Bike Polish, All vehicles, anna nagar. ( max 10 key words)'
      );
      
      $form_fields[] = array(
          'name' => 'meta_desc',
          'id' => 'meta_desc',
          'label' => 'Meta Description',
          'value' => set_value('meta_desc',safe_value_isset($edit_data,'meta_desc')),
          'type' => 'textarea',
          'attributes' => ' required maxlength="160" pattern="[a-zA-Z\s]+" ',
          'format' => 'Ex: We offer all two wheeler polishing serivce.'
      );
      
       $form_fields[] = array(
          'name' => 'image',
          'id' => 'image',
          'max-width' => 2000,
          'max-height' => 2000,
          'max-upload' => 1,
          'update-exist-file' => 'true',
          'label' => 'Seo image',
          'value' => set_value('image',safe_value_isset($edit_data,'image')),
          'type' => 'upload',
          'class' => 'seo_image'
      );

      $this->data['form_fields']= add_fields($form_fields);      
     
      $this->layout->view('pages/pagesettings/add');
   }


  function delete($del_id)
  {

    $access_data = $this->pagesettings_model->get_where(array("id"=>$del_id),'id')->row_array();     
  
    $output=array();
  
    if(count($access_data) > 0)
    {
      $this->pagesettings_model->delete(array("id"=>$del_id));
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