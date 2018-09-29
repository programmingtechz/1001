<?php

if ( ! function_exists('base_path'))
{
	/**
	 * Base URL
	 *
	 * Create a local URL based on your basepath.
	 * Segments can be passed in as a string or an array, same as site_url
	 * or a URL to a file can be passed in, e.g. to an image file.
	 *
	 * @param	string	$uri
	 * @param	string	$protocol
	 * @return	string
	 */
	function base_path($uri = '', $protocol = NULL)
	{
		return get_instance()->config->base_path($uri, $protocol);
	}
}

function gen_uuid() {
    
    $uuid = sprintf( '%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
        // 32 bits for "time_low"
        mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ),

        // 16 bits for "time_mid"
        mt_rand( 0, 0xffff ),

        // 16 bits for "time_hi_and_version",
        // four most significant bits holds version number 4
        mt_rand( 0, 0x0fff ) | 0x4000,

        // 16 bits, 8 bits for "clk_seq_hi_res",
        // 8 bits for "clk_seq_low",
        // two most significant bits holds zero and one for variant DCE1.1
        mt_rand( 0, 0x3fff ) | 0x8000,

        // 48 bits for "node"
        mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff )
    );
    
    $uuid = uniqid($uuid);
    return $uuid;
}

function is_logged_in()
{
    $CI = get_instance();
    
    $user_data = get_user_data();
    
    if( is_array($user_data) && $user_data )
        return TRUE;

    return FALSE;

}


function get_current_user_id()
{
    $CI = & get_instance();
    
    $current_user = get_user_data();
    
    if(!empty($current_user)) {
        return $current_user['id'];
    }

    return FALSE;
}
function get_user_data()
{
    $CI = get_instance();
    
        
    if($CI->session->userdata('user_data'))
    {
        return $CI->session->userdata('user_data');
    }
    else
    {
        return FALSE;
    }
}

function get_user_role( $user_id = 0 )
{
    $CI= & get_instance();
    
    if(!$user_id) 
    {
        $user_data = get_user_data();
        return $user_data['role'];
    }   
    
    $CI->load->model('user_model');
    $row = $CI->user_model->get_where(array('id' => $user_id))->row_array;

    if( !$row )
        return FALSE;

    return $row['role'];
}

function get_users_list( $where = array(), $select = ' name,id'){
    
    $CI= & get_instance();
    
    $CI->load->model('users_model');
    $result = $CI->users_model->get_where($where,$select);
    
    return $result->result_array();
}

function get_user_name()
{
    $udata = get_user_data();
    $name = '';
    if( is_array($udata) && count($udata) )
    {
        $name = $udata['name'];
    }

    return $name;
}

function get_profile_image()
{
    $udata = get_user_data();
        
    $pimage = '';
    if( is_array($udata) && count($udata) )
    {
        $pimage = $udata['image'];
    }

    if( $pimage == '' )
    {
        $pimage = include_img_path().'/admin-icon.png';
    }else{
        
        $user_img = json_decode($pimage,true);
        $pimage =include_img_path().'/admin-icon.png';
        
        if( isset($user_img[0]['s3_url']))
            $pimage=  "https://s3.amazonaws.com/".$user_img[0]['s3_url'];
    }

    return $pimage;
}

function get_roles()
{
    $CI = & get_instance();
    $CI->load->model('role_model');
    $records = $CI->role_model->get_roles();

    $roles = array();
    foreach ($records as $id => $val) 
    {
        $roles[$id] = $val;
    }

    return $roles;
}

function get_admin_emails() {
    
     $CI= & get_instance();
     
     $output = array();
     $sql = "SELECT * FROM `users` WHERE role='admin'";
     $admins = $CI->db->query($sql)->result_array();

     foreach ($admins as $admin) {
        $output[] = $admin['email'];
     }

     return $output;
}

