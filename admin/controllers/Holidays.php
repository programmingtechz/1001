<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once(COREPATH."controllers/Admin_controller.php");

class Holidays extends Admin_Controller
{
  function __construct()
  {
    parent::__construct();
    
    $this->load->model('holidays_model');
  }

  public function index()
  {
    	$this->layout->add_javascripts(array('holidays','fullcalendar.min'));
        $this->layout->add_stylesheet('fullcalendar.min');
        
        $fom_fields = array();
        $form_fields[] = array(
          'name' => 'date',
          'id' => 'date',
          'label' => 'Date',
          'value' => '',
          'type' => 'text',
          'attributes' => ' disabled=disabled required maxlength="40" pattern="[a-zA-Z\s]+" ',
          'format' => ''
        );
        $form_fields[] = array(
          'name' => 'reason',
          'id' => 'reason',
          'label' => 'Reason',
          'value' => '',
          'type' => 'textarea',
          'attributes' => ' required  pattern="[a-zA-Z_0-9@\s&?\(\)#%]+" ',
          'format' => 'Ex: diwali holiday'
        );
        $this->data['form_fields']= add_fields($form_fields);    
                            
        $this->layout->view('/pages/holidays/index');
        
  }

   function add($date ='')
   {
    
     try
      {
          $output=array();
          $this->form_validation->set_rules('reason','reason','trim|required');

          $this->form_validation->set_error_delimiters('<span class="help-block">', '</span>');
    
          if ($this->form_validation->run())
          {

              //seller contact details
              $ins_data = array();
              $ins_data['reason']      = $this->input->post('reason');
              $ins_data['date']      = $date;
              
              $ins_data = add_created_info($ins_data);
              $flash_msg_type = 'success_msg';
              
              $whr = array("date" => $date,'created_id'=>get_current_user_id());
              
              if( $this->holidays_model->get_where( $whr )->num_rows() ){
                $this->holidays_model->update( array("date" => $date,'created_id'=>get_current_user_id()), $ins_data  );
                $output['message'] = 'Updated Successfully.';
                $output['status']  = "success";
              }
              else
              { 
                $insert_id    = $this->holidays_model->insert(  $ins_data,  "holidays");
                
                 $output['message'] = 'Added Successfully.';
                $output['status']  = "success";
              }
          }
          else
            {
              $output['message'] ="Unknown error occured. Please try again later..";
              $output['status']  = "error";
            } 
          
      }
      catch (Exception $e)
      {
        $output['status']   = 'error';
        $output['message']  = $e->getMessage();                
      }
      
       $this->_ajax_output($output, TRUE);
   }


  function delete($del_id="")
  {
    
    
    $access_data = $this->holidays_model->get_where(array("date"=>$this->input->post('sel_date'),'created_id'=>get_current_user_id()),'id')->row_array();     
  
    $output=array();
  
    if(count($access_data) > 0)
    {
      $this->holidays_model->delete(array("date"=>$this->input->post('sel_date'),'created_id'=>get_current_user_id()));
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
  
  
  function listing($start="",$end=""){
    
     $whr = array("date>=" => $start,"date<=" => $end);
     
     if( get_current_user_role() != 'admin' ){
        $whr['created_id'] = get_current_user_id();
     }
              
     $data = $this->holidays_model->get_where( $whr,"date,reason" )->result_array();
    
     echo json_encode(array('data'=>$data));
  }

}
?>