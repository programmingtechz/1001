<?php
//
// Layout config for the site admin 
//
$config['layout']['default']['template'] = 'layouts/frontend';
$config['layout']['default']['title']    = 'Dakbro - Admin';
$config['layout']['default']['js_dir']   = "assets/admin";
$config['layout']['default']['css_dir']  = "assets/admin";
$config['layout']['default']['img_dir']  = "assets/images";

$config['layout']['default']['javascripts'] = array(
												'bower_components/jquery/dist/jquery.min',
												'bower_components/jquery-ui/jquery-ui.min',
												'bower_components/bootstrap/dist/js/bootstrap.min',
												// 'bower_components/raphael/raphael.min',
												// 'bower_components/morris.js/morris.min',
												// 'bower_components/jquery-sparkline/dist/jquery.sparkline.min',
												// 'plugins/jvectormap/jquery-jvectormap-1.2.2.min',
												// 'plugins/jvectormap/jquery-jvectormap-world-mill-en',
												// 'bower_components/jquery-knob/dist/jquery.knob.min',
												'bower_components/moment/min/moment.min',
												'bower_components/bootstrap-daterangepicker/daterangepicker',
												'bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min',
												'plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min',
												'bower_components/jquery-slimscroll/jquery.slimscroll.min',
												'bower_components/fastclick/lib/fastclick',
                                                'bower_components/select2/dist/js/select2.min',
												'dist/js/adminlte.min',
												'typeahead',
                                                'AjaxUpload',
                                                'helper',
                                                'config',
                                                'requiredjs'
												//'dist/js/pages/dashboard',
												//'dist/js/demo'
											);

$config['layout']['default']['stylesheets'] = array(
												'bower_components/bootstrap/dist/css/bootstrap.min',
                                                'bower_components/select2/dist/css/select2.min',
												'bower_components/font-awesome/css/font-awesome.min',
												'bower_components/Ionicons/css/ionicons.min',
												'dist/css/AdminLTE.min',
												'dist/css/skins/_all-skins.min',
												'bower_components/datatables.net-bs/css/dataTables.bootstrap.min',
												//'bower_components/jvectormap/jquery-jvectormap',
												'bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min',
												'bower_components/bootstrap-daterangepicker/daterangepicker',
												'plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min',
												'style'
												);

$config['layout']['default']['description'] = '';
$config['layout']['default']['keywords']    = '';
$config['layout']['default']['http_metas'] = array(
	'X-UA-Compatible' => 'IE=edge',
  'Content-Type' => 'text/html; charset=utf-8',
	'viewport'     => 'width=device-width, initial-scale=1.0',
  'author' => 'Dakbro - Admin');
?>