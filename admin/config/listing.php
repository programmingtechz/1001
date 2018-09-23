<?php
/*
 * view - the path to the listing view that you want to display the data in
 * 
 * base_url - the url on which that pagination occurs. This may have to be modified in the 
 * 			controller if the url is like /product/edit/12
 * 
 * per_page - results per page
 * 
 * order_fields - These are the fields by which you want to allow sorting on. They must match
 * 				the field names in the table exactly. Can prefix with table name if needed
 * 				(EX: products.id)
 * 
 * OPTIONAL
 * 
 * default_order - One of the order fields above
 * 
 * uri_segment - this will have to be increased if you are paginating on a page like 
 * 				/product/edit/12
 * 				otherwise the pagingation will start on page 12 in this case 
 * 
 * 
 */

$config['users_index'] = array(
	"view"		=> 	'listing/listing',
	"init_scripts" => 'listing/init_scripts',
	"advance_search_view" => 'pages/users/filter',
	"base_url"	=> 	'/users/index/',
	"per_page"	=>	"20",
	"fields"	=> array(   
						'name'=>array('name'=>'Name', 'data_type' => 'String', 'sortable' => true, 'default_view'=>1),
						'email'=>array('name'=>'Email', 'data_type' => 'string', 'sortable' => true, 'default_view'=>1),
                        'phone'=>array('name'=>'Phone', 'data_type' => 'string', 'sortable' => true, 'default_view'=>1),
                        'role'=>array('name'=>'Role', 'data_type' => 'role', 'sortable' => true, 'default_view'=>1),
                        //'Country'=>array('name'=>'Country', 'data_type' => 'string', 'sortable' => true, 'default_view'=>1),
                        //'State'=>array('name'=>'State', 'data_type' => 'string', 'sortable' => true, 'default_view'=>1),
                        //'City'=>array('name'=>'City', 'data_type' => 'string', 'sortable' => true, 'default_view'=>1),
                        'Area'=>array('name'=>'Area', 'data_type' => 'string', 'sortable' => true, 'default_view'=>1),
                        'Timezone'=>array('name'=>'Timezone', 'data_type' => 'string', 'sortable' => true, 'default_view'=>1),
                        //'Language'=>array('name'=>'Language', 'data_type' => 'string', 'sortable' => true, 'default_view'=>1),
                        'Status'=>array('name'=>'Status', 'data_type' => 'ucwords', 'sortable' => true, 'default_view'=>1)
                        
						 ),

	"default_order"	=> "id",
	"default_direction" => "DESC"
);

$config['contact_index'] = array(
	"view"		=> 	'listing/listing',
	"init_scripts" => 'listing/init_scripts',
	"advance_search_view" => 'pages/users/filter',
	"base_url"	=> 	'/users/index/',
	"per_page"	=>	"20",
	"fields"	=> array(   
						'name'=>array('name'=>'Name', 'data_type' => 'String', 'sortable' => true, 'default_view'=>1),
						'email'=>array('name'=>'Email', 'data_type' => 'string', 'sortable' => true, 'default_view'=>1),
                        'phone'=>array('name'=>'Phone', 'data_type' => 'string', 'sortable' => true, 'default_view'=>1),
                        'subject'=>array('name'=>'Subject', 'data_type' => 'string', 'sortable' => true, 'default_view'=>1)
						 ),

	"default_order"	=> "id",
	"default_direction" => "DESC"
);



$config['orders_index'] = array(
	"view"		=> 	'listing/listing',
	"init_scripts" => 'listing/init_scripts',
	"advance_search_view" => 'pages/orders/filter',
	"base_url"	=> 	'/orders/index/',
	"per_page"	=>	"20",
	"fields"	=> array(   
						'so_id'=>array('name'=>'Order ID', 'data_type' => 'String', 'sortable' => true, 'default_view'=>1),
						'order_status'=>array('name'=>'Status', 'data_type' => 'String', 'sortable' => true, 'default_view'=>1),
						'total_amount'=>array('name'=>'Amount', 'data_type' => 'money', 'sortable' => true, 'default_view'=>1),
						'shop_name'=>array('name'=>'Shop', 'data_type' => 'string', 'sortable' => true, 'default_view'=>1),
                        'area'=>array('name'=>'Area', 'data_type' => 'string', 'sortable' => true, 'default_view'=>1),
                        'service_date'=>array('name'=>'Service Date', 'data_type' => 'date', 'sortable' => true, 'default_view'=>1),
                        'created_time'=>array('name'=>'Created', 'data_type' => 'date', 'sortable' => true, 'default_view'=>1)
						),

	"default_order"	=> "so_id",
	"default_direction" => "DESC"
);

$config['countries_index'] = array(
	"view"		=> 	'listing/listing',
	"init_scripts" => 'listing/init_scripts',
	"advance_search_view" => 'pages/countries/filter',
	"base_url"	=> 	'/countries/index/',
	"per_page"	=>	"20",
	"fields"	=> array(   
						'name'=>array('name'=>'Name', 'data_type' => 'String', 'sortable' => true, 'default_view'=>1),
						'code'=>array('name'=>'Code', 'data_type' => 'string', 'sortable' => true, 'default_view'=>1)
						 ),

	"default_order"	=> "id",
	"default_direction" => "DESC"
);