function display_flashmsg($flash){

    if(!$flash)
        return FALSE;

    $status = $msg = '';

    if(isset($flash['success_msg'])){
        $status = 'success';
        $msg = $flash['success_msg'];
    }

    if(isset($flash['error_msg'])){
        $status = 'danger';
        $msg = $flash['error_msg'];
    }

    if($status && $msg){
        $str = '<div id="div_service_message" class="Metronic-alerts alert alert-'.$status.' fade in">';
        $str.= '<button class="close" aria-hidden="true" data-dismiss="alert" type="button"><i class="fa-lg fa fa-warning"></i></button>';
        
        if($status == 'danger')
            $status = 'error';
        $str.='<strong>'.ucfirst($status).':&nbsp;</strong> '. strip_tags($msg) .' </div>';

        echo $str;
    }

}


function displayData($data = null, $type = 'string', $row = array(), $wrap_tag_open = '', $wrap_tag_close = '')
{
     $CI = & get_instance();
     
    if(is_null($data) || is_array($data) || (strcmp($data, '') === 0 && !count($row)) )
        return $data;
    
    switch ($type)
    {
        case 'string':
            break;
        case 'humanize':
        $CI->load->helper("inflector");
            $data = humanize($data);
            break;
        case 'date':
            $data = str2USDate($data);
            break;
        case 'datetime':
            $data = str2USDate($data);
            break;
        case 'money':
            $data = numberToCurrency($data);
            break;
         case 'ucwords':
            $data = ucwords($data);
            break;
         case 'role':
            $roles = get_user_roles();
            foreach( $roles as $key => $val ){
                
                if( $data == $val['id']){
                    $data= $val['name'];
                    break;
                }
                
            }
            $data = ucwords($data);
            break;
    }
    
    return $wrap_tag_open.$data.$wrap_tag_close;
}

function numberToCurrency($number = 0)
{
    if(setlocale(LC_MONETARY, 'en_IN'))
      return money_format('%.0n', $number);
    else {
      $explrestunits = "" ;
      $number = explode('.', $number);
      $num = $number[0];
      if(strlen($num)>3){
          $lastthree = substr($num, strlen($num)-3, strlen($num));
          $restunits = substr($num, 0, strlen($num)-3); // extracts the last three digits
          $restunits = (strlen($restunits)%2 == 1)?"0".$restunits:$restunits; // explodes the remaining digits in 2's formats, adds a zero in the beginning to maintain the 2's grouping.
          $expunit = str_split($restunits, 2);
          for($i=0; $i<sizeof($expunit); $i++){
              // creates each of the 2's group and adds a comma to the end
              if($i==0)
              {
                  $explrestunits .= (int)$expunit[$i].","; // if is first value , convert into integer
              }else{
                  $explrestunits .= $expunit[$i].",";
              }
          }
          $thecash = $explrestunits.$lastthree;
      } else {
          $thecash = $num;
      }
      if(!empty($number[1])) {
        if(strlen($number[1]) == 1) {
            return '&#8377; ' .$thecash . '.' . $number[1] . '0';
        } else if(strlen($number[1]) == 2){
            return '&#8377; ' .$thecash . '.' . $number[1];
        } else {
            return 'cannot handle decimal values more than two digits...';
        }
      } else {
        return '&#8377; ' .$thecash.'.00';
      }
    }
}

function strToDate( $str = '', $format = 'd M Y' )
{
    $intTime = strtotime($str);

    if ($intTime === false) return NULL;

    return date($format, $intTime);

}







function str2USDate($str)
{
    $intTime = strtotime($str);
    if ($intTime === false)
         return NULL;
    return date("m/d/Y H:i:s", $intTime);
}

function str2USDT($str)
{
    $intTime = strtotime($str);
    if ($intTime === false)
         return NULL;
    return date("m/d/Y", $intTime);
}

    // no logic for server time to local time.
function str2DBDT($str=null)
{
    $intTime = (!empty($str))?strtotime($str):time();
    if ($intTime === false)
         return NULL;
    return date("Y-m-d H:i:s", $intTime);
}

function str2DBDate($str)
{
    $intTime = strtotime($str);
    if ($intTime === false)
        return NULL;
    return date("Y-m-d",$intTime);
}

