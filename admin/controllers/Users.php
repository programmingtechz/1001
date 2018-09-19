<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once(COREPATH."controllers/Admin_controller.php");

class Users extends Admin_Controller
{
  function __construct()
  {
    parent::__construct();
    
    $this->load->model('users_model');
    $this->load->library('Email_Manager');
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
                      "email" =>"Email",
                      "phone" =>"Phone Number"
                      );

    //ADVANCED SEARCh
    $this->_narrow_search_conditions = array("created_time");

    //ACTION BUTTONS
    $str = '<a href="'.site_url('users/add/{id}').'" class="btn btn btn-padding yellow table-action"><i class="fa fa-edit edit"></i></a><a href="javascript:void(0);" data-original-title="Remove" data-toggle="tooltip" data-placement="top" class="table-action btn-padding btn red" onclick="delete_record(\'users/delete/{id}\',this);"><i class="fa fa-trash-o trash"></i></a>';    
    $this->listing->initialize(array('listing_action' => $str));

    $listing = $this->listing->get_listings('users_model', 'listing');
    
    $this->data['btn'] = "<a href=".site_url('users/add')." class='btn btn-primary'>Add New <i class='fa fa-plus'></i></a>";

    //If it is AJAX call, return only JSON data instead of HTML view. 
    if($this->input->is_ajax_request())
    {
      $this->_ajax_output(array('listing' => $listing), TRUE);
    }

    $this->data['bulk_actions'] = array('' => 'select', 'delete' => 'Delete', 'export' => 'Export');
    $this->data['simple_search_fields'] = $this->simple_search_fields;
    $this->data['search_conditions'] = $this->session->userdata($this->namespace.'_search_conditions');
    $this->data['per_page'] = $this->listing->_get_per_page();
    $this->data['per_page_options'] = array_combine($this->listing->_get_per_page_options(), $this->listing->_get_per_page_options());
    $this->data['search_bar'] = $this->load->view('listing/search_bar', $this->data, TRUE);
    $this->data['listing'] = $listing;
    $this->data['grid'] = $this->load->view('listing/view', $this->data, TRUE);