$config['states_index'] = array(
	"view"		=> 	'listing/listing',
	"init_scripts" => 'listing/init_scripts',
	"advance_search_view" => 'pages/states/filter',
	"base_url"	=> 	'/states/index/',
	"per_page"	=>	"20",
	"fields"	=> array(   
						'name'=>array('name'=>'Name', 'data_type' => 'String', 'sortable' => true, 'default_view'=>1),
						'code'=>array('name'=>'Code', 'data_type' => 'string', 'sortable' => true, 'default_view'=>1)
						 ),

	"default_order"	=> "id",
	"default_direction" => "DESC"
);


$config['cities_index'] = array(
	"view"		=> 	'listing/listing',
	"init_scripts" => 'listing/init_scripts',
	"advance_search_view" => 'pages/cities/filter',
	"base_url"	=> 	'/cities/index/',
	"per_page"	=>	"20",
	"fields"	=> array(   
						'name'=>array('name'=>'Name', 'data_type' => 'String', 'sortable' => true, 'default_view'=>1),
						'code'=>array('name'=>'Code', 'data_type' => 'string', 'sortable' => true, 'default_view'=>1)
						 ),

	"default_order"	=> "id",
	"default_direction" => "DESC"
);

$config['areas_index'] = array(
	"view"		=> 	'listing/listing',
	"init_scripts" => 'listing/init_scripts',
	"advance_search_view" => 'pages/areas/filter',
	"base_url"	=> 	'/areas/index/',
	"per_page"	=>	"20",
	"fields"	=> array(   
						'name'=>array('name'=>'Name', 'data_type' => 'String', 'sortable' => true, 'default_view'=>1),
						'code'=>array('name'=>'Code', 'data_type' => 'string', 'sortable' => true, 'default_view'=>1)
						 ),

	"default_order"	=> "id",
	"default_direction" => "DESC"
);

$config['pagesettings_index'] = array(
	"view"		=> 	'listing/listing',
	"init_scripts" => 'listing/init_scripts',
	"advance_search_view" => 'pages/pagesettings/filter',
	"base_url"	=> 	'/pagesettings/index/',
	"per_page"	=>	"20",
	"fields"	=> array(   
						'name'=>array('name'=>'Name', 'data_type' => 'String', 'sortable' => true, 'default_view'=>1),
                        'page_title'=>array('name'=>'Page Title', 'data_type' => 'String', 'sortable' => true, 'default_view'=>1),
                        'meta_key'=>array('name'=>'Meta Key', 'data_type' => 'String', 'sortable' => true, 'default_view'=>1),
                        'meta_desc'=>array('name'=>'Meta Description', 'data_type' => 'String', 'sortable' => true, 'default_view'=>1)
						
						 ),

	"default_order"	=> "id",
	"default_direction" => "DESC"
);

$config['sliders_index'] = array(
	"view"		=> 	'listing/listing',
	"init_scripts" => 'listing/init_scripts',
	"advance_search_view" => 'pages/sliders/filter',
	"base_url"	=> 	'/sliders/index/',
	"per_page"	=>	"20",
	"fields"	=> array(   
						'name'=>array('name'=>'Name', 'data_type' => 'String', 'sortable' => true, 'default_view'=>1)
						 ),

	"default_order"	=> "id",
	"default_direction" => "DESC"
);

$config['slider_images_index'] = array(
	"view"		=> 	'listing/listing',
	"init_scripts" => 'listing/init_scripts',
	"advance_search_view" => 'pages/slider_images/filter',
	"base_url"	=> 	'/slider_images/index/',
	"per_page"	=>	"20",
	"fields"	=> array(   
						'title'=>array('name'=>'Title', 'data_type' => 'String', 'sortable' => true, 'default_view'=>1)
						 ),

	"default_order"	=> "id",
	"default_direction" => "DESC"
);

$config['gallery_index'] = array(
	"view"		=> 	'listing/listing',
	"init_scripts" => 'listing/init_scripts',
	"advance_search_view" => 'pages/gallery/filter',
	"base_url"	=> 	'/gallery/index/',
	"per_page"	=>	"20",
	"fields"	=> array(   
						'name'=>array('name'=>'Name', 'data_type' => 'String', 'sortable' => true, 'default_view'=>1)
						 ),

	"default_order"	=> "id",
	"default_direction" => "DESC"
);

$config['gallery_images_index'] = array(
	"view"		=> 	'listing/listing',
	"init_scripts" => 'listing/init_scripts',
	"advance_search_view" => 'pages/gallery_images/filter',
	"base_url"	=> 	'/gallery_images/index/',
	"per_page"	=>	"20",
	"fields"	=> array(   
						'title'=>array('name'=>'Title', 'data_type' => 'String', 'sortable' => true, 'default_view'=>1)
						 ),

	"default_order"	=> "id",
	"default_direction" => "DESC"
);

