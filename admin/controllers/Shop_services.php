<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once(COREPATH."controllers/Admin_controller.php");

class Shop_services extends Admin_Controller
{
  public $shop_id = "";
  
  function __construct()
  {
    parent::__construct();
    
    $this->load->model('shop_services_model');
    $request_uri = (isset($_SERVER['HTTP_REFERER']))?explode('/',$_SERVER['HTTP_REFERER']):array();
    $this->shop_id = ($this->input->is_ajax_request())?( ( isset($request_uri[8]))?$request_uri[8]:""):$this->uri->segment(3);
    
    if( empty($this->shop_id) && strpos($_SERVER['REQUEST_URI'],'/bulk_actions') === false) redirect('shops');
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
                      'name' => 'Service',
                      'vehicle_name' => 'Vehicle',
                      'price' => 'price upto',
                      'dicount' => 'Discount upto'
                      );

    //ADVANCED SEARCh
    $this->_narrow_search_conditions = array("created_time");

    //ACTION BUTTONS
    $str = '<a href="'.site_url('shop_services/add/'.$this->shop_id.'/{id}').'" class="btn btn btn-padding yellow table-action"><i class="fa fa-edit edit"></i></a><a href="javascript:void(0);" data-original-title="Remove" data-toggle="tooltip" data-placement="top" class="table-action btn-padding btn red" onclick="delete_record(\'shop_services/delete/'.$this->shop_id.'/{id}\',this);"><i class="fa fa-trash-o trash"></i></a>';    
    $this->listing->initialize(array('listing_action' => $str));
    if( !$this->input->is_ajax_request())
            $this->listing->_uri_segment =4;
    
    $listing = $this->listing->get_listings('shop_services_model', 'listing',array('shop_id'=>$this->shop_id));
    