function addDayswithdate($date,$days){

    $date = strtotime("+".$days." days", strtotime($date));
    return  date("m/d/Y", $date);

}

function day_to_text($date) {
    
    $day_no = date("N",strtotime($date));
    
    $day_array = array(1 => "Monday" , 2 => "Tuesday" , 3 => "Wednesday" , 4 => "Thursday" , 5 => "Friday" , 6 => "Saturday" , 7 => "Sunday"  );
    
    return $day_array[$day_no];
}

   
function update_usermeta($key = '',$value = '',$user_id = '') {
    
    if(!$key || !$user_id)
        return false;
        
    $CI = & get_instance();    
    $CI->load->model('user_model');
    
    $meta_row = $CI->user_model->get_where(array('meta_key' => $key, 'user_id' => $user_id),"*",'usermeta');
    
    $data = $return_data = array();
    $data['meta_value'] = $value;
    $data['updated_id'] = getAdminUserId();
    $data['updated_time'] = date('Y-m-d', local_to_gmt());
    
    if($meta_row->num_rows() > 0){
        $meta_row_data = $meta_row->row_array();
        $return_data['prev_value'] = $meta_row_data['meta_value'];
        $CI->user_model->update(array('umeta_id' => $meta_row_data['umeta_id']),$data,'usermeta');
        $return_data['id'] = $meta_row_data['umeta_id'];
        $return_data['status'] =  "update";
        
    }
    else
    {
        $data['meta_key'] = $key;
        $data['user_id'] = $user_id;
        $data['created_id'] = getAdminUserId();
        $data['created_time'] = date('Y-m-d', local_to_gmt());
        $umeta_id = $CI->user_model->insert($data,'usermeta');
        $return_data['id'] = $umeta_id;
        $return_data['status'] =  "add";
    }
    
    return $return_data;
    
}


function get_usermeta($key = '',$user_id = '') {
    
    if(!$key || !$user_id)
        return false;
        
    $CI = & get_instance();    
    $CI->load->model('user_model');
    $meta_row = $CI->user_model->get_where(array('meta_key' => $key, 'user_id' => $user_id),"*",'usermeta');
      
    if($meta_row->num_rows() > 0){
        $meta_row_data = $meta_row->row_array();
    
        return $meta_row_data['meta_value'];
    }
    else
    {
        return false;
    }
}



function xml_obj_to_array($xml_obj) {
        
            $json = json_encode($xml_obj,TRUE);
            $arr = json_decode($json,TRUE);
        
        return $arr;                     
}



function site_traffic()
{
    $CI = & get_instance();
    
    
}


function actionLogAdd($type,$id = NULL, $action)
{
    $CI = & get_instance();
    $CI->load->model('log_model');
    $CI->log_model->add($type,$id,$action);
}

function is_valid_product($product_id = 0)
{
    $CI->db->load->model('product_model');

    $result = $CI->db->product_model->get_where(array('id' => $product_id));

    return $result->num_rows()?TRUE:FALSE;
}

function is_valid_user($user_id = 0)
{
    $CI->db->load->model('user_model');

    $result = $CI->db->user_model->get_where(array('id' => $user_id));

    return $result->num_rows()?TRUE:FALSE;
}

function get_cms_content($where='',$table='')
{
  $CI = & get_instance();
  $CI->db->where($where);
  $q = $CI->db->get($table);
  return $q->row_array();
}

function get_sys_settings($where='',$table='')
{
  $CI = & get_instance();
  if($where)
    $CI->db->where($where);
  $q = $CI->db->get("settings");
  return $q->row_array();
  
}

/* get cache*/
function get_cache_data( $key ){
     
     $CI = & get_instance();
    
     return $CI->cache->file->get( $key );
}