    $this->layout->view('/pages/users/index');
  }


  function bulk_actions()
  {
     $bulk_all = $_POST['bulk_all'];
     $selected_ids = $_POST['op_select'];
     $action = $_POST['bulk_action'];
     
     switch( $action ){
        
        case 'delete':
        
            if( $bulk_all ){
                $this->users_model->delete(array('role !=','admin'));
                
            }else {
                $delete_ids = array('id' => $selected_ids);
                $this->users_model->delete($delete_ids);
            }
            
            $this->session->set_flashdata('success_msg','Deleted Successfuly.',TRUE);
            
            redirect('users');
            
            break;
        case 'export':
            
            $this->load->dbutil();
            
             if( $bulk_all ){
                $selected_ids = array();
                
            }else {
                $selected_ids = array('users.id' => $selected_ids);
            }

            $query = $this->users_model->get_user_information($selected_ids);
            
            header('Content-Type: application/csv');
            header('Content-Disposition: attachment; filename="users.csv";');
            
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
          $this->form_validation->set_rules('email','Email','trim|required');
          $this->form_validation->set_rules('phone','Phone Number','trim|required');

          $this->form_validation->set_error_delimiters('<span class="help-block">', '</span>');
    
          if ($this->form_validation->run())
          {

              //seller contact details
              $ins_data = array();
              $ins_data['name']      = $this->input->post('name');
              $ins_data['email']      = $this->input->post('email');
              $ins_data['phone']      = $this->input->post('phone');
              $ins_data['city']      = $this->input->post('city');
              $ins_data['country']      = $this->input->post('country');
              $ins_data['state']      = $this->input->post('state');
              $ins_data['area']      = $this->input->post('area');
              $ins_data['language']      = $this->input->post('language');
              $ins_data['tz']      = $this->input->post('tz');
              $ins_data['image']      = $this->input->post('image');
              
              if( get_current_user_role() == 'admin' ){
                
                
                 $ins_data['status']      = $this->input->post('status');
                 
                 if( !$edit_id)
                    $ins_data['role']      = $this->input->post('role');
              }
             
              
              $ins_data = add_created_info($ins_data,$edit_id);

               $whr = array("phone" => $ins_data['phone']);
              
              if($edit_id){
                $whr['id!='] = $edit_id;
              }
              
              if( $this->users_model->get_where( $whr )->num_rows() ) {
                $msg = 'Phone number  Already Exist';
                $flash_msg_type = 'error_msg';
              }
              else if( $this->users_model->get_where( array("email" => $ins_data['email'],'id!=' => $edit_id ))->num_rows() ) {
                $msg = 'Email Already Exist';
                $flash_msg_type = 'error_msg';
              }
              else if($edit_id)
              {
                $this->users_model->update( array("id" => $edit_id), $ins_data  );
                $msg = 'Record updated successfully';
              }
              else
              { 
                $pw =rand ( 10000000 , 99999999 );
                $ins_data['password'] =md5($pw);
                $user_id    = $this->users_model->insert(  $ins_data,  "users");
                
                if( $ins_data['role'] != 'customer'){
                    
                    $ins_data['password'] = $pw;
                    $flag = $this->email_manager->send_email($ins_data['email'],$ins_data['name'],'info@dakbroincredible.com','Dakbro Incredible Polishing Studio', "DakBro - Your Login Password", $this->load->view('email/new_user.php',array('data'=>$ins_data),TRUE), array(), array());
                
                }
                
                $msg = 'User added successfully';
              }

              $this->session->set_flashdata('success_msg',$msg,TRUE);
              redirect('users');
          }
      }
      catch (Exception $e)
      {
        $this->data['status']   = 'error';
        $this->data['message']  = $e->getMessage();                
      }

      if($edit_id)
      {
        $edit_data =  $this->users_model->get_where(array("id" => $edit_id))->row_array();;
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
          'name' => 'country',
          'id' => 'country',
          'label' => 'Country',
          'value' => set_value('country',safe_value_isset($edit_data,'country')),
          'options' => get_countries(),
          'type' => 'selectdropdown',
      );
      
      $form_fields[] = array(
          'name' => 'state',
          'id' => 'state',
          'label' => 'State',
          'value' => set_value('state',safe_value_isset($edit_data,'state')),
          'options' => get_states(),
          'type' => 'selectdropdown',
      );
      
      $form_fields[] = array(
          'name' => 'city',
          'id' => 'city',
          'label' => 'City',
          'value' => set_value('city',safe_value_isset($edit_data,'city')),
          'options' => get_cities(),
          'type' => 'selectdropdown',
      );
      
      $form_fields[] = array(
          'name' => 'area',
          'id' => 'area',
          'label' => 'Area',
          'value' => set_value('area',safe_value_isset($edit_data,'area')),
          'options' => get_areas(),
          'type' => 'selectdropdown',
      );
      
      $form_fields[] = array(
          'name' => 'language',
          'id' => 'language',
          'label' => 'Language',
          'value' => set_value('language',safe_value_isset($edit_data,'language')),
          'options' => get_language(),
          'type' => 'selectdropdown',
      );
      
      $form_fields[] = array(
          'name' => 'tz',
          'id' => 'tz',
          'label' => 'Timezone',
          'value' => set_value('tz',safe_value_isset($edit_data,'tz')),
          'options' => get_tz(),
          'type' => 'selectdropdown',
      );
      if( get_current_user_role() == 'admin'){
      $form_fields[] = array(
          'name' => 'role',
          'id' => 'role',
          'label' => 'Role',
          'value' => set_value('role',safe_value_isset($edit_data,'role')),
          'options' => get_user_roles(),
          'type' => 'selectdropdown',
      );
      
      $form_fields[] = array(
          'name' => 'status',
          'id' => 'status',
          'label' => 'Status',
          'value' => set_value('status',safe_value_isset($edit_data,'status')),
          'options' => get_user_status(),
          'type' => 'selectdropdown',
      );
      }
      
      $form_fields[] = array(
          'name' => 'image',
          'id' => 'image',
          'max-width' => 170,
          'max-height' => 170,
          'max-upload' => 1,
          'update-exist-file' => 'true',
          'label' => 'Profile image',
          'value' => set_value('image',safe_value_isset($edit_data,'image')),
          'type' => 'upload',
          'class' => 'profile_image'
      );

      $this->data['form_fields']= add_fields($form_fields);      
     
      $this->layout->view('pages/users/add');
   }


  function delete($del_id)
  {

    $access_data = $this->users_model->get_where(array("id"=>$del_id),'id')->row_array();     
  
    $output=array();
  
    if(count($access_data) > 0)
    {
      $this->users_model->delete(array("id"=>$del_id));
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
 
  public function signing_url()
    {
        try 
        {
            $response = array();
    
            $s3Bucket = $this->input->post('bucket');
            $acl = "public-read";
          $policy =   <<<EOT
[
                    'expiration' => gmdate('Y-m-d\TG:i:s\Z', strtotime('+1 hours')),
                    'conditions' => [
                        ['bucket' => $s3Bucket],
                        ['acl' => $acl],
                        ['starts-with', '\$key', ''],
                        ['starts-with', '\$Content-Type', '']
                    ]
              ]
EOT;
              
              $policy_b64 = base64_encode($policy);
        
              $signature = base64_encode(hash_hmac('sha1', $policy_b64, '', true));
              $response['signature'] = $signature;
              $response['policy'] = $policy_b64;
              $response['awsKey'] = '';
              echo json_encode($response);die;
          } catch(Exception $e)
        {
            echo json_encode(array('status' => FALSE,'msg_id' => $e->getMessage()));die;
       }
    }

  public function get_users(){
    $query = $this->input->get('query');
    $users  = $this->users_model->get_uers_by_query($query);
    echo json_encode($users);exit;
  }

}
?>