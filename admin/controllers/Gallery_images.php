<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once(COREPATH."controllers/Admin_controller.php");

class Gallery_images extends Admin_Controller
{
  public $gallery_id = "";
  
  function __construct()
  {
    parent::__construct();
    
    $this->load->model('gallery_images_model');

    $request_uri = (isset($_SERVER['HTTP_REFERER']))?explode('/',$_SERVER['HTTP_REFERER']):array();
    $this->gallery_id = ($this->input->is_ajax_request())?( ( isset($request_uri[7]))?$request_uri[7]:""):$this->uri->segment(3);

    if( empty($this->gallery_id) && strpos($_SERVER['REQUEST_URI'],'/bulk_actions') === false) redirect('gallery');
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
                      'description' => 'Description'
                      );

    //ADVANCED SEARCh
    $this->_narrow_search_conditions = array("created_time");

    //ACTION BUTTONS
    $str = '<a href="'.site_url('gallery_images/add/'.$this->gallery_id.'/{id}').'" class="btn btn btn-padding yellow table-action"><i class="fa fa-edit edit"></i></a><a href="javascript:void(0);" data-original-title="Remove" data-toggle="tooltip" data-placement="top" class="table-action btn-padding btn red" onclick="delete_record(\'gallery_images/delete/'.$this->gallery_id.'/{id}\',this);"><i class="fa fa-trash-o trash"></i></a>';    
    $this->listing->initialize(array('listing_action' => $str));
     if( !$this->input->is_ajax_request())
            $this->listing->_uri_segment =4;
    
    $listing = $this->listing->get_listings('gallery_images_model', 'listing',array('gallery_id'=>$this->gallery_id));
    
    $this->data['btn'] = "<a href=".site_url('gallery_images/add/'.$this->gallery_id)." class='btn btn-primary'>Add New <i class='fa fa-plus'></i></a>";

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
    $this->data['gallery_id']  = $this->gallery_id;

    
    $this->layout->view('/pages/gallery_images/index');
  }


  function bulk_actions()
  {$bulk_all = $_POST['bulk_all'];
     $selected_ids = $_POST['op_select'];
     $action = $_POST['bulk_action'];
     
      $request_uri = (isset($_SERVER['HTTP_REFERER']))?explode('/',$_SERVER['HTTP_REFERER']):array();
      $this->service_id = ( isset($request_uri[7]))?$request_uri[7]:"";
     
     switch( $action ){
        
        case 'delete':
        
            if( $bulk_all ){
                
                $whr =array("1"=>"1");
                
                if( $this->gallery_id ){
                    
                    $whr = array('gallery_id',$this->gallery_id);
                }
                
                $this->gallery_images_model->delete($whr);
                
            }else {
                $delete_ids = array('id' => $selected_ids);
                
                if( $this->gallery_id ){
                    $delete_ids['gallery_id'] = $this->gallery_id;
                }
                
                $this->gallery_images_model->delete($delete_ids);
            }
            
            $this->session->set_flashdata('success_msg','Deleted Successfuly.',TRUE);
            
            if( $this->gallery_id ){
                    
                redirect('gallery_images/index/'.$this->gallery_id );
            }else{
                redirect('gallery');
            }
            
            
            break;
        case 'export':
            
            $this->load->dbutil();
            
             if( $bulk_all ){
                $selected_ids = array();
                
            }else {
                $selected_ids = array('id' => $selected_ids);
            }
            
            if( $this->gallery_id ){
                $selected_ids['gallery_id'] = $this->gallery_id;
            }
            $query = $this->gallery_images_model->get_where($selected_ids,'title as Title, description as Description');
            
            header('Content-Type: application/csv');
            header('Content-Disposition: attachment; filename="gallery-iamges.csv";');
            
            echo $this->dbutil->csv_from_result($query);

            break;
     }
  }

   function add($gallery_id, $edit_id ='')
   {
    
     try
      {
          $edit_data = array();
          if($this->input->post('edit_id'))
          {
            $edit_id = $this->input->post('edit_id');
          }   
          
          $this->form_validation->set_rules('title','Title','trim|required');

          $this->form_validation->set_error_delimiters('<span class="help-block">', '</span>');
    
          if ($this->form_validation->run())
          {

              //seller contact details
              $ins_data = array();
              $ins_data['title']      = $this->input->post('title');
              $ins_data['description']      = $this->input->post('description');
              $ins_data['image']      = $this->input->post('image');
              $ins_data['gallery_id']  = $gallery_id;
              
              $ins_data = add_created_info($ins_data,$edit_id);
              $flash_msg_type = 'success_msg';
              
              if($edit_id)
              {
                $this->gallery_images_model->update( array("id" => $edit_id), $ins_data  );
                $msg = 'Record updated successfully';
              }
              else
              { 
                $insert_id    = $this->gallery_images_model->insert(  $ins_data,  "gallery_images");
                
                $msg = 'Gallery added successfully';
              }

              $this->session->set_flashdata($flash_msg_type,$msg,TRUE);
              redirect('gallery_images/index/'.$gallery_id);
          }
      }
      catch (Exception $e)
      {
        $this->data['status']   = 'error';
        $this->data['message']  = $e->getMessage();                
      }

      if($edit_id)
      {
        $edit_data =  $this->gallery_images_model->get_where(array("id" => $edit_id))->row_array();;
      }
      
      $fom_fields = array();
          
      $form_fields[] = array(
          'name' => 'title',
          'id' => 'title',
          'label' => 'Title',
          'value' => set_value('title',safe_value_isset($edit_data,'title')),
          'type' => 'text',
          'attributes' => 'required maxlength="40" pattern="[a-zA-Z_0-9@\s&?\(\)#%]+" ',
          'format' => 'Text'
      );
      
      $form_fields[] = array(
          'name' => 'description',
          'id' => 'description',
          'label' => 'Description',
          'value' => set_value('description',safe_value_isset($edit_data,'description')),
          'type' => 'textarea',
          'attributes' => ' required maxlength="300" pattern="[a-zA-Z_0-9@\s&?\(\)#%]+" ',
          'format' => 'Text'
      );
      
       $form_fields[] = array(
          'name' => 'image',
          'id' => 'image',
          'max-width' => 2000,
          'max-height' => 800,
          'max-upload' => 3,
          'update-exist-file' => 'false',
          'label' => 'Images',
          'value' => set_value('image',safe_value_isset($edit_data,'image')),
          'type' => 'upload',
          'class' => 'gallery_image'
      );
      
      $this->data['form_fields']= add_fields($form_fields);      
      $this->data['gallery_id']= $gallery_id;
      $this->layout->view('pages/gallery_images/add');
   }


  function delete($gallery_id,$del_id)
  {

    $access_data = $this->gallery_images_model->get_where(array("id"=>$del_id),'id')->row_array();     
  
    $output=array();
  
    if(count($access_data) > 0)
    {
      $this->gallery_images_model->delete(array("id"=>$del_id));
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