/* set cache*/
function set_cache_data( $key, $val, $timeout = 1800 ){
    
     $CI = & get_instance();
     
     $CI->cache->file->save( $key,$val,$timeout );
}
/* logged in user cache id get*/
function get_cache_id(){
    
     $CI = & get_instance();
   
     $session_data = $CI->session->all_userdata();
     
     return $session_data['cache_id'];
}
/* logged in user id get*/
function get_user_id(){
    
     $CI = & get_instance();
   
     $session_data = $CI->session->all_userdata();
     
     return $session_data['user_data']['id'];
}
function get_current_user_role(){
    
     $CI = & get_instance();
   
     $session_data = $CI->session->all_userdata();
     
     return $session_data['user_data']['role'];
}


/**
 * To get logged in users settings
 * 
 * Available variables
 * 
 * user_image
 *user_role
 *user_parent_id
 *user_tz
 *user_language
 *user_email
 *user_id
 *user_name
 *country_code
 *country_name
 *country_id
 *state_code
 *state_name
 *state_id
 *citycode
 *city_name
 *city_id
 *areacode
 *area_name
 *area_id
 */
function all_settings( $key ) {
    
    $CI = & get_instance();
    $cache_key = get_cache_id().'user_info';
    $cache_data = get_cache_data( $cache_key );
   
    if( $cache_data ) {
        $all_settings = $cache_data;
        
    }else{
        
        $CI->load->model('users_model');
        $user_information = $CI->users_model->get_user_information_by_id( get_user_id() );
        
        set_cache_data( $cache_key ,$user_information);
        
        $all_settings = $user_information;
    }
    
    
    if( $key ){
        return (isset($all_settings[$key]))?$all_settings[$key]:"";
    }
    
    return $all_settings;
}


function add_created_info( $data,$is_edit = false ){
    
    if( empty($is_edit) ){
       $data['created_id'] = all_settings('user_id');
       $data['created_time'] = date("Y-m-d H:i:s");
       $data['id'] = gen_uuid();
    }
    
    $data['updated_id'] = all_settings('user_id');
    $data['updated_time'] = date("Y-m-d H:i:s");
    
    return $data;
}


function add_fields( $fields ) {
    
    $field_str ="";
    
    for($i =0; $i < count($fields); $i++ ){
        
        $name = $fields[$i]['name'];
        $type = $fields[$i]['type'];
        $label = $fields[$i]['label'];
        $value = $fields[$i]['value'];
        $options = (isset($fields[$i]['options']))?$fields[$i]['options']:array();
        $id = (isset($fields[$i]['id']))?'id="'.$fields[$i]['id'].'"':'';
        $attributes = (isset($fields[$i]['attributes']))?$fields[$i]['attributes']:"";
        $format = (isset($fields[$i]['format']))?$fields[$i]['format']:"";
        $class =(isset($fields[$i]['class']))?$fields[$i]['class']:"";
        
        $field_str .= '<div class="form-group '. (form_error('name')? 'has-error':'') .'" >';
        $field_str .= '<label for="'. $name .'" class="col-sm-2 control-label">'. $label .'</label>';
        $field_str .= '<div class="col-sm-10">';
        
        switch( $type ){
            
            case 'text':
            case 'email':
            case 'tel':
            case 'hidden':
                $field_str .= '<input type="'.$type.'" '. $attributes .' class="form-control '.$class.'" name="'.$name.'" '.$id.' placeholder="'.$label.'" value="'.$value.'">';
                break;
            case 'textarea':
                $field_str .= '<textarea '. $attributes .' class="form-control '.$class.'" name="'.$name.'" '.$id.' placeholder="'.$label.'" >'.$value.'</textarea>';
                break;
            case 'selectdropdown':
            
                $field_str .= '<select class=" w350 js-example-basic-single '.$class.'" name="'.$name.'">';
                
                foreach( $options as $key => $val ){
                    $selected = "";
                    
                    if( $val['id'] == $value ){
                        $selected = 'selected=selected';
                    }
                    $field_str .= '<option '.$selected .' value="'.$val['id'].'">'.$val['name'].'</option>';
                }
                
                $field_str .= '</select>';
                
                break;
            case 'upload':
                
                $maxsize= ( isset($fields[$i]['max-size']) )?' data-max-size="'.$fields[$i]['value'].'"':"";
                $maxwidth = ( isset($fields[$i]['max-width']) )?' data-max-width="'.$fields[$i]['max-width'].'"':"";
                $maxheight = ( isset($fields[$i]['max-height']) )?' data-max-height="'.$fields[$i]['max-height'].'"':"";
                $maxuploads = ( isset($fields[$i]['max-upload']) )?' data-max-upload="'.$fields[$i]['max-upload'].'"':"";
                $reset_exist_file = ( isset($fields[$i]['update-exist-file']) )?' data-update-exist-file="'.$fields[$i]['update-exist-file'].'"':"";
                
                $field_str .='<div class="dakUpload '.$class.'" '.$maxsize.$maxwidth.$maxheight.$maxuploads.$reset_exist_file.'> <div class="btn btn-info"></div> <div class="up-progress"></div><div class="post-media"></div><textarea name="'.$name.'" >'.$value.'</textarea></div>';
                break;
        }
        
        $field_str .= '<span class="format">'.$format.'</span>';
        $field_str .= form_error($name);
        $field_str .='</div>';
        $field_str .='</div>';
    }
    
    return $field_str;
}
/**
 * To check key from given array
 * $data => array
 * $key => string 
 */
