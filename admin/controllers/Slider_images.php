<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once(COREPATH."controllers/Admin_controller.php");

class Slider_images extends Admin_Controller
{
  public $slider_id = "";
  
  function __construct()
  {
    parent::__construct();
    
    $this->load->model('slider_images_model');
    $request_uri = (isset($_SERVER['HTTP_REFERER']))?explode('/',$_SERVER['HTTP_REFERER']):array();
    $this->slider_id = ($this->input->is_ajax_request())?( ( isset($request_uri[8]))?$request_uri[8]:""):$this->uri->segment(3);
    
    if( empty($this->slider_id) && strpos($_SERVER['REQUEST_URI'],'/bulk_actions') === false) redirect('sliders');
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
                      'title' => 'Title',
                      'sub_title' => 'Sub Title'
                      );

    //ADVANCED SEARCh
    $this->_narrow_search_conditions = array("created_time");

    //ACTION BUTTONS
    $str = '<a href="'.site_url('slider_images/add/'.$this->slider_id.'/{id}').'" class="btn btn btn-padding yellow table-action"><i class="fa fa-edit edit"></i></a><a href="javascript:void(0);" data-original-title="Remove" data-toggle="tooltip" data-placement="top" class="table-action btn-padding btn red" onclick="delete_record(\'slider_images/delete/'.$this->slider_id.'/{id}\',this);"><i class="fa fa-trash-o trash"></i></a>';    
    $this->listing->initialize(array('listing_action' => $str));
     if( !$this->input->is_ajax_request())
            $this->listing->_uri_segment =4;
    
    $listing = $this->listing->get_listings('slider_images_model', 'listing',array('slider_id'=>$this->slider_id));
    
    $this->data['btn'] = "<a href=".site_url('slider_images/add/'.$this->slider_id)." class='btn btn-primary'>Add New <i class='fa fa-plus'></i></a>";

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
    $this->data['slider_id']  = $this->slider_id;

    
    $this->layout->view('/pages/slider_images/index');
  }


  function bulk_actions()
  {
    
     $bulk_all = $_POST['bulk_all'];
     $selected_ids = $_POST['op_select'];
     $action = $_POST['bulk_action'];
     
      $request_uri = (isset($_SERVER['HTTP_REFERER']))?explode('/',$_SERVER['HTTP_REFERER']):array();
      $this->service_id = ( isset($request_uri[8]))?$request_uri[8]:"";
     
     switch( $action ){
        
        case 'delete':
        
            if( $bulk_all ){
                
                $whr =array("1"=>"1");
                
                if( $this->slider_id ){
                    
                    $whr = array('slider_id',$this->slider_id);
                }
                
                $this->slider_images_model->delete($whr);
                
            }else {
                $delete_ids = array('id' => $selected_ids);
                
                if( $this->slider_id ){
                    $delete_ids['slider_id'] = $this->slider_id;
                }
                
                $this->slider_images_model->delete($delete_ids);
            }
            
            $this->session->set_flashdata('success_msg','Deleted Successfuly.',TRUE);
            
            if( $this->slider_id ){
                    
                redirect('slider_images/index/'.$this->slider_id );
            }else{
                redirect('sliders');
            }
            
            
            break;
        case 'export':
            
            $this->load->dbutil();
            
             if( $bulk_all ){
                $selected_ids = array();
                
            }else {
                $selected_ids = array('id' => $selected_ids);
            }
            
            if( $this->slider_id ){
                $selected_ids['slider_id'] = $this->slider_id;
            }
            $query = $this->slider_images_model->get_where($selected_ids,'title as Title, sub_title as Sub Title');
            
            header('Content-Type: application/csv');
            header('Content-Disposition: attachment; filename="slider-iamges.csv";');
            
            echo $this->dbutil->csv_from_result($query);

            break;
     }
  }

   function add($slider_id, $edit_id ='')
   {
    
     try
      {
          $edit_data = array();
          if($this->input->post('edit_id'))
          {
            $edit_id = $this->input->post('edit_id');
          }   
          
          $this->form_validation->set_rules('image','image','trim|required');

          $this->form_validation->set_error_delimiters('<span class="help-block">', '</span>');
    
          if ($this->form_validation->run())
          {

              //seller contact details
              $ins_data = array();
              $ins_data['title']      = $this->input->post('title');
              $ins_data['sub_title']      = $this->input->post('sub_title');
              $ins_data['image']      = $this->input->post('image');
              $ins_data['slider_id']  = $slider_id;
              
              $ins_data = add_created_info($ins_data,$edit_id);
              $flash_msg_type = 'success_msg';
              
              if($edit_id)
              {
                $this->slider_images_model->update( array("id" => $edit_id), $ins_data  );
                $msg = 'Record updated successfully';
              }
              else
              { 
                $insert_id    = $this->slider_images_model->insert(  $ins_data,  "slider_images");
                
                $msg = 'Slider Image added successfully';
              }

              $this->session->set_flashdata($flash_msg_type,$msg,TRUE);
              redirect('slider_images/index/'.$slider_id);
          }
      }
      catch (Exception $e)
      {
        $this->data['status']   = 'error';
        $this->data['message']  = $e->getMessage();                
      }

      if($edit_id)
      {
        $edit_data =  $this->slider_images_model->get_where(array("id" => $edit_id))->row_array();;
      }
      
      $fom_fields = array();
          
      $form_fields[] = array(
          'name' => 'title',
          'id' => 'title',
          'label' => 'Title',
          'value' => set_value('title',safe_value_isset($edit_data,'title')),
          'type' => 'text',
          'attributes' => ' maxlength="250" pattern="[a-zA-Z_0-9@\s&?\(\)#%]+" ',
          'format' => 'Text'
      );
      
      $form_fields[] = array(
          'name' => 'sub_title',
          'id' => 'sub_title',
          'label' => 'Sub Title',
          'value' => set_value('sub_title',safe_value_isset($edit_data,'sub_title')),
          'type' => 'text',
          'attributes' => '  maxlength="250" pattern="[a-zA-Z_0-9@\s&?\(\)#%]+" ',
          'format' => 'Text'
      );
      
       $form_fields[] = array(
          'name' => 'image',
          'id' => 'image',
          'max-width' => 2000,
          'max-height' => 800,
          'max-upload' => 3,
          'update-exist-file' => 'true',
          'label' => 'Images',
          'value' => set_value('image',safe_value_isset($edit_data,'image')),
          'type' => 'upload',
          'class' => 'slider_image'
      );
      
      $this->data['form_fields']= add_fields($form_fields);      
      $this->data['slider_id']= $slider_id;
      $this->layout->view('pages/slider_images/add');
   }


  function delete($slider_id,$del_id)
  {

    $access_data = $this->slider_images_model->get_where(array("id"=>$del_id),'id')->row_array();     
  
    $output=array();
  
    if(count($access_data) > 0)
    {
      $this->slider_images_model->delete(array("id"=>$del_id));
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