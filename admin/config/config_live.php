<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Base Site URL
|--------------------------------------------------------------------------
|
| URL to your CodeIgniter root. Typically this will be your base URL,
| WITH a trailing slash:
|
|	http://example.com/
|
|  Depending on how you set it up on your system you may not need to change this.
*/

$root=(isset($_SERVER['HTTPS']) ? "https://" : "http://").$_SERVER['HTTP_HOST'];
$root.= str_replace(basename($_SERVER['SCRIPT_NAME']), '', $_SERVER['SCRIPT_NAME']);
$config['base_url'] = $root;

$config['base_path'] = str_replace("/admin", "", $root);
 
$config['permitted_uri_chars'] = 'a-zA-Z 0-9~%.:_\-@&,()+=';


//$this->output->enable_profiler(true);