function safe_value_isset( $data , $key ){
        
    if( isset($data[$key])){
        return $data[$key];
    }
    else {
        return "";
    }    
}

function get_countries( $where = array(), $select = ' name,id'){
    
    $CI= & get_instance();
    
    $CI->load->model('countries_model');
    $result = $CI->countries_model->get_where($where,$select);
    
    return $result->result_array();
}

function get_services( $where = array('type' =>'bike'), $select = ' name,id',$add_empty_row = true){
    
    $CI= & get_instance();
    
    $CI->load->model('services_model');
    $CI->db->order_by('order_no','ASC');
    $result = $CI->services_model->get_where($where,$select);
    
    $data =  $result->result_array();
    
    if( $add_empty_row )
        array_unshift($data,array('id'=>"","name"=>""));
    
    return $data;
}

function get_testimonials( $where = array(), $select = ' name,message'){
    
    $CI= & get_instance();
    
    $CI->load->model('testimonials_model');
    $result = $CI->testimonials_model->get_where($where,$select);
    
    $data =  $result->result_array();
    
    return $data;
}

function get_vehicles( $where = array('type' =>'bike'), $select = "name,id"){
    
    $CI= & get_instance();
    
    $CI->load->model('vehicles_model');
    $CI->db->order_by('order_no','ASC');
    $result = $CI->vehicles_model->get_where($where,$select);
    
    $data =  $result->result_array();
    
    array_unshift($data,array('id'=>"","name"=>""));
    
    return $data;
}

function get_states( $where = array(), $select = ' name,id'){
    
    $CI= & get_instance();
    
    $CI->load->model('states_model');
    $result = $CI->states_model->get_where($where,$select);
    
    return $result->result_array();
}


function get_cities( $where = array(), $select = ' name,id'){
    
    $CI= & get_instance();
    
    $CI->load->model('cities_model');
    $result = $CI->cities_model->get_where($where,$select);
    
    return $result->result_array();
}

function get_areas( $where = array(), $select = ' name,id'){
    
    $CI= & get_instance();
    
    $CI->load->model('areas_model');
    $result = $CI->areas_model->get_where($where,$select);
    
    return $result->result_array();
}

function get_user_roles(){
     $CI= & get_instance();
    return $CI->config->item('roles');
}

function get_user_status(){
     $CI= & get_instance();
     return $CI->config->item('user_status');
}

function get_tz(){
    $CI= & get_instance();
    return $CI->config->item('tz');
}

function get_language(){
    $CI= & get_instance();
    return $CI->config->item('user_language');
}

function get_vehicles_type(){
    $CI= & get_instance();
    return $CI->config->item('vehicles_list');
}

function get_pages_list(){
     $CI= & get_instance();
    return $CI->config->item('pages_list');
}
function get_yes_no(){
     $CI= & get_instance();
    return $CI->config->item('get_yes_no');
}

