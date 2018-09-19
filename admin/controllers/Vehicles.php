<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once(COREPATH."controllers/Admin_controller.php");

class Vehicles extends Admin_Controller
{
  function __construct()
  {
    parent::__construct();
    
    $this->load->model('vehicles_model');
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
                      "type" =>"type"
                      );

    //ADVANCED SEARCh
    $this->_narrow_search_conditions = array("created_time");

    //ACTION BUTTONS
    $str = '<a href="'.site_url('vehicles/add/{id}').'" class="btn btn btn-padding yellow table-action"><i class="fa fa-edit edit"></i></a><a href="javascript:void(0);" data-original-title="Remove" data-toggle="tooltip" data-placement="top" class="table-action btn-padding btn red" onclick="delete_record(\'vehicles/delete/{id}\',this);"><i class="fa fa-trash-o trash"></i></a>';    
    $this->listing->initialize(array('listing_action' => $str));

    $listing = $this->listing->get_listings('vehicles_model', 'listing');
    
    $this->data['btn'] = "<a href=".site_url('vehicles/add')." class='btn btn-primary'>Add New <i class='fa fa-plus'></i></a>";

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

    $this->layout->view('/pages/vehicles/index');
  }


  function bulk_actions()
  {
     $bulk_all = $_POST['bulk_all'];
     $selected_ids = $_POST['op_select'];
     $action = $_POST['bulk_action'];
     
     switch( $action ){
        
        case 'delete':
        
            if( $bulk_all ){
                //$this->vehicles_model->empty_table();
                $this->vehicles_model->delete(array('1'=>'1'));
                
            }else {
                $delete_ids = array('id' => $selected_ids);
                $this->vehicles_model->delete($delete_ids);
            }
            
            $this->session->set_flashdata('success_msg','Deleted Successfuly.',TRUE);
            
            redirect('vehicles');
            
            break;
        case 'export':
            
            $this->load->dbutil();
            
             if( $bulk_all ){
                $selected_ids = array();
                
            }else {
                $selected_ids = array('id' => $selected_ids);
            }

            $query = $this->vehicles_model->get_where($selected_ids,'name, description,type');
            
            header('Content-Type: application/csv');
            header('Content-Disposition: attachment; filename="vehicles.csv";');
            
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
          $this->form_validation->set_rules('description','Description','trim|required');
          $this->form_validation->set_rules('type','Type','trim|required');

          $this->form_validation->set_error_delimiters('<span class="help-block">', '</span>');
    
          if ($this->form_validation->run())
          {

              //seller contact details
              $ins_data = array();
              $ins_data['name']      = $this->input->post('name');
              $ins_data['image']      = $this->input->post('image');
              $ins_data['hover_image']      = $this->input->post('hover_image');
              $ins_data['order_no']      = $this->input->post('order_no');
              $ins_data['description']      = $this->input->post('description');
              $ins_data['type']      = $this->input->post('type');
              
              $ins_data = add_created_info($ins_data,$edit_id);
              $flash_msg_type = 'success_msg';
              
              $whr = array("name" => $ins_data['name'],"type" => $ins_data['type']);
              
              if($edit_id){
                $whr['id!='] = $edit_id;
              }
              
              if( $this->vehicles_model->get_where( $whr )->num_rows() ){
                $msg = 'Vehicles name Already Exist for Selected type';
                $flash_msg_type = 'error_msg';
              }
              else if($edit_id)
              {
                $this->vehicles_model->update( array("id" => $edit_id), $ins_data  );
                $msg = 'Record updated successfully';
              }
              else
              { 
                $insert_id    = $this->vehicles_model->insert(  $ins_data,  "vehicles");
                
                $msg = 'vehicle added successfully';
              }

              $this->session->set_flashdata($flash_msg_type,$msg,TRUE);
              redirect('vehicles');
          }
      }
      catch (Exception $e)
      {
        $this->data['status']   = 'error';
        $this->data['message']  = $e->getMessage();                
      }

      if($edit_id)
      {
        $edit_data =  $this->vehicles_model->get_where(array("id" => $edit_id))->row_array();;
      }
      
      $fom_fields = array();
      
      $form_fields[] = array(
          'name' => 'type',
          'id' => 'type',
          'label' => 'Vehicle Type',
          'value' => set_value('type',safe_value_isset($edit_data,'type')),
          'options' => get_vehicles_type(),
          'type' => 'selectdropdown',
      );
      
      $form_fields[] = array(
          'name' => 'name',
          'id' => 'name',
          'label' => 'Name',
          'value' => set_value('name',safe_value_isset($edit_data,'name')),
          'type' => 'text',
          'attributes' => ' required maxlength="40" pattern="[a-zA-Z_0-9@\s&?\(\)#%-]+" ',
          'format' => 'Only Letters'
      );
      
      $form_fields[] = array(
          'name' => 'image',
          'id' => 'image',
          'max-width' => 170,
          'max-height' => 170,
          'max-upload' => 1,
          'update-exist-file' => 'true',
          'label' => 'Vehicle image',
          'value' => set_value('image',safe_value_isset($edit_data,'image')),
          'type' => 'upload',
          'class' => 'vehicle_image'
      );
      
        $form_fields[] = array(
          'name' => 'hover_image',
          'id' => 'hover_image',
          'max-width' => 170,
          'max-height' => 170,
          'max-upload' => 1,
          'update-exist-file' => 'true',
          'label' => 'Vehicle hover icon',
          'value' => set_value('hover_image',safe_value_isset($edit_data,'hover_image')),
          'type' => 'upload',
          'class' => 'service_image_hover'
      );
      
      $form_fields[] = array(
          'name' => 'description',
          'id' => 'description',
          'label' => 'Description',
          'value' => set_value('description',safe_value_isset($edit_data,'description')),
          'type' => 'textarea',
          'attributes' => ' required maxlength="160" pattern="[a-zA-Z_0-9@\s&?\(\)#%]+-" ',
          'format' => 'Ex: 200cc bike'
      );
      
      $form_fields[] = array(
          'name' => 'order_no',
          'id' => 'order_no',
          'label' => 'Order',
          'value' => set_value('order_no',safe_value_isset($edit_data,'order_no')),
          'type' => 'text',
          'attributes' => ' required   maxlength="3" pattern="[0-9]+" ',
          'format' => 'Vehicle listing number'
      );

      $this->data['form_fields']= add_fields($form_fields);      
     
      $this->layout->view('pages/vehicles/add');
   }


  function delete($del_id)
  {

    $access_data = $this->vehicles_model->get_where(array("id"=>$del_id),'id')->row_array();     
  
    $output=array();
  
    if(count($access_data) > 0)
    {
      $this->vehicles_model->delete(array("id"=>$del_id));
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