    $this->data['btn'] = "<a href=".site_url('shop_services/add/'.$this->shop_id)." class='btn btn-primary'>Add New <i class='fa fa-plus'></i></a>";

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
    $this->data['shop_id']  = $this->shop_id;

    
    $this->layout->view('/pages/shop_services/index');
  }


  function bulk_actions()
  {
    
     $bulk_all = $_POST['bulk_all'];
     $selected_ids = $_POST['op_select'];
     $action = $_POST['bulk_action'];
     
      $request_uri = (isset($_SERVER['HTTP_REFERER']))?explode('/',$_SERVER['HTTP_REFERER']):array();
      $this->shop_id = ( isset($request_uri[8]))?$request_uri[8]:"";
     
     switch( $action ){
        
        case 'delete':
        
            if( $bulk_all ){
                
                $whr =array("1"=>"1");
                
                if( $this->shop_id ){
                    
                    $whr = array('shop_id',$this->shop_id);
                }
                
                $this->shop_services_model->delete($whr);
                
            }else {
                $delete_ids = array('id' => $selected_ids);
                
                if( $this->shop_id ){
                    $delete_ids['shop_id'] = $this->shop_id;
                }
                
                $this->shop_services_model->delete($delete_ids);
            }
            
            $this->session->set_flashdata('success_msg','Deleted Successfuly.',TRUE);
            
            if( $this->shop_id ){
                    
                redirect('shop_services/index/'.$this->shop_id );
            }else{
                redirect('shops');
            }
            
            
            break;
        case 'export':
            
            $this->load->dbutil();
            
             if( $bulk_all ){
                $selected_ids = array();
                
            }else {
                $selected_ids = array('id' => $selected_ids);
            }
            
            if( $this->shop_id ){
                $selected_ids['shop_id'] = $this->shop_id;
            }
            
            $this->db->join('services as s', 's.id = shop_services.service_id', 'left',false);
            $query = $this->shop_services_model->get_data('shop_services',$selected_ids,'s.name as Service,price,discount');
            
            header('Content-Type: application/csv');
            header('Content-Disposition: attachment; filename="shop-services.csv";');
            
            echo $this->dbutil->csv_from_result($query);

            break;
     }
  }

   function add($shop_id, $edit_id ='')
   {
    
     try
      {
          $edit_data = array();
          if($this->input->post('edit_id'))
          {
            $edit_id = $this->input->post('edit_id');
          }   
          
          $this->form_validation->set_rules('service_id','Service','trim|required');
          $this->form_validation->set_rules('price','Price','trim|required');

          $this->form_validation->set_error_delimiters('<span class="help-block">', '</span>');
    
          if ($this->form_validation->run())
          {

              //seller contact details
              $ins_data = array();
              $ins_data['price']      = $this->input->post('price');
              $ins_data['discount']      = $this->input->post('discount');
              $ins_data['service_id']      = $this->input->post('service_id');
              $ins_data['vehicle_id']      = $this->input->post('vehicle_id');
              $ins_data['shop_id']  = $shop_id;
              
              $ins_data = add_created_info($ins_data,$edit_id);
              $flash_msg_type = 'success_msg';
              
              $whr = array("service_id" => $ins_data['service_id'],"vehicle_id" => $ins_data['vehicle_id'],"shop_id"=>$shop_id);
              
              if($edit_id){
                $whr['id!='] = $edit_id;
              }
              
              if( $this->shop_services_model->get_where( $whr )->num_rows() ){
                $msg = 'This service already added.';
                $flash_msg_type = 'error_msg';
              }
              else if($edit_id)
              {
                $this->shop_services_model->update( array("id" => $edit_id), $ins_data  );
                $msg = 'Record updated successfully';
              }
              else
              { 
                $insert_id    = $this->shop_services_model->insert(  $ins_data,  "shop_services");
                
                $msg = 'Shop Service added successfully';
              }

              $this->session->set_flashdata($flash_msg_type,$msg,TRUE);
              redirect('shop_services/index/'.$shop_id);
          }
      }
      catch (Exception $e)
      {
        $this->data['status']   = 'error';
        $this->data['message']  = $e->getMessage();                
      }

      if($edit_id)
      {
        $edit_data =  $this->shop_services_model->get_where(array("id" => $edit_id))->row_array();;
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
          'name' => 'service_id',
          'id' => 'service_id',
          'label' => 'Service',
          'value' => set_value('service_id',safe_value_isset($edit_data,'service_id')),
          'options' => get_services(),
          'type' => 'selectdropdown',
      );
      
      $form_fields[] = array(
          'name' => 'vehicle_id',
          'id' => 'vehicle_id',
          'label' => 'Vehicle',
          'value' => set_value('vehicle_id',safe_value_isset($edit_data,'vehicle_id')),
          'options' => get_vehicles(array(),"name,id"),
          'type' => 'selectdropdown',
      );
          
      $form_fields[] = array(
          'name' => 'price',
          'id' => 'price',
          'label' => 'Price',
          'value' => set_value('price',safe_value_isset($edit_data,'price')),
          'type' => 'text',
          'attributes' => 'required maxlength="4" pattern="[0-9]+" ',
          'format' => 'Enter price in Rupees'
      );
      
      $form_fields[] = array(
          'name' => 'discount',
          'id' => 'discount',
          'label' => 'discount',
          'value' => set_value('discount',safe_value_isset($edit_data,'discount')),
          'type' => 'text',
          'attributes' => ' maxlength="2" pattern="[0-9]+" ',
          'format' => 'Enter discount in percentage. ( optional )'
      );
      
      $this->data['form_fields']= add_fields($form_fields);      
      $this->data['shop_id']= $shop_id;
      $this->layout->view('pages/shop_services/add');
   }


  function delete($shop_id,$del_id)
  {

    $access_data = $this->shop_services_model->get_where(array("id"=>$del_id),'id')->row_array();     
  
    $output=array();
  
    if(count($access_data) > 0)
    {
      $this->shop_services_model->delete(array("id"=>$del_id));
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