function get_days_list(){
    $CI= & get_instance();
    return $CI->config->item('days_list');
}

function get_current_page()
{
    $CI= & get_instance();
    $class = $CI->router->fetch_class();
    $method = $CI->router->fetch_method();
    
    $page ='';
    
    if( $class == 'home' && $method == 'index'){
        $page ='home';
    }
    else if( $class == 'contact' && $method == 'index'){
        $page ='contact';
    }
    else if( $class == 'gallery' && $method == 'index'){
        $page ='gallery';
    }
     else if( $class == 'services' && ($method == 'index' || $method == 'detail')){
        $page ='services';
    }
     else if( $class == 'booking' && $method == 'index'){
        $page ='booking';
    }
    else if( $class == 'shops' && $method == 'index'){
        $page ='shops';
    }
    else if( $class == 'account'){
        $page ='account';
    }
     else if( $class == 'terms'){
        $page ='terms';
    }
    else if( $class == 'about'){
        $page ='about';
    }
    
    return $page;
    
}
function get_sliders(){

    $CI= & get_instance();
    $page = get_current_page();
    $output = array();
    
    if( empty($page)) return $output;
    

    $CI->load->model('sliders_model');
    $result = $CI->sliders_model->get_where(array('name'=>$page),"id");
    
    $data =  $result->row_array();
   
    if( !empty($data) ){
        
        $CI->load->model('slider_images_model');
        $result = $CI->slider_images_model->get_where(array('slider_id'=>$data['id']));
        
        $output =  $result->result_array();
        
    }
    return $output;
}

function get_page_meta(){
    $CI= & get_instance();
    $page = get_current_page();
    $output = array();
    
    if( empty($page)) return $output;
    
    
    $CI->load->model('pagesettings_model');
    $result = $CI->pagesettings_model->get_where(array('name'=>$page),"*");
    
    $data =  $result->row_array();
    
    return $data;
    
}

function get_best_price_services_by_vehicles(){
    
     $CI= & get_instance();
     
     $output = array();
     $CI->load->model('vehicles_model');
     $CI->load->model('shop_services_model');
     $CI->db->order_by('order_no','ASC');
     $vehicles = $CI->vehicles_model->get_where(array('type' =>'bike'),"id,name,image,hover_image")->result_array();
     $output['vehicles'] = $vehicles;
     foreach( $vehicles as $k => $v ){
        $services = $CI->db->query("select b.*,shops.area_id from best_price_services b join shops on shops.id = b.shop_id where vehicle_id='".$v['id']."' group by service_id order by service_order asc")->result_array();
        $output['services'][$v['id']] = $services;
     }
     return $output;
}

function is_front_end_logged_in(){
    
    $CI = get_instance();
    
        
    if($CI->session->userdata('logged_user_data'))
    {
        return $CI->session->userdata('logged_user_data');
    }
    else
    {
        return FALSE;
    }
}

function validateEmail($email)
{
	if(!preg_match('/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$/i',$email,$result)) return(false);
	else return(true);
}

/******************************************************************************/

function validateTime($value,$empty=false)
{
	if(($empty) && ($this->isEmpty($value))) return(true);

	if(!preg_match('/^[01]?[0-9]|2[0-3]:[0-5][0-9]$/i',$value)) return(false);

	return(true);
}

/******************************************************************************/

function validateDate($value,$empty=false)
{
	if(($empty) && ($this->isEmpty($value))) return(true);

	$date=preg_split('/-/',$value);

	if(isset($date[0],$date[1],$date[2]))
		return(checkdate($date[1],$date[0],$date[2]));

	return(false);
}

/******************************************************************************/