$config['vehicles_index'] = array(
	"view"		=> 	'listing/listing',
	"init_scripts" => 'listing/init_scripts',
	"advance_search_view" => 'pages/vehicles/filter',
	"base_url"	=> 	'/vehicles/index/',
	"per_page"	=>	"20",
	"fields"	=> array(   
						'name'=>array('name'=>'Name', 'data_type' => 'String', 'sortable' => true, 'default_view'=>1),
                        'type'=>array('name'=>'type', 'data_type' => 'String', 'sortable' => true, 'default_view'=>1)
						 ),

	"default_order"	=> "id",
	"default_direction" => "DESC"
);

$config['testimonials_index'] = array(
	"view"		=> 	'listing/listing',
	"init_scripts" => 'listing/init_scripts',
	"advance_search_view" => 'pages/testimonials/filter',
	"base_url"	=> 	'/testimonials/index/',
	"per_page"	=>	"20",
	"fields"	=> array(   
						'name'=>array('name'=>'Name', 'data_type' => 'String', 'sortable' => true, 'default_view'=>1)
						 ),

	"default_order"	=> "id",
	"default_direction" => "DESC"
);

$config['services_index'] = array(
	"view"		=> 	'listing/listing',
	"init_scripts" => 'listing/init_scripts',
	"advance_search_view" => 'pages/services/filter',
	"base_url"	=> 	'/services/index/',
	"per_page"	=>	"20",
	"fields"	=> array(   
						'name'=>array('name'=>'Name', 'data_type' => 'String', 'sortable' => true, 'default_view'=>1),
                        'type'=>array('name'=>'type', 'data_type' => 'String', 'sortable' => true, 'default_view'=>1)
						 ),

	"default_order"	=> "id",
	"default_direction" => "DESC"
);


$config['shops_index'] = array(
	"view"		=> 	'listing/listing',
	"init_scripts" => 'listing/init_scripts',
	"advance_search_view" => 'pages/shops/filter',
	"base_url"	=> 	'/shops/index/',
	"per_page"	=>	"20",
	"fields"	=> array(   
						'name'=>array('name'=>'Name', 'data_type' => 'String', 'sortable' => true, 'default_view'=>1),
						'email'=>array('name'=>'Email', 'data_type' => 'string', 'sortable' => true, 'default_view'=>1),
                        'phone'=>array('name'=>'Phone', 'data_type' => 'string', 'sortable' => true, 'default_view'=>1),
                        'Area'=>array('name'=>'Area', 'data_type' => 'string', 'sortable' => true, 'default_view'=>1),
                        'start_time'=>array('name'=>'Start time', 'data_type' => 'string', 'sortable' => true, 'default_view'=>1),
                        'end_time'=>array('name'=>'End time', 'data_type' => 'string', 'sortable' => true, 'default_view'=>1),
                        'start_day'=>array('name'=>'Start Day', 'data_type' => 'string', 'sortable' => true, 'default_view'=>1),
                        'end_day'=>array('name'=>'End Day', 'data_type' => 'string', 'sortable' => true, 'default_view'=>1),
                        'experience'=>array('name'=>'Exp(yrs)', 'data_type' => 'string', 'sortable' => true, 'default_view'=>1),
                        'no_of_mechanics'=>array('name'=>'Mechanics', 'data_type' => 'string', 'sortable' => true, 'default_view'=>1),
                        'shop_area'=>array('name'=>'Shop Area(sqft)', 'data_type' => 'string', 'sortable' => true, 'default_view'=>1)
						 ),

	"default_order"	=> "id",
	"default_direction" => "DESC"
);

$config['shop_services_index'] = array(
	"view"		=> 	'listing/listing',
	"init_scripts" => 'listing/init_scripts',
	"advance_search_view" => 'pages/shop_services/filter',
	"base_url"	=> 	'/shop_services/index/',
	"per_page"	=>	"20",
	"fields"	=> array(
                        'service'=>array('name'=>'Service', 'data_type' => 'String', 'sortable' => true, 'default_view'=>1),
                        'vehicle'=>array('name'=>'Vehicle', 'data_type' => 'String', 'sortable' => true, 'default_view'=>1),
						'price'=>array('name'=>'Price', 'data_type' => 'String', 'sortable' => true, 'default_view'=>1),
						'discount'=>array('name'=>'Discount(%)', 'data_type' => 'string', 'sortable' => true, 'default_view'=>1)
                  ),

	"default_order"	=> "id",
	"default_direction" => "DESC"
);

$config['service_vehicles_index'] = array(
	"view"		=> 	'listing/listing',
	"init_scripts" => 'listing/init_scripts',
	"advance_search_view" => 'pages/service_vehicles/filter',
	"base_url"	=> 	'/service_vehicles/index/',
	"per_page"	=>	"20",
	"fields"	=> array(   
						'vehicle_name'=>array('name'=>'Price', 'data_type' => 'String', 'sortable' => true, 'default_view'=>1)
                  ),

	"default_order"	=> "id",
	"default_direction" => "DESC"
);


?>