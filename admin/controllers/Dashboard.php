<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once(COREPATH."controllers/Admin_controller.php");

class dashboard extends Admin_Controller
{
  function __construct()
  {
    parent::__construct();
    
    $this->load->model('shops_model');
    $this->load->model('sales_order_model');
  }

  public function index()
  {
    //$this->output->enable_profiler(TRUE);
    $this->layout->add_javascripts(array('dashboard',
        'bower_components/morris.js/morris.min',
        'bower_components/raphael/raphael.min',
        'fullcalendar.min'
    ));
    $this->layout->add_stylesheets(array('bower_components/morris.js/morris','fullcalendar.min'));
    
    $this->data['shop_list'] =  $this->get_shoplist();
    $this->layout->view('/dashboard');
  }
  
  
  public function get_list(){
    
    $action = $this->input->post('action');
    $shop_id = $this->input->post('shop_id');
    
    $data = array();
    switch( $action ){
        case "order_stats":
        $data = $this->get_orders_stats( $shop_id );
        break;
        case "latest_orders":
            $data = $this->get_latest_orders( $shop_id );
        break;
        case "cal_orders":
            $data = $this->get_latest_orders( $shop_id );
        break;
        case "orders_line":
        break;
        case "orders_pie":
        $data = $this->get_orders_pie_graph( $shop_id );
        break;
    }
    
    echo json_encode(array('status'=>"SUCCESS",'data'=>$data));
    
  }
  public function get_orders_stats( $shop_id ){
    
    $data = array();
    $data['totalOrders'] =  $this->get_totalOrders_count( $shop_id );
    $data['pendingOrders'] =  $this->get_totalpendingOrders_count( $shop_id );
    $data['CompletedOrders'] =  $this->get_totalCompletedOrders_count( $shop_id );
    $data['totalAmount'] =  $this->get_totalordersAmount( $shop_id );
    
    return $data;
  }
  
  public function get_totalOrders_count( $shop_id ="all" ){
    $shop_id = ( $shop_id && $shop_id != 'all')?$shop_id:"";
    $where = array();
    $shops = $this->sales_order_model->get_totalOrders_count($shop_id);
    
    return $shops;
  }
  
  public function get_totalpendingOrders_count( $shop_id ="all",$start ="",$end="" ){
    $shop_id = ( $shop_id && $shop_id != 'all')?$shop_id:"";
    $where = array();
    $shops = $this->sales_order_model->get_totalpendingOrders_count($shop_id,$start,$end);
    
    return $shops;
  }
  
  public function get_totalCompletedOrders_count( $shop_id ="all",$start="",$end=""){
    $shop_id = ( $shop_id && $shop_id != 'all')?$shop_id:"";
    $where = array();
    $shops = $this->sales_order_model->get_totalCompletedOrders_count($shop_id,$start,$end);
    
    return $shops;
  }
  
  public function get_totalordersAmount( $shop_id ="all"){
    $shop_id = ( $shop_id && $shop_id != 'all')?$shop_id:"";
    $where = array();
    $shops = $this->sales_order_model->get_totalordersAmount($shop_id);
    
    return $shops;
  }
  
  public function get_shoplist(){
    
    $where = array();
    $shops = $this->shops_model->get_shop_list_by_user('shops.id,shops.name,a.name as Area');
    
    return $shops;
  }
  
  public function get_total_revenue( $shop ="all" ){
    
  }
  
  public function get_orders_line_graph( $shop ="all" ){
    
  }
  
  public function get_orders_pie_graph( $shop_id ="all" ){
    
    $data =array();
    $start = $this->input->post('start_date');
    $end = $this->input->post('end_date');
    
    $data['pendingOrders'] =  $this->get_totalpendingOrders_count( $shop_id,$start,$end );
    $data['CompletedOrders'] =  $this->get_totalCompletedOrders_count( $shop_id,$start,$end );
    
    $output = array();
    
    $output[] = array('label' => 'Pending Orders','value' => $data['pendingOrders']);
    $output[] = array('label' => 'Completed Orders','value' => $data['CompletedOrders']);
    return $output;
  }
  
  public function get_latest_orders( $shop_id ="all" ){
    
    $start = $this->input->post('start_date');
    $end = $this->input->post('end_date');
    $shop_id = ( $shop_id && $shop_id != 'all')?$shop_id:"";
    
    $data = $this->sales_order_model->get_latest_sales_orders( $shop_id,$start,$end );
    
    return $data;
    
  }
 
  
}
?>