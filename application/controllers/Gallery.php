<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require_once(COREPATH."controllers/App_controller.php");

class Gallery extends App_Controller {
    
  function __construct()
  {
    parent::__construct();
    $this->load->model('gallery_model');
    $this->load->model('gallery_images_model');
  }

  public function index()
  {   
        
      $gallery = $this->gallery_model->get_where(array(),'name')->result_array();
      
      $this->db->join('gallery', 'gallery.id = gallery_images.gallery_id', 'left',false);
      $gallery_images = $this->gallery_images_model->get_where(array(),'gallery_images.*,gallery.name as gallery_name')->result_array();
      
      $this->data['gallery'] = $gallery;
      $this->data['gallery_images'] = $gallery_images;
      
      $this->data['header'] = $this->load->view('_partials/header', $this->data, TRUE);
      $this->data['footer'] = $this->load->view('_partials/footer', $this->data, TRUE);
      $this->layout->view('gallery');
  }
      
      
}
