<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once(COREPATH."controllers/Admin_controller.php");

class service_vehicles extends Admin_Controller
{
  public $service_id = "";
  
  function __construct()
  {
    parent::__construct();
    
    $this->load->model('service_vehicles_model');
    $request_uri = (isset($_SERVER['HTTP_REFERER']))?explode('/',$_SERVER['HTTP_REFERER']):array();
    $this->service_id = ($this->input->is_ajax_request())?( ( isset($request_uri[8]))?$request_uri[8]:""):$this->uri->segment(3);
    
    if( empty($this->service_id) && strpos($_SERVER['REQUEST_URI'],'/bulk_actions') === false) redirect('services');
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
                        'name' => 'Vehicle'
                      );

    //ADVANCED SEARCh
    $this->_narrow_search_conditions = array("created_time");

    //ACTION BUTTONS
    $str = '<a href="'.site_url('service_vehicles/add/'.$this->service_id.'/{id}').'" class="btn btn btn-padding yellow table-action"><i class="fa fa-edit edit"></i></a><a href="javascript:void(0);" data-original-title="Remove" data-toggle="tooltip" data-placement="top" class="table-action btn-padding btn red" onclick="delete_record(\'service_vehicles/delete/'.$this->service_id.'/{id}\',this);"><i class="fa fa-trash-o trash"></i></a>';    
    $this->listing->initialize(array('listing_action' => $str));
     if( !$this->input->is_ajax_request())
            $this->listing->_uri_segment =4;
    
    $listing = $this->listing->get_listings('service_vehicles_model', 'listing',array('service_id'=>$this->service_id));
    
    $this->data['btn'] = "<a href=".site_url('service_vehicles/add/'.$this->service_id)." class='btn btn-primary'>Add New <i class='fa fa-plus'></i></a>";

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
    $this->data['service_id']  = $this->service_id;

    
    $this->layout->view('/pages/service_vehicles/index');
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
                
                if( $this->service_id ){
                    
                    $whr = array('service_id',$this->service_id);
                }
                
                $this->service_vehicles_model->delete($whr);
                
            }else {
                $delete_ids = array('id' => $selected_ids);
                
                if( $this->service_id ){
                    $delete_ids['service_id'] = $this->service_id;
                }
                
                $this->service_vehicles_model->delete($delete_ids);
            }
            
            $this->session->set_flashdata('success_msg','Deleted Successfuly.',TRUE);
            
            if( $this->service_id ){
                    
                redirect('service_vehicles/index.php/'.$this->service_id );
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
                $selected_ids['service_id'] = $this->service_id;
            }
            
            $this->db->join('service as s', 's.id = service_vehicles.service_id', 'left',false);
            $this->db->join('vehicles as v', 'v.id = service_vehicles.vehicle_id', 'left',false);
            $query = $this->service_vehicles_model->get_data('service_vehicles',$selected_ids,'s.name as Service,v.name as Vehicle,v.type as Type,price,discount');
            
            header('Content-Type: application/csv');
            header('Content-Disposition: attachment; filename="service-vehicles.csv";');
            
            echo $this->dbutil->csv_from_result($query);

            break;
     }
  }

   function add($service_id, $edit_id ='')
   {
    
     try
      {
          $edit_data = array();
          if($this->input->post('edit_id'))
          {
            $edit_id = $this->input->post('edit_id');
          }   
          
          $this->form_validation->set_rules('vehicle_id','Vehicle','trim|required');

          $this->form_validation->set_error_delimiters('<span class="help-block">', '</span>');
    
          if ($this->form_validation->run())
          {

              //seller contact details
              $ins_data = array();
              $ins_data['vehicle_id']      = $this->input->post('vehicle_id');
              $ins_data['service_id']  = $service_id;
              
              $ins_data = add_created_info($ins_data,$edit_id);
              $flash_msg_type = 'success_msg';
              $whr = array("vehicle_id" => $ins_data['vehicle_id'],"service_id"=>$service_id);
              
              if($edit_id){
                $whr['id!='] = $edit_id;
              }
              
              if( $this->service_vehicles_model->get_where( $whr )->num_rows() ){
                $msg = 'This Vehicle already added.';
                $flash_msg_type = 'error_msg';
              }
              else if($edit_id)
              {
                $this->service_vehicles_model->update( array("id" => $edit_id), $ins_data  );
                $msg = 'Record updated successfully';
              }
              else
              { 
                $insert_id    = $this->service_vehicles_model->insert(  $ins_data,  "service_vehicles");
                
                $msg = 'Service Vehicles added successfully';
              }

              $this->session->set_flashdata($flash_msg_type,$msg,TRUE);
              redirect('service_vehicles/index/'.$service_id);
          }
      }
      catch (Exception $e)
      {
        $this->data['status']   = 'error';
        $this->data['message']  = $e->getMessage();                
      }

      if($edit_id)
      {
        $edit_data =  $this->service_vehicles_model->get_where(array("id" => $edit_id))->row_array();;
      }
      
      $fom_fields = array();
      
      $form_fields[] = array(
          'name' => 'vehicle_id',
          'id' => 'vehicle_id',
          'label' => 'Vehicle',
          'value' => set_value('vehicle_id',safe_value_isset($edit_data,'vehicle_id')),
          'options' => get_vehicles(array(),"concat(name,' ( ',type,' ) ') as name,id"),
          'type' => 'selectdropdown',
      );
      $this->data['form_fields']= add_fields($form_fields);      
      $this->data['service_id']= $service_id;
      $this->layout->view('pages/service_vehicles/add');
   }


  function delete($service_id,$del_id)
  {

    $access_data = $this->service_vehicles_model->get_where(array("id"=>$del_id),'id')->row_array();     
  
    $output=array();
  
    if(count($access_data) > 0)
    {
      $this->service_vehicles_model->delete(array("id"=>$del_id));
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