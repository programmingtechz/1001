<?php
class MY_Loader extends CI_Loader {

    public function __construct()
    {
        parent::__construct();
        // Custom Code 
        // $this->_ci_model_paths 	= array(APPPATH, COREPATH);
        // $this->_ci_helper_paths = array(APPPATH, BASEPATH, COREPATH);
        // $this->_ci_library_paths =	array(APPPATH, BASEPATH,COREPATH);
      	$this->_ci_view_paths = array_merge($this->_ci_view_paths, array(APPPATH.'views/' => TRUE, COREPATH.'views/' => TRUE));
    }
}