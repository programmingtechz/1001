var bookingManager = {};
(function ( module ){
	var areas = [],
		shops = [],
		vehicles = [],
		services = [],		
		areas_by_id = {},
		shops_by_id = {},
		vehicles_by_id = {},
		services_by_id = {},
		main_services_by_id = {},
		sub_services_by_id = {},
		raw_data = [],
		shops_by_area = {},
		services_by_shop = {},
		services_by_shop_and_vehicle = {},
		vehicles_by_service = {},
		vehicles_by_shop = {},
		formatted_data = {},
		lowest_price_by_shops = [],
		options={}; //It is used to sort shops by lowest price

	var selected_area_id,
		selected_shop_id,
		selected_vehicle_id,
		selected_service_id,
		selected_sub_services_id = [];

	var template = new Element('#booking-template'),
		$booking_element = template.element;

	module.set_options = function(op) {
		options = op;
	};

	module.get_options = function() {
		return options;
	};

	module.init = function(options){
		var keys = Object.keys(options);

		module.set_options(options);

		for(var k of keys){
			switch(k){
				case 'areas':
					module.set_areas(options.areas);
				break;
				case 'shops':
					module.set_shops(options.shops);
				break;
				case 'vehicles':
					module.set_vehicles(options.vehicles);
				break;
				case 'services':
					module.set_services(options.services);
				break;
				case 'raw_data':
					module.set_raw_data(options.raw_data);
				break;
			}
		}

		var url = location.href.replace(base_url, '');
			url = url.replace('index.php/', '');
			url = url.replace('index.php/booking', '');
			url = url.replace('booking/index/', '');
			url = url.replace('booking/', '');
			url = url.split('/');

		if(url.length == 4) {
			selected_area_id = url[0];
			selected_shop_id = url[1];
			selected_vehicle_id = url[2]
			selected_service_id = url[3];
		} else {
			// selected_area_id = areas[0];
			// for(var area of areas) {
			// 	if(typeof shops_by_area[area.id] !== 'undefined' && shops_by_area[area.id].indexOf(selected_shop_id) !== -1) {
			// 		selected_area_id = area.id;
			// 	}
			// }
		}

		
		
		console.log('EEEE', areas, selected_area_id, selected_shop_id, selected_service_id, selected_vehicle_id);
	};

	module.set_raw_data = function(d){
		raw_data = d || [];
		module.prepare_data();
	};

	module.set_areas = function(a){
		areas = a || [];

		areas_by_id = {};
		for(var area of areas){
			areas_by_id[area.id] = area;
		}
	};

	module.set_shops = function(s){
		shops = s || [];

		shops_by_id = {};
		for(var shop of shops){
			shops_by_id[shop.id] = shop;
		}
	};

	module.set_vehicles = function(v){
		vehicles = v || [];

		vehicles_by_id = {};
		for(var vehicle of vehicles){
			vehicles_by_id[vehicle.id] = vehicle;
		}
	};

	module.set_services = function(s){
		services = s || [];

		services_by_id = {};
		main_services_by_id = {};

		for(var service of services){
			services_by_id[service.id] = service;

			if(service.parent_id == "0"){
				main_services_by_id[service.id] = service;
			}
			else{
				if(typeof sub_services_by_id[service.parent_id] == 'undefined'){
					sub_services_by_id[service.parent_id] = [];
				}
				sub_services_by_id[service.parent_id].push(service);
			}
		}
	};

	module.get_shops_by_area = function(){
		return [shops_by_area, services_by_shop, vehicles_by_service, formatted_data, lowest_price_by_shops];
	};

	module.prepare_data = function(){

		shops_by_area = {};
		services_by_shop = {};
		vehicles_by_service = {};
		formatted_data = {};

		var prices_by_shops = {};
		for(var item of raw_data){

			//Shops by area
			if(typeof shops_by_area[item.area_id] == 'undefined') {
				shops_by_area[item.area_id] = [];
			}
			if(shops_by_area[item.area_id].indexOf(item.shop_id) === -1){
				shops_by_area[item.area_id].push(item.shop_id)
			}

			//Services by shop
			if(typeof services_by_shop[item.shop_id] == 'undefined') {
				services_by_shop[item.shop_id] = [];
			}
			if(services_by_shop[item.shop_id].indexOf(item.service_id) === -1){
				services_by_shop[item.shop_id].push(item.service_id)
			}

			//Services by shop and vehicle
			if(typeof services_by_shop_and_vehicle[item.shop_id] == 'undefined') {
				services_by_shop_and_vehicle[item.shop_id] = {};
			}
			if(typeof services_by_shop_and_vehicle[item.shop_id][item.vehicle_id] == 'undefined') {
				services_by_shop_and_vehicle[item.shop_id][item.vehicle_id] = [];
			}

			if(services_by_shop_and_vehicle[item.shop_id][item.vehicle_id].indexOf(item.service_id) === -1){
				services_by_shop_and_vehicle[item.shop_id][item.vehicle_id].push(item.service_id)
			}

			//Vehicles by service
			if(typeof vehicles_by_service[item.service_id] == 'undefined') {
				vehicles_by_service[item.service_id] = [];
			}
			if(vehicles_by_service[item.service_id].indexOf(item.vehicle_id) === -1){
				vehicles_by_service[item.service_id].push(item.vehicle_id)
			}

			//Vehicles by shop
			if(typeof vehicles_by_shop[item.shop_id] == 'undefined') {
				vehicles_by_shop[item.shop_id] = [];
			}
			if(vehicles_by_shop[item.shop_id].indexOf(item.vehicle_id) === -1){
				vehicles_by_shop[item.shop_id].push(item.vehicle_id)
			}

			//formatted data
			if(typeof formatted_data[item.shop_id] == 'undefined') {
				formatted_data[item.shop_id] = {};
			}
			if(typeof formatted_data[item.shop_id][item.service_id] == 'undefined') {
				formatted_data[item.shop_id][item.service_id] = {};
			}
			if(typeof formatted_data[item.shop_id][item.service_id][item.vehicle_id] == 'undefined') {
				formatted_data[item.shop_id][item.service_id][item.vehicle_id] = item;
			}
			

			//prices_by_shops
			if(typeof prices_by_shops[item.shop_id] == 'undefined') {
				prices_by_shops[item.shop_id] = [];
			}
			prices_by_shops[item.shop_id].push(item.price);
		}

		
		$.each(prices_by_shops, function(k, v){
			var obj = {shop_id: k, price: 0};
			v.sort(function(a,b){if(a > b) return 1; else return -1;});
			if(v.length){
				obj.price = v[0];
			}
			lowest_price_by_shops.push(obj);
		});
		

		lowest_price_by_shops.sort(function(a, b){
			if(a.price > b.price) return 1;
			else return -1;
		});


		console.log(shops_by_area, services_by_shop, vehicles_by_service, formatted_data);

	};

	module.get_shops_by_lowest_price = function(area_id){
		var shops = [];
		if(typeof shops_by_area[area_id] === 'undefined') {
			return shops;
		} 

		if(!Array.isArray(lowest_price_by_shops) || !lowest_price_by_shops.length) {
			return shops;
		}

		for(var obj of lowest_price_by_shops){
			if(shops_by_area[area_id].indexOf(obj.shop_id) !== -1){
				shops.push(obj.shop_id); 
			}
		}

		return shops;
	};

	module.get_lowest_price = function(shop_id){
		var price = 0;
		for(var obj of lowest_price_by_shops){
			if(shop_id == obj.shop_id){
				price = obj.price;
			}
		}

		return price;

	};

	module.getOrderSummaryData = function(){
		var $selected_elms = $booking_element
				.find('.services-list .service.template-state-selected, .sub-services-list .sub-service.template-state-selected');

		var total_duration = 0,
			total_price = 0;
		$selected_elms.each(function(){
			console.log($(this).attr('data-duration'));
			total_duration += parseInt( $(this).attr('data-duration') );
			total_price += parseFloat( $(this).attr('data-price') );
		});

		return {
			total_duration: total_duration,
			total_price: total_price
		};

	};	

	module.confirm_order = function(){
		if(!selected_shop_id || selected_shop_id == ''){
			alert('Please select a shop.');
		}

		if(!selected_vehicle_id || selected_vehicle_id == ''){
			alert('Please select vehicle type.');
		}

		if(!selected_service_id || selected_service_id == ''){
			alert('Please select a service.');
		}

		var fname 		= $booking_element.find('input[name="booking-form-first-name"]').val(),
			lname 		= $booking_element.find('input[name="booking-form-second-name"]').val(),
			email 		= $booking_element.find('input[name="booking-form-email"]').val(),
			phone 		= $booking_element.find('input[name="booking-form-phone"]').val(),
			vnumber 	= $booking_element.find('input[name="booking-form-vehicle-number"]').val(),
			vmodel 		= $booking_element.find('input[name="booking-form-vehicle-model"]').val(),
			booking_date = $booking_element.find('input[name="booking-form-date"]').val(),
			message = $booking_element.find('textarea[name="booking-form-message"]').val(),
			booking_pickup = false, // $booking_element.find('input[name="booking-form-pickup"]').prop( "checked" ),
			booking_donate = $booking_element.find('input[name="booking-form-donate"]').prop( "checked" ),
			booking_terms = $booking_element.find('input[name="booking-form-terms"]').prop( "checked" );

		var flag = true;

		if(fname.trim() == '' && !window.userdata){
			flag = false;
			$booking_element.find('input[name="booking-form-first-name"]').addClass('error');
		}

		if(lname.trim() == '' && !window.userdata){
			flag = false;
			$booking_element.find('input[name="booking-form-second-name"]').addClass('error');
		}

		if(email.trim() != '' && !isValidaEmail(email)){
			flag = false;
			$booking_element.find('input[name="booking-form-email"]').addClass('error');
		}

		if((phone.trim() == '' || !isValidPhonenumber(phone)) && !window.userdata){
			flag = false;
			$booking_element.find('input[name="booking-form-phone"]').addClass('error');
		}

		if(vnumber.trim() == ''){
			flag = false;
			$booking_element.find('input[name="booking-form-vehicle-number"]').addClass('error');
		}

		if(vmodel.trim() == ''){
			flag = false;
			$booking_element.find('input[name="booking-form-vehicle-model"]').addClass('error');
		}

		if(booking_date.trim() == ''){
			flag = false;
			$booking_element.find('input[name="booking-form-date"]').addClass('error');
		}

		if(!booking_terms){
			flag = false;
			$booking_element.find('li.tc').addClass('error');
		}


		if (!flag) {return;}

		booking_date = booking_date.split('-');
		var temp = booking_date[0];
		booking_date[0] = booking_date[1];
		booking_date[1] = temp;
		booking_date = new Date(booking_date);
		booking_date = (booking_date.getTime()/1000);

		var data = {
			name: fname + ' ' + lname,
			email: email,
			phone: phone,
			vehicle_number: vnumber,
			vehicle_model: vmodel,
			booking_date: booking_date,
			message: message,
			pickup: booking_pickup?1:0,
			donate: booking_donate?1:0,
			order_info: {
				shop_id: selected_shop_id,
				vehicle_id: selected_vehicle_id,
				service_id: selected_service_id,
				sub_services: selected_sub_services_id
			}
		};

		var request = {
			url: base_url  + 'booking/create',
			type: 'POST',
			data: data
		};

		var $loader = $('<div class="loading">Loading&#8230;</div>');
		$('body').append($loader);
		EC.server.request(request, function(resp){
			console.log(resp);
			var data = JSON.parse(resp);
			
			$loader.remove();

			if(data.status == 'success'){
				//alert('Order created successfully!.');
				location.href = base_url + 'booking/confirmation/' + data.so_id;
			}
			else{
				alert(data.message);
			}
		}, function() {
			$loader.remove();
		});

		console.log(request, selected_shop_id, selected_vehicle_id, selected_service_id, booking_date);
	}
	

	/*UI SECTION*/

	module.UI = {};

	module.UI.render = function(){
		
		$('.booking-section').html( $booking_element );
		
		module.UI.render_area();

		if (window.userdata) {
			$booking_element.find('.email-phone').css('display', 'none');
		}
		
		$booking_element.find('select.areas').trigger('change');

		// var input_selectors = 'input[name="booking-form-first-name"],input[name="booking-form-second-name"]';
		// 	input_selectors += ',input[name="booking-form-email"],input[name="booking-form-phone"]';
		var input_selectors = '';
            if (!window.userdata) {
                input_selectors +='input[name="booking-form-first-name"],input[name="booking-form-second-name"],';
    			input_selectors += 'input[name="booking-form-phone"],';
            }
            input_selectors +='input[name="booking-form-vehicle-number"]';
			input_selectors += ',input[name="booking-form-vehicle-model"],input[name="booking-form-date"],input[name="booking-form-terms"]';

		$booking_element
			.find(input_selectors)
			.on('keyup change', function(){
			console.log($(this).val());


			if($(this).val() == ''){
				$(this).addClass('error');
			} else if($(this).attr('name') === 'booking-form-phone') {
				if (isValidPhonenumber($(this).val())) {
					$(this).removeClass('error');
				} else {
					$(this).addClass('error');
				}
			} 
			else {
				$(this).removeClass('error');
			}

			if ($(this).attr('type') === 'checkbox') {
				if($(this).prop('checked')){
					$(this).parents('li').removeClass('error');
				}
				else {
					$(this).parents('li').addClass('error');
				}
			}
		});

		$booking_element.find('input[name="booking-form-email"]')
			.on('keyup change', function(){

				if ($(this).val() !== '' && isValidaEmail($(this).val())) {
					$(this).removeClass('error');
				} else {
					$(this).addClass('error');
				}
			});

		$booking_element.find('button[name="booking-form-submit"]').on('click', module.confirm_order);
	};

	module.UI.render_area = function(){
		var $areas = $booking_element.find('select.areas');
			$areas.html('');
		for(var area of areas){
			$areas.append($('<option>', {text:area.name, value: area.id}));
		}
		if (!selected_area_id) {
			selected_area_id = areas[0].id;
		}
		$areas.val(selected_area_id);
		console.log('log:: selected_area_id', selected_area_id);
		$areas.on('change', function(){
			module.UI.render_shops($(this).val());
		});
	};

	module.UI.render_shops = function(area_id){
		
		var shops = module.get_shops_by_lowest_price(area_id);
		$booking_element.find('.shops-list').html('');

		//selected shop id
		if(!selected_shop_id || shops.indexOf(selected_shop_id) === -1){
			if(shops.length){
				selected_shop_id = shops[0];
			}
			else{
				selected_shop_id = undefined;
			}			
		}

		for(var shop_id of shops){
			if(typeof shops_by_id !== 'object' || typeof shops_by_id[shop_id] !== 'object'){
				continue;
			}

			var shop = shops_by_id[shop_id];
			var area = areas_by_id[shop.area_id];
			//console.log('shop::', shop);
			var template = new Element('#shop-template'),
				$shop_element = template.element;

			$shop_element.attr('data-id', shop.id);

			//shop logo
			var images = JSON.parse(shop.image),
				shop_image = '';
			if(images.length){
				shop_image = 'https://s3.amazonaws.com/' + images[0].s3_url;
			}
			$shop_element.find('.img_list img').attr('src', shop_image);

			//shop name
			$shop_element.find('.shop-name strong').html(shop.name);
			$shop_element.find('.shop-name a').attr('href', 'shop_url');
            
            //shop ratings
            if( shop.ratings ){
                
                for( var $r=0; $r <shop.ratings; $r++ ){
                    $shop_element.find('.rating i').eq($r).addClass('voted');
                }
            }

			//area name
			$shop_element.find('.location').html('<i class="icon icon-map-pin">' + area.name + '');

			//price
			var price  = module.get_lowest_price(shop.id);
			$shop_element.find('.starting-from .amount').html(price);

			//info section
			$shop_element.find('.add_info li').on('click', function(){

				
                if( $(this).attr('data-action') ==  'icon-map-pin'){
                    window.open('https://www.google.com/maps/search/?api=1&query='+shop.lat+','+shop.lon);
                    return;
                }
				var $info = $('<i class="icon"></i>'),
					text = '';
				$info.addClass($(this).attr('data-action'));

				switch($(this).attr('data-action')){

					case 'icon-since':
						text = shop.start_day + ' - ' + shop.end_day + ' | ' + shop.start_time + ' - ' + shop.end_time;
						break;
					case 'icon-number-mechanics':
						text = shop.no_of_mechanics +' Mechanics';
						break;					
					case 'icon-sqft':
						text = shop.shop_area + ' sqft'; 
						break;
					case 'icon-map-pin':
						text = '';
						break;
					case 'icon-pay-online':
						text = 'Online payment available.';
						break;

				};
				
				console.log($(this).attr('data-action'), text);

				$(this).parents('.tour_list_desc')
					.find('.icon-info')
					.html($info)
					.append(text);
			});

			//select button
			$shop_element.find('.template-component-button').attr('data-id', shop.id);

			$shop_element.find('.template-component-button').on('click', function(){
				var isSelected = $(this).parents('.shop').hasClass('template-state-selected');
				$booking_element.find('.shops-list .shop').removeClass('template-state-selected');

				if(isSelected){console.log('111111');
					selected_shop_id = undefined;
					module.UI.render_vehicles([]);
				}
				else{console.log('222222');
					$(this).parents('.shop').addClass('template-state-selected');
					var shop_id = $(this).attr('data-id'),
						vehicles = vehicles_by_shop[shop_id];

					selected_shop_id = shop_id;

					console.log('vehicles', shop_id, vehicles);
					module.UI.render_vehicles(vehicles);
				}
				
			});


			$booking_element.find('.shops-list').append($shop_element);

		}

		setTimeout(function(){
			$booking_element
				.find('.shops-list .shop .template-component-button[data-id="'+selected_shop_id+'"]')
				.trigger('click');
		}, 200);
		//console.log('GGG::', shops, shops_by_id);

	};


	module.UI.render_vehicles = function(vehicles){
		
		$booking_element.find('.vehicles-list').html('');

		var options = module.get_options();
		var temp = [];
		for(var v of options.vehicles) {
			if (vehicles.indexOf(v.id) !== -1) {
				temp.push(v.id);
			}
		}
		vehicles = temp;

		//selected vehicle id
		if(!selected_vehicle_id || vehicles.indexOf(selected_vehicle_id) === -1){
			if(vehicles.length){
				selected_vehicle_id = vehicles[0];
			}
			else{
				selected_vehicle_id = undefined;
			}			
		}

		console.log('vehicles', vehicles, module.get_options());

		for(var vehicle_id of vehicles){
			
			var vehicle = vehicles_by_id[vehicle_id];

			console.log('vehicle', vehicle_id, vehicle);

			var template = new Element('#vehicle-template'),
				$vehicle_element = template.element,
                $vehicle_image = JSON.parse(vehicle.image),
                $vehicle_hover_image = JSON.parse(vehicle.hover_image);
                
            $vehicle_image = ($vehicle_image[0] && $vehicle_image[0].s3_url)?'https://s3.amazonaws.com/'+$vehicle_image[0].s3_url:"";
            $vehicle_hover_image = ($vehicle_hover_image[0] && $vehicle_hover_image[0].s3_url)?'https://s3.amazonaws.com/'+$vehicle_hover_image[0].s3_url:"";
               
			$vehicle_element.attr('data-id', vehicle.id);

            $vehicle_element.find('.template-icon-vehicle-small-car').attr('data-hover-image',$vehicle_hover_image);
            $vehicle_element.find('.template-icon-vehicle-small-car').attr('data-main-image',$vehicle_image);
            $vehicle_element.find('.template-icon-vehicle-small-car').css({'background-repeat': 'no-repeat','background-image': 'url('+$vehicle_image+')'});
			$vehicle_element.find('.vehicle-name').html(vehicle.name);

			$vehicle_element.on('click', function(){
				
                $('.vehicles-list').find('.template-icon-vehicle-small-car').each(function(){
                    
                    $(this).css({'background-repeat': 'no-repeat','background-image': 'url('+$(this).attr('data-main-image')+')'});
                });
                
                $(this).find('.template-icon-vehicle-small-car').css({'background-repeat': 'no-repeat','background-image': 'url('+$(this).find('.template-icon-vehicle-small-car').attr('data-hover-image')+')'});
				var isSelected = $(this).hasClass('template-state-selected');
				
				$booking_element.find('.vehicles-list .vehicle').removeClass('template-state-selected');

				if(isSelected){console.log('111111');
					selected_vehicle_id = undefined;
					module.UI.render_services([]);
				}
				else{console.log('222222');
					
					$(this).addClass('template-state-selected');
					
					var vehicle_id = $(this).attr('data-id'),
						services = services_by_shop_and_vehicle[selected_shop_id][vehicle_id];

					selected_vehicle_id = vehicle_id;
					console.log('services', selected_shop_id, vehicle_id, services);
					module.UI.render_services(services);
					//module.UI.render_sub_services(services);
				}
				
			});

			
			$booking_element.find('.vehicles-list').append($vehicle_element);
		}

		setTimeout(function(){
			$booking_element
				.find('.vehicles-list .vehicle[data-id="'+selected_vehicle_id+'"]')
				.trigger('click');
		}, 200);

	};

	module.UI.render_services = function(services){
		$booking_element.find('.services-list').html('');

		var options = module.get_options();
		var temp = [];
		for(var s of options.services) {
			if (services.indexOf(s.id) !== -1) {
				temp.push(s.id);
			}
		}
		services = temp;

		//selected vehicle id
		if(!selected_service_id || services.indexOf(selected_service_id) === -1){
			if(services.length){
				selected_service_id = services[0];
			}
			else{
				selected_service_id = undefined;
			}			
		}

		
		for(var service_id of services){
			
			if( typeof main_services_by_id[service_id] == 'undefined') continue;

			var service = main_services_by_id[service_id];

			if(!selected_service_id) selected_service_id = service_id;

			console.log('service 222', formatted_data);

			var template = new Element('#service-template'),
				$service_element = template.element;

			$service_element.attr('data-id', service.id);
			$service_element.attr('data-duration', service.service_time);
			$service_element.attr('data-price', '0');

			//name
			$service_element.find('.template-component-booking-package-name').html(service.name);

			//price
			var price = 0,discount = 0,dicounted_price = 0;
			if( typeof formatted_data[selected_shop_id] !== 'undefined' 
				&& typeof formatted_data[selected_shop_id][service.id] !== 'undefined'  
				&& typeof formatted_data[selected_shop_id][service.id][selected_vehicle_id] !== 'undefined' ){
				price = formatted_data[selected_shop_id][service.id][selected_vehicle_id].price;
				discount = formatted_data[selected_shop_id][service.id][selected_vehicle_id].discount;
				discount = parseInt(discount);
				dicounted_price = (discount)?(price - ((price*discount)/100)): price;
			}
			if(!price){ 
				$service_element.find('.template-component-booking-package-price-total').remove();
				$service_element.find('.template-component-booking-package-price-decimal').remove(); 
			}
			else {
				console.log('RAMAA', discount, dicounted_price, price);
				price = ''+ price;
                
				$service_element.attr('data-price', dicounted_price);
                dicounted_price= ''+dicounted_price;
				if (discount) {
					$service_element.find('.original_price').html(price);
					$service_element.find('.discount').html(discount);
				} else {
					$service_element.find('.discount-section').remove()
				}

				var pric_splitted = dicounted_price.split('.');
				
				if(pric_splitted.length == 1){
					$service_element.find('.template-component-booking-package-price-total.dicounted-price').html(pric_splitted[0]);
					$service_element.find('.template-component-booking-package-price-decimal').remove(); 
				}
				else{
					$service_element.find('.template-component-booking-package-price-total.dicounted-price').html(pric_splitted[0]);
					$service_element.find('.template-component-booking-package-price-decimal').html(pric_splitted[1]); 
				}				
			}

			//service duration
			var duration 	= parseInt(service.service_time);			
			var hours 		= Math.floor( duration / 60);          
    		var minutes 	= duration % 60;
			var $duration_elm = $service_element.find('.template-component-booking-package-duration');
				$duration_elm.find('.hrs').html(hours);
				$duration_elm.find('.mins').html(minutes);
			if(hours<=0){ $duration_elm.find('.hrs, .hrs-unit').remove(); }
			if(minutes<=0){ $duration_elm.find('.mins, .mins-unit').remove(); }

			//service details
			var details = service.service_details.split( "\n" );
			for(var detail of details){
				$service_element
					.find('.template-component-booking-package-service-list')
					.append('<li>'+detail+'</li>');
			}			
			
			//book now button
			$service_element.find('.template-component-button').attr('data-id', service.id);
			$service_element.find('.template-component-button').on('click', function(){
				
				var isSelected = $(this).parents('.service').hasClass('template-state-selected');				
				var sub_services = [];

				$booking_element.find('.services-list .service').removeClass('template-state-selected');

				if(isSelected){
					//$(this).parents('.service').removeClass('template-state-selected');
					selected_service_id = undefined;					
				}
				else{
					$(this).parents('.service').addClass('template-state-selected');
					selected_service_id = $(this).attr('data-id');
					if(typeof sub_services_by_id[selected_service_id] !== 'undefined'){
						sub_services = sub_services_by_id[selected_service_id];
					}					
				}

				module.UI.render_sub_services(sub_services);
				module.UI.update_total_duration_and_price();
			});

			
			$booking_element.find('.services-list').append($service_element);
		}

		setTimeout(function(){
			$booking_element
				.find('.services-list .service .template-component-button[data-id="'+selected_service_id+'"]')
				.trigger('click');
		}, 200);
	};

	module.UI.render_sub_services = function(sub_services){
		
		$booking_element.find('.sub-services-list').html('');
		console.log('sub_services', sub_services_by_id, sub_services);
		//selected vehicle id
		// if(!selected_service_id || services.indexOf(selected_service_id) === -1){
		// 	if(services.length){
		// 		selected_service_id = services[0];
		// 	}
		// 	else{
		// 		selected_service_id = undefined;
		// 	}			
		// }

		for(var service of sub_services){
			
			var template = new Element('#sub-service-template'),
				$service_element = template.element;

			$service_element.attr('data-id', service.id);
			$service_element.attr('data-duration', service.service_time);
			$service_element.attr('data-price', '0');

			//name
			$service_element.find('.template-component-booking-service-name').html(service.name);

			//service duration
			var duration 	= parseInt(service.service_time);			
			var hours 		= Math.floor( duration / 60);          
    		var minutes 	= duration % 60;
			var $duration_elm = $service_element.find('.template-component-booking-service-duration');
				$duration_elm.find('.hrs').html(hours);
				$duration_elm.find('.mins').html(minutes);

			if (hours<=0 && minutes<=0) {
				$duration_elm.find('.hrs').html('custom');
				$duration_elm.find('.hrs-unit, .mins, .mins-unit').remove();
			} else {
				if(hours<=0) { 
					$duration_elm.find('.hrs, .hrs-unit').remove(); 
				}

				if(minutes<=0) { 
					$duration_elm.find('.mins, .mins-unit').remove(); 
				}	
			}	
			

			//price
			var price = 0,discount = 0,dicounted_price = 0;
			if( typeof formatted_data[selected_shop_id] !== 'undefined' 
				&& typeof formatted_data[selected_shop_id][service.id] !== 'undefined'  
				&& typeof formatted_data[selected_shop_id][service.id][selected_vehicle_id] !== 'undefined' ){
				price = formatted_data[selected_shop_id][service.id][selected_vehicle_id].price;

				price = formatted_data[selected_shop_id][service.id][selected_vehicle_id].price;
				discount = formatted_data[selected_shop_id][service.id][selected_vehicle_id].discount;
				discount = parseInt(discount);
				dicounted_price = (discount)?(price-(price*discount)/100): price;
			}
			if(!price){ 
				$service_element.find('.template-component-booking-service-price-value').html('');
			}
			else {
				console.log('sub_services', price, discount, dicounted_price);
				$service_element.attr('data-price', dicounted_price);
				$service_element.find('.template-component-booking-service-price-value').html(dicounted_price);	

				dicounted_price= ''+dicounted_price;
				if (discount) {
					$service_element.find('.original_price').html(price);
					$service_element.find('.discount').html(discount);
				} else {
				    $service_element.find('.discount-section').next("br").remove();
					$service_element.find('.discount-section').remove();
				}

				var pric_splitted = dicounted_price.split('.');
				
				if(pric_splitted.length == 1){
					$service_element.find('.template-component-booking-package-price-total.dicounted-price').html(pric_splitted[0]);
					$service_element.find('.template-component-booking-package-price-decimal').remove(); 
				}
				else{
					$service_element.find('.template-component-booking-package-price-total.dicounted-price').html(pric_splitted[0]);
					$service_element.find('.template-component-booking-package-price-decimal').html(pric_splitted[1]); 
				}		
			}

			//book now button
			$service_element.find('.template-component-button').attr('data-id', service.id);
			$service_element.find('.template-component-button').on('click', function(){
				
				var isSelected = $(this).parents('.sub-service').hasClass('template-state-selected'),
					sel_id = $(this).attr('data-id');				
				
				//$booking_element.find('.sub-services-list .sub-service').removeClass('template-state-selected');

				if(isSelected){
					$(this).parents('.sub-service').removeClass('template-state-selected');
					if(selected_sub_services_id.indexOf(sel_id)){
						selected_sub_services_id.splice(selected_sub_services_id.indexOf(sel_id), 1);
					}
				}
				else{
					$(this).parents('.sub-service').addClass('template-state-selected');
					selected_sub_services_id.push(sel_id);
				}

				module.UI.update_total_duration_and_price();
			});

			if( price )
			$booking_element.find('.sub-services-list').append($service_element);
		}

		setTimeout(function(){
			$booking_element
				.find('.sub-services-list .service .template-component-button[data-id="'+selected_service_id+'"]')
				.trigger('click');
		}, 200);
	};

	module.UI.update_total_duration_and_price = function(){
		var sd = module.getOrderSummaryData();

		var duration 	= parseInt(sd.total_duration);			
			var hours 	= Math.floor( duration / 60);          
    		var minutes = duration % 60;

		$booking_element.find('.template-component-booking-summary-duration .hrs').html(hours);
		$booking_element.find('.template-component-booking-summary-duration .mins').html(minutes);
		
		$booking_element.find('.template-component-booking-summary-price-value').html(sd.total_price);
	};



})(bookingManager || ( bookingManager = {} ));


var options = {
				areas:areas,
				shops: shops,
				vehicles: vehicles,
				services: services,
				raw_data:raw_data
			};

bookingManager.init(options);

bookingManager.UI.render();