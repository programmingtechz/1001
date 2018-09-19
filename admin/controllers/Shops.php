<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once(COREPATH."controllers/Admin_controller.php");

class Shops extends Admin_Controller
{
  function __construct()
  {
    parent::__construct();
    
    $this->load->model('shops_model');
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
                      'email' => 'Email',
                      'phone' => 'Phone'
                      );

    //ADVANCED SEARCh
    $this->_narrow_search_conditions = array("created_time");

    //ACTION BUTTONS
    $str = '<a href="'.site_url('shop_services/index/{id}').'" class="btn btn btn-padding yellow table-action">Add/Edit<br/>Services</a><a href="'.site_url('shops/add/{id}').'" class="btn btn btn-padding yellow table-action"><i class="fa fa-edit edit"></i></a><a href="javascript:void(0);" data-original-title="Remove" data-toggle="tooltip" data-placement="top" class="table-action btn-padding btn red" onclick="delete_record(\'shops/delete/{id}\',this);"><i class="fa fa-trash-o trash"></i></a>';    
    $this->listing->initialize(array('listing_action' => $str));

    $listing = $this->listing->get_listings('shops_model', 'listing');
    
    $this->data['btn'] = "<a href=".site_url('shops/add')." class='btn btn-primary'>Add New <i class='fa fa-plus'></i></a>";

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
    $this->layout->view('/pages/shops/index');
  }


  function bulk_actions()
  {
     $bulk_all = $_POST['bulk_all'];
     $selected_ids = $_POST['op_select'];
     $action = $_POST['bulk_action'];
     
     switch( $action ){
        
        case 'delete':
        
            if( $bulk_all ){
                //$this->shops_model->empty_table();
                $this->shops_model->delete(array('1'=>'1'));
                
            }else {
                $delete_ids = array('id' => $selected_ids);
                $this->shops_model->delete($delete_ids);
            }
            
            $this->session->set_flashdata('success_msg','Deleted Successfuly.',TRUE);
            
            redirect('shops');
            
            break;
        case 'export':
            
            $this->load->dbutil();
            
             if( $bulk_all ){
                $selected_ids = array();
                
            }else {
                $selected_ids = array('id' => $selected_ids);
            }

            $query = $this->shops_model->get_where($selected_ids,'name, address,email,phone,start_day as Start Day, end_day as End Day, start_time as Start Time, end_time as End Time, experience, no_of_mechanics as No of Mechanics,shop_area as Shop Area');
            
            header('Content-Type: application/csv');
            header('Content-Disposition: attachment; filename="shops.csv";');
            
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
          
          if( get_current_user_role() == 'admin' ){
            $this->form_validation->set_rules('owner_id','User','trim|required');
          }
          $this->form_validation->set_rules('address','Address','trim|required');
          $this->form_validation->set_rules('country','Country','trim|required');
          $this->form_validation->set_rules('city','City','trim|required');
          $this->form_validation->set_rules('area','Area','trim|required');
          $this->form_validation->set_rules('lat','Latitude','trim|required');
          $this->form_validation->set_rules('lon','Longitude','trim|required');
          $this->form_validation->set_rules('start_time','Start time','trim|required');
          $this->form_validation->set_rules('end_time','End time','trim|required');
          $this->form_validation->set_rules('start_day','Start Day','trim|required');
          $this->form_validation->set_rules('end_day','End Day','trim|required');
          $this->form_validation->set_rules('experience','Experience','trim|required');
          $this->form_validation->set_rules('no_of_mechanics','No of mechanics','trim|required');
          $this->form_validation->set_rules('shop_area','Shop Area','trim|required');
          $this->form_validation->set_rules('about','About shop','trim|required');

          $this->form_validation->set_error_delimiters('<span class="help-block">', '</span>');
    
          if ($this->form_validation->run())
          {

              //seller contact details
              $ins_data = array();
              $ins_data['name']      = $this->input->post('name');
              $ins_data['address']      = $this->input->post('address');
              $ins_data['country_id']      = $this->input->post('country');
              $ins_data['state_id']      = $this->input->post('state');
              $ins_data['city_id']      = $this->input->post('city');
              $ins_data['area_id']      = $this->input->post('area');
              $ins_data['lat']      = $this->input->post('lat');
              $ins_data['lon']      = $this->input->post('lon');
              $ins_data['ratings']      = $this->input->post('ratings');
              $ins_data['email']      = $this->input->post('email');
              $ins_data['phone']      = $this->input->post('phone');
              $ins_data['start_time']      = $this->input->post('start_time');
              $ins_data['end_time']      = $this->input->post('end_time');
              $ins_data['start_day']      = $this->input->post('start_day');
              $ins_data['pickup']      = $this->input->post('pickup');
              $ins_data['end_day']      = $this->input->post('end_day');
              $ins_data['experience']      = $this->input->post('experience');
              $ins_data['no_of_mechanics']      = $this->input->post('no_of_mechanics');
              $ins_data['shop_area']      = $this->input->post('shop_area');
              $ins_data['about']      = $this->input->post('about');
              $ins_data['image']      = $this->input->post('image');
              
              if( get_current_user_role() == 'admin' )
                $ins_data['owner_id']      = $this->input->post('owner_id');
              
              $ins_data = add_created_info($ins_data,$edit_id);
              $flash_msg_type = 'success_msg';
              
              if($edit_id)
              {
                $this->shops_model->update( array("id" => $edit_id), $ins_data  );
                $msg = 'Record updated successfully';
              }
              else
              { 
                $state_id    = $this->shops_model->insert(  $ins_data,  "shops");
                
                $msg = 'shop added successfully';
              }

              $this->session->set_flashdata($flash_msg_type,$msg,TRUE);
              redirect('shops');
          }
      }
      catch (Exception $e)
      {
        $this->data['status']   = 'error';
        $this->data['message']  = $e->getMessage();                
      }

      if($edit_id)
      {
        $edit_data =  $this->shops_model->get_where(array("id" => $edit_id))->row_array();;
      }
      
      $fom_fields = array();
      
      
      if(  get_current_user_role()  == "admin"){
            $form_fields[] = array(
              'name' => 'owner_id',
              'id' => 'owner_id',
              'label' => 'User',
              'value' => set_value('owner_id',safe_value_isset($edit_data,'owner_id')),
              'options' => get_users_list(array('role'=>'shop_owner')),
              'type' => 'selectdropdown',
          );
      }
      
      $form_fields[] = array(
          'name' => 'name',
          'id' => 'name',
          'label' => 'Name',
          'value' => set_value('name',safe_value_isset($edit_data,'name')),
          'type' => 'text',
          'attributes' => ' required maxlength="140" pattern="[a-zA-Z_0-9@\s&?\(\)#%]+" ',
          'format' => 'Ex. Dakbro polishing service'
      );
      
      $form_fields[] = array(
          'name' => 'email',
          'id' => 'email',
          'label' => 'Email',
          'value' => set_value('email',safe_value_isset($edit_data,'email')),
          'type' => 'email',
          'attributes' => ' required maxlength="50" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" ',
          'format' => 'Ex:info@dakbro.com'
      );
      
      
      $form_fields[] = array(
          'name' => 'phone',
          'id' => 'phone',
          'label' => 'phone Number',
          'value' => set_value('phone',safe_value_isset($edit_data,'phone')),
          'type' => 'tel',
          'attributes' => ' required maxlength="10" pattern="^\d{10}$" ',
          'format' => 'Ex:9176599630'
      );
      
      $form_fields[] = array(
          'name' => 'address',
          'id' => 'address',
          'label' => 'Address',
          'value' => set_value('address',safe_value_isset($edit_data,'address')),
          'type' => 'text',
          'attributes' => ' required maxlength="140" pattern="[a-zA-Z_0-9@\s&?\(\)\\#%]+" ',
          'format' => 'Ex. 27/2 B. 2nd street'
      );
       $form_fields[] = array(
          'name' => 'lat',
          'id' => 'lat',
          'label' => 'Latitude',
          'value' => set_value('lat',safe_value_isset($edit_data,'lat')),
          'type' => 'text',
          'attributes' => ' required  ',
          'format' => 'Enter Latitude of your shop'
      );
        $form_fields[] = array(
          'name' => 'lon',
          'id' => 'lon',
          'label' => 'Longitude',
          'value' => set_value('lon',safe_value_isset($edit_data,'lon')),
          'type' => 'text',
          'attributes' => ' required  ',
          'format' => 'Enter Longitude of your shop'
      );
      
      $form_fields[] = array(
          'name' => 'country',
          'id' => 'country',
          'label' => 'Country',
          'value' => set_value('country',safe_value_isset($edit_data,'country_id')),
          'options' => get_countries(),
          'type' => 'selectdropdown',
      );
      
      $form_fields[] = array(
          'name' => 'state',
          'id' => 'state',
          'label' => 'State',
          'value' => set_value('state',safe_value_isset($edit_data,'state_id')),
          'options' => get_states(),
          'type' => 'selectdropdown',
      );
      
      $form_fields[] = array(
          'name' => 'city',
          'id' => 'city',
          'label' => 'City',
          'value' => set_value('city',safe_value_isset($edit_data,'city_id')),
          'options' => get_cities(),
          'type' => 'selectdropdown',
      );
      
      $form_fields[] = array(
          'name' => 'area',
          'id' => 'area',
          'label' => 'Area',
          'value' => set_value('area',safe_value_isset($edit_data,'area_id')),
          'options' => get_areas(),
          'type' => 'selectdropdown',
      );
       $form_fields[] = array(
          'name' => 'start_time',
          'id' => 'start_time',
          'label' => 'Start Time',
          'value' => set_value('start_time',safe_value_isset($edit_data,'start_time')),
          'type' => 'text',
          'attributes' => ' required maxlength="8" pattern="\b((1[0-2]|0?[0-9]):([0-5][0-9]) ([AaPp][Mm]))" ',
          'format' => 'Ex:12:00 AM/PM'
      );
       $form_fields[] = array(
          'name' => 'end_time',
          'id' => 'end_time',
          'label' => 'End Time',
          'value' => set_value('end_time',safe_value_isset($edit_data,'end_time')),
          'type' => 'text',
          'attributes' => ' required maxlength="8" pattern="\b((1[0-2]|0?[0-9]):([0-5][0-9]) ([AaPp][Mm]))" ',
          'format' => 'Ex:12:00 AM/PM'
      );
      
      $form_fields[] = array(
          'name' => 'start_day',
          'id' => 'start_day',
          'label' => 'Start Day',
          'value' => set_value('start_day',safe_value_isset($edit_data,'start_day')),
          'options' => get_days_list(),
          'type' => 'selectdropdown',
      );
      
      $form_fields[] = array(
          'name' => 'end_day',
          'id' => 'end_day',
          'label' => 'End Day',
          'value' => set_value('end_day',safe_value_isset($edit_data,'end_day')),
          'options' => get_days_list(),
          'type' => 'selectdropdown',
      );
      
       $form_fields[] = array(
          'name' => 'experience',
          'id' => 'experience',
          'label' => 'Experience',
          'value' => set_value('experience',safe_value_isset($edit_data,'experience')),
          'type' => 'text',
          'attributes' => ' required maxlength="2" pattern="[0-9]+" ',
          'format' => 'Enter no of years'
      );
      
       $form_fields[] = array(
          'name' => 'no_of_mechanics',
          'id' => 'no_of_mechanics',
          'label' => 'No Of Mechanics',
          'value' => set_value('no_of_mechanics',safe_value_isset($edit_data,'no_of_mechanics')),
          'type' => 'text',
          'attributes' => ' required maxlength="2" pattern="[0-9]+" ',
          'format' => 'Enter no of Mechanics'
      );
      
      $form_fields[] = array(
          'name' => 'shop_area',
          'id' => 'shop_area',
          'label' => 'Shop Area',
          'value' => set_value('shop_area',safe_value_isset($edit_data,'shop_area')),
          'type' => 'text',
          'attributes' => ' required maxlength="5" pattern="[0-9]+" ',
          'format' => 'Enter area in sqft'
      );
      
       $form_fields[] = array(
          'name' => 'about',
          'id' => 'about',
          'label' => 'About',
          'value' => set_value('about',safe_value_isset($edit_data,'about')),
          'type' => 'textarea',
          'attributes' => ' required  pattern="[a-zA-Z_0-9@\s&?\(\)\\#%]+" ',
          'format' => ''
      );
      
      $form_fields[] = array(
          'name' => 'pickup',
          'id' => 'pickup',
          'label' => 'Pickup',
          'value' => set_value('pickup',safe_value_isset($edit_data,'pickup')),
          'options' => get_yes_no(),
          'type' => 'selectdropdown',
      );
      
       $form_fields[] = array(
          'name' => 'ratings',
          'id' => 'ratings',
          'label' => 'Ratings',
          'value' => set_value('ratings',safe_value_isset($edit_data,'ratings')),
          'type' => 'text',
          'attributes' => ' required maxlength="1" pattern="[0-9]+" ',
          'format' => 'Enter no of Ratings'
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
          'class' => 'slider_image'
      );
      

      $this->data['form_fields']= add_fields($form_fields);      
     
      $this->layout->view('pages/shops/add');
   }


  function delete($del_id)
  {

    $access_data = $this->shops_model->get_where(array("id"=>$del_id),'id')->row_array();     
  
    $output=array();
  
    if(count($access_data) > 0)
    {
      $this->shops_model->delete(array("id"=>$del_id));
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