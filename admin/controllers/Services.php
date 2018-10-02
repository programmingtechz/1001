<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once(COREPATH."controllers/Admin_controller.php");

class Services extends Admin_Controller
{
  public $service_id = "";
  
  function __construct()
  {
    parent::__construct();
    
    $this->load->model('services_model');
    
    $request_uri = (isset($_SERVER['HTTP_REFERER']))?explode('/',$_SERVER['HTTP_REFERER']):array();
    $this->service_id = ($this->input->is_ajax_request())?( ( isset($request_uri[7]))?$request_uri[7]:""):$this->uri->segment(3);
    
    
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
                      "type" =>"Type"
                      );

    //ADVANCED SEARCh
    $this->_narrow_search_conditions = array("created_time");

    //ACTION BUTTONS
    $str ="";
    //echo $this->service_id ;die;        
    if( empty($this->service_id ) )
        $str .= '<a href="'.site_url('services/index/{id}').'" class="btn btn btn-padding yellow table-action">Sub Serivces</a>';
        
        //$str .= '<a href="'.site_url('service_vehicles/index/{id}').'" class="btn btn btn-padding yellow table-action">Serivce Vehicles</a>';
    
    $str .= '<a href="'.site_url('services/add/{id}').'" class="btn btn btn-padding yellow table-action"><i class="fa fa-edit edit"></i></a><a href="javascript:void(0);" data-original-title="Remove" data-toggle="tooltip" data-placement="top" class="table-action btn-padding btn red" onclick="delete_record(\'services/delete/{id}\',this);"><i class="fa fa-trash-o trash"></i></a>';    
    $this->listing->initialize(array('listing_action' => $str));

    $listing_args = array();
    
    if( $this->service_id ){
        $listing_args = array('service_id'=>$this->service_id);
        
        if( !$this->input->is_ajax_request())
            $this->listing->_uri_segment =4;
    }
        
    
    $listing = $this->listing->get_listings('services_model', 'listing',$listing_args);
    
    $this->data['btn'] = "<a href=".site_url('services/add')." class='btn btn-primary'>Add New <i class='fa fa-plus'></i></a>";

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

