<?php

//
// Layout config for the site admin 
//
                                        

$config['layout']['default']['template'] = 'layouts/frontend';
$config['layout']['default']['title']    = 'Dakbro Incredible Polishing Studio';
$config['layout']['default']['js_dir']    = "/assets/frontend/script";
$config['layout']['default']['css_dir']   = "/assets/frontend/style";
$config['layout']['default']['img_dir']   = "/assets/img";

$config['layout']['default']['javascripts'] = array('dependencies','DateTimePicker.min','load');


$config['layout']['default']['stylesheets'] = array('jquery.qtip', 'jquery-ui.min', 'superfish', 'flexnav', 'DateTimePicker.min', 'fancybox/jquery.fancybox', 'fancybox/helpers/jquery.fancybox-buttons', 'revolution/layers',
	'revolution/settings', 'revolution/navigation', 'icons', 'base', 'responsive','bootstrap.min', 'app'

	);

$config['layout']['default']['description'] = 'We offer all two wheeler polishing serivce.';
$config['layout']['default']['keywords']    = 'Bike Polish, All vehicles';
$config['layout']['default']['og:image']    = 'https://s3.amazonaws.com/prod-dakbro/d2960a/ad9fa9f0-196a-11e8-b215-5560f05b3485_1519480660495.jpg';
$config['layout']['default']['viewport'] 	= 'width=device-width, initial-scale=1, maximum-scale=1';

$config['layout']['default']['http_metas'] = array(
    'content-type' => 'text/html; charset=utf-8'
);


?>
