<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require_once(COREPATH."controllers/App_controller.php");

class Shops extends App_Controller {
    
  function __construct()
  {
    parent::__construct();
  }

  public function index( $service_id = "",$pickup="yes",$area="")
  {        
      $this->data['header'] = $this->load->view('_partials/header', $this->data, TRUE);
      $this->data['footer'] = $this->load->view('_partials/footer', $this->data, TRUE);
      
      $this->load->model('shops_model');
      $this->data['vehicles'] = get_vehicles();
      $this->data['areas'] = get_areas();
      $data = $this->security->xss_clean($this->input->post());
      if( !isset($data['vehicle']) ){

        $data['vehicle'] = $this->data['vehicles'][1]['id'];
      }
      if( !isset($data['area']) ){

        $data['area'] = $this->data['areas'][0]['id'];
      }
      if(!empty($data))
       {
            $this->data['post_data'] = $data;
      }
      $this->db->select("shops.*,ss.price,ss.discount,ss.vehicle_id,areas.name as area,ss.vehicle_id");
      $this->db->join('shops', 'shops.id = ss.shop_id', 'left',false);
      $this->db->join('areas', 'areas.id = shops.area_id', 'left',false);
      
      
      if( isset($data['areas']) && !empty($data['area'])){
       // $this->db->where();
      }
      if( isset($data['vehicle']) && !empty($data['vehicle'])){

       // $this->db->where();
      }
      if( isset($data['pickup']) && $data['pickup'] == 'yes' ){
        $this->db->where('shops.pickup','yes');
      }
      
      $where = array('ss.service_id'=>$service_id,'shops.pickup'=>$pickup,'ss.vehicle_id'=>$data['vehicle'],'areas.id'=>$data['area']);
      
      if( !empty($area) )
        $where["shops.area_id"] =$area;
        
      $this->db->where($where);
      $this->db->group_by('shops.id'); 
      
      if( isset($data['sort_val']) && $data['sort_val'] == 'sort_price' ){
        $this->db->order_by('ss.price','DESC');
      }
      
      if( isset($data['sort_val']) && $data['sort_val'] == 'sort_ratings' ){
        $this->db->order_by('shops.ratings','DESC');
      }
      
      $shop_list = $this->db->get('shop_services as ss')->result_array();
      
      $service_data = get_services(array('id'=>$service_id),'*',false);
      $service_data = (isset($service_data[0]))?$service_data[0]:array();
      
      
      
     
        
      $this->data['service'] = $service_data;
      $this->data['shops'] = $shop_list;
      
      
      $this->data['pickup'] = $pickup;
      if( empty( $service_data )){
        redirect('services');
      }
      $this->layout->view('shops');
  }
      
      
}