    $this->layout->view('/pages/services/index');
  }


  function bulk_actions()
  {
     $bulk_all = $_POST['bulk_all'];
     $selected_ids = $_POST['op_select'];
     $action = $_POST['bulk_action'];
     
      $request_uri = (isset($_SERVER['HTTP_REFERER']))?explode('/',$_SERVER['HTTP_REFERER']):array();
      $this->service_id = ( isset($request_uri[7]))?$request_uri[7]:"";
     
     switch( $action ){
        
        case 'delete':
        
            if( $bulk_all ){
                
                $whr =array("1"=>"1");
                
                if( $this->service_id ){
                    
                    $whr = array('parent_id',$this->service_id);
                }
               
                $this->services_model->delete($whr);
                
            }else {
                $delete_ids = array('id' => $selected_ids);
                
                if( $this->service_id ){
                    $delete_ids['parent_id'] = $this->service_id;
                }
                
                $this->services_model->delete($delete_ids);
            }
            
            $this->session->set_flashdata('success_msg','Deleted Successfuly.',TRUE);
            
            if( $this->service_id ){
                    
                redirect('services/index/'.$this->service_id );
            }else{
                redirect('services');
            }
            
            
            break;
        case 'export':
            
            $this->load->dbutil();
            
             if( $bulk_all ){
                $selected_ids = array();
                
            }else {
                $selected_ids = array('id' => $selected_ids);
            }
            
            if( $this->service_id ){
                $selected_ids['parent_id'] = $this->service_id;
            }
            $query = $this->services_model->get_where($selected_ids,'name, description,type');
            
            header('Content-Type: application/csv');
            header('Content-Disposition: attachment; filename="Services.csv";');
            
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

          $this->form_validation->set_error_delimiters('<span class="help-block">', '</span>');
    
          if ($this->form_validation->run())
          {

              //seller contact details
              $ins_data = array();
              $ins_data['name']      = $this->input->post('name');
              $ins_data['short_text']      = $this->input->post('short_text');
              
              if( $this->input->post('service_time') )
                $ins_data['service_time']      = $this->input->post('service_time');
                
              $ins_data['image']      = $this->input->post('image');
              $ins_data['description']      = $this->input->post('description');
              $ins_data['service_details']      = $this->input->post('service_details');
              $ins_data['service_image']      = $this->input->post('service_image');
              $ins_data['type']      = $this->input->post('type');
              $ins_data['order_no']      = $this->input->post('order_no');
              $ins_data['parent_id']      = ($this->input->post('parent_id'))?$this->input->post('parent_id'):0;
              
              $ins_data = add_created_info($ins_data,$edit_id);
              $flash_msg_type = 'success_msg';
              
              $whr = array("name" => $ins_data['name'],"parent_id" => $ins_data['parent_id']);
              
              if($edit_id){
                $whr['id!='] = $edit_id;
              }
              
              if( $this->services_model->get_where( $whr )->num_rows() ){
                $msg = 'Service Name Already Exist for Selected Country';
                $flash_msg_type = 'error_msg';
              }
              else if($edit_id)
              {
                $this->services_model->update( array("id" => $edit_id), $ins_data  );
                $msg = 'Record updated successfully';
              }
              else
              { 
                $state_id    = $this->services_model->insert(  $ins_data,  "services");
                
                $msg = 'Services added successfully';
              }

              $this->session->set_flashdata($flash_msg_type,$msg,TRUE);
              redirect('services');
          }
      }
      catch (Exception $e)
      {
        $this->data['status']   = 'error';
        $this->data['message']  = $e->getMessage();                
      }

      if($edit_id)
      {
        $edit_data =  $this->services_model->get_where(array("id" => $edit_id))->row_array();;
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
          'name' => 'parent_id',
          'id' => 'parent_id',
          'label' => 'Main Service',
          'value' => set_value('parent_id',safe_value_isset($edit_data,'parent_id')),
          'options' => get_services(array('type'=>'bike','parent_id'=>0)),
          'type' => 'selectdropdown',
      );
      
      $form_fields[] = array(
          'name' => 'name',
          'id' => 'name',
          'label' => 'Name',
          'value' => set_value('name',safe_value_isset($edit_data,'name')),
          'type' => 'text',
          'attributes' => ' required maxlength="40" pattern="[a-zA-Z_0-9\s]+" ',
          'format' => 'Only Letters and numbers'
      );
      
      $form_fields[] = array(
          'name' => 'short_text',
          'id' => 'short_text',
          'label' => 'Sub Title',
          'value' => set_value('short_text',safe_value_isset($edit_data,'short_text')),
          'type' => 'textarea',
          'attributes' => ' required  pattern="[a-zA-Z_0-9@\s&?\(\)#%]+" ',
          'format' => 'Bike polishing service.'
      );
      
      $form_fields[] = array(
          'name' => 'service_time',
          'id' => 'service_time',
          'label' => 'Service Time',
          'value' => set_value('service_time',safe_value_isset($edit_data,'service_time')),
          'type' => 'text',
          'attributes' => ' maxlength="3" pattern="[0-9]+" ',
          'format' => 'Enter in minutes. (leave empty for custom time)'
      );
      
       $form_fields[] = array(
          'name' => 'description',
          'id' => 'description',
          'label' => 'Description',
          'value' => set_value('description',safe_value_isset($edit_data,'description')),
          'type' => 'textarea',
          'attributes' => ' required  pattern="[a-zA-Z_0-9@\s&?\(\)#%]+" ',
          'format' => 'Bike polishing service.'
      );
      
       $form_fields[] = array(
          'name' => 'image',
          'id' => 'image',
          'max-width' => 35,
          'max-height' => 35,
          'max-upload' => 1,
          'update-exist-file' => 'true',
          'label' => 'Service icon',
          'value' => set_value('image',safe_value_isset($edit_data,'image')),
          'type' => 'upload',
          'class' => 'service_image'
      );
      
      $form_fields[] = array(
          'name' => 'service_image',
          'id' => 'service_image',
          'max-width' => 1024,
          'max-height' => 720,
          'max-upload' => 1,
          'update-exist-file' => 'true',
          'label' => 'Service image',
          'value' => set_value('service_image',safe_value_isset($edit_data,'service_image')),
          'type' => 'upload',
          'class' => 'service_image'
      );
      
     $form_fields[] = array(
          'name' => 'service_details',
          'id' => 'service_details',
          'label' => 'Whats included',
          'value' => set_value('service_details',safe_value_isset($edit_data,'service_details')),
          'type' => 'textarea',
          'attributes' => ' required  pattern="[a-zA-Z_0-9@\s&?\(\)#%]+" ',
          'format' => 'Enter each item in new line.'
      );
      
       $form_fields[] = array(
          'name' => 'order_no',
          'id' => 'order_no',
          'label' => 'Order',
          'value' => set_value('order_no',safe_value_isset($edit_data,'order_no')),
          'type' => 'text',
          'attributes' => ' required   maxlength="3" pattern="[0-9]+" ',
          'format' => 'Service listing number'
      );

      $this->data['form_fields']= add_fields($form_fields);      
     
      $this->layout->view('pages/services/add');
   }


  function delete($del_id)
  {

    $access_data = $this->services_model->get_where(array("id"=>$del_id),'id')->row_array();     
  
    $output=array();
  
    if(count($access_data) > 0)
    {
      $this->services_model->delete(array("id"=>$del_id));
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