function verifyEmail($toemail,$fromemail,$getdetails=false)
{
	$email_arr=explode("@",$toemail);
	$domain=array_slice($email_arr,-1);
	$domain=$domain[0];

	$domain=ltrim($domain,"[");
	$domain=rtrim($domain,"]");

	$details=null;
	
	if("IPv6:"==substr($domain,0,strlen("IPv6:")))
	{
		$domain=substr($domain,strlen("IPv6") +1);
	}

	$mxhosts=array();
	if( filter_var($domain,FILTER_VALIDATE_IP))
		$mx_ip=$domain;
	else
		getmxrr($domain,$mxhosts,$mxweight);

	if(!empty($mxhosts))
		$mx_ip=$mxhosts[array_search(min($mxweight),$mxhosts)];
	else 
	{
		if(filter_var($domain,FILTER_VALIDATE_IP,FILTER_FLAG_IPV4))
		{
			$record_a=dns_get_record($domain,DNS_A);
		}
		elseif( filter_var($domain,FILTER_VALIDATE_IP,FILTER_FLAG_IPV6))
		{
			$record_a=dns_get_record($domain,DNS_AAAA);
		}

		if(!empty($record_a))
			$mx_ip=$record_a[0]['ip'];
		else 
		{
			$result=false;
			$details.="No suitable MX records found.";
			return((true==$getdetails) ? array($result,$details) : $result);
		}
	}
	
	$connect=@fsockopen($mx_ip,25); 
	if($connect)
	{ 
		if(preg_match("/^220/i",$out=fgets($connect,1024)))
		{
			fputs ($connect,"HELO $mx_ip\r\n"); 
			$out=fgets ($connect,1024);
			$details.=$out."\n";
 
			fputs($connect,"MAIL FROM: <$fromemail>\r\n"); 
			$from=fgets($connect,1024); 
			$details.=$from."\n";

			fputs($connect,"RCPT TO: <$toemail>\r\n"); 
			$to=fgets($connect,1024);
			$details.=$to."\n";

			fputs($connect,"QUIT"); 
			fclose($connect);

			if(!preg_match("/^250/i",$from) || !preg_match("/^250/i",$to))
			{
				$result=false; 
			}
			else
			{
				$result=true;
			}
		} 
	}
	else
	{
		$result=false;
		$details.="Could not connect to server";
	}
	if($getdetails)
	{
		return array($result,$details);
	}
	else
	{
		return $result;
	}
}

function send_sms( $numbers =array(),$message){
    $CI= & get_instance();
    $apiKey = urlencode($CI->config->item('txttolocal'));
	
	// Message details
	$sender = urlencode('DAKBRO');
	$message = rawurlencode($message);
 
	$numbers = implode(',', $numbers);
 
	// Prepare data for POST request
	$data = array('apikey' => $apiKey, 'numbers' => $numbers, "sender" => $sender, "message" => $message);
 
	// Send the POST request with cURL
	$ch = curl_init('https://api.textlocal.in/send/');
	curl_setopt($ch, CURLOPT_POST, true);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$response = curl_exec($ch);
	curl_close($ch);
	
    $response = json_decode($response,true);
    
    $output = false;
    
    if( isset( $response['status']) && $response['status'] == 'failure'){
        
    }else{
        $output = true;
    }
	// Process your response here
	return $output;
}

function create_short_link($long_url,$type = 'bitly'){
    
    $output = "";
    $CI= & get_instance();
    
    if( $type == 'bitly'){
        $apiKey = $CI->config->item('bitlyToken');

        $bitly = file_get_contents('https://api-ssl.bitly.com/v3/shorten?longUrl='.urlencode($long_url).'&domain=bit.ly&format=json&access_token='.$apiKey);
    
        $shortDWName = json_decode($bitly,true);
        
        $output= ( isset($shortDWName['status_code']) && $shortDWName['status_code'] == 200 && isset($shortDWName['data']['url']) )?$shortDWName['data']['url']:'';
    }
    
    return $output;                       
}

function get_google_form_link($phone="",$order_no="",$shop=""){
    $CI= & get_instance();
    $googleUrl = $CI->config->item('googleUrl');
    $str = $googleUrl."?entry.104410027=".$phone."&entry.715125242=".$order_no."&entry.1897304267=".$shop;
    return $str;
}

?>