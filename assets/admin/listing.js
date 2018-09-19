	
	(function ( $ ) { 

		
		var listing_form_data = {};
		
		var progress_bar_flag = false;
		
		var grids = {};
			
		$.fn.zoomgrid = function( options ) { 

			//merge options with the default
			options = $.extend($.fn.zoomgrid.defaults, options);
			
			//assign the current data_table id
			options.data_tbl = $(this).attr('id');

			//initiate grid
			$.fn.init_grid(options);
			
			//initiate sidebar if flag is true
			if(options.sidebar == true)
				$.fn.init_sidebar(options);
			
			//initiate search_bar if flag is true
			if(options.search_bar == true)
				$.fn.init_search_bar(options);
			
			
			//set flag as 'false' for both search_bar and sidebar.It will avoid duplicate initiations(morethan once)
			//If these will be initialized more than once, More Ajax call will happen. 
			$.fn.zoomgrid.defaults.search_bar = false;
			$.fn.zoomgrid.defaults.sidebar    = false;

			
		};
						
		// Establish our default settings				
		$.fn.zoomgrid.defaults = {
				pagination:'pagination',
				search_option:true,
				search_bar:false,
				sidebar:false
				};
		
	
		$.fn.init_grid = function( options ) { 
			
			$("#"+options.data_tbl).find("thead").find('a').each(function(index,elm){ 
				tmp = "javascript:$.fn.display_grid('"+$(this).attr('href')+"', '"+options.data_tbl+"');";
				$(this).attr({'href':'javascript:void(0);', 'onclick': tmp}).css({'cursor':'pointer'});
				
			});
			
			$("#"+options.data_tbl).parent().find("."+options.pagination).find('a').each(function(){
				tmp = "javascript:$.fn.display_grid('"+$(this).attr('href')+"', '"+options.data_tbl+"');";
				$(this).attr({'href':'javascript:void(0);', 'onclick': tmp}).css({'cursor':'pointer'});				
			});
			
			//alert($("#"+options.data_tbl).parent().find("#"+options.pagination).html());
			/*$("#"+options.data_tbl).parent().find("#"+options.pagination).find('a').bind('click', function(){
				$.fn.display_grid($(this).attr('href'), options.data_tbl);
				return false;
			});*/
			
		};
		
		$.fn.init_search_bar = function(options) {
			
			var target_url = base_url+current_controller+'/'+current_method;
			if(options.bae_url)
				target_url = options.bae_url;
			if(options.namespace)
				namespace = options.namespace;
			
			$("#simple_search_button").bind('click', function(){
				listing_form_data = $("#simple_search_form").serialize();
				$.fn.display_grid(target_url, 'data_table');
			});
			
			
			$.fn.get_advance_search_form();
			
			$("select[name='per_page_options']").bind('change', function(){
				$.post(base_url+current_controller+'/'+current_method+'/set_records_per_page/'+namespace,{per_page:$(this).val()},function(){
					$.fn.display_grid(target_url, 'data_table');
				}, 'json');
			});
			
		};
		
		$.fn.init_sidebar = function( options ) {
			
			$("#slide_panel_right h2 a").click(function(e){
				e.preventDefault();
				var div = $("#slide_panel_right");
				console.log(div.css("right"));
				if (div.css("right") === "-195px") {
					$.post(base_url+current_controller+'/get_fields_sidebar/'+namespace,{},function(data){
						$("#grid_columns").html(data.fields_sidebar);
						$("#slide_panel_right").animate({
							right: "0px"
						}); 
						$('input[name^="list_"]').bind('change', function(){
							listing_form_data = {};
							listing_form_data.action = this.checked?'add_field':'remove_field';
							listing_form_data.field  = $(this).val();
							$.fn.display_grid(base_url+'/'+current_controller+'/'+current_method, 'data_table');
							
						});
					}, 'json');
				} else {
					$("#slide_panel_right").animate({
						right: "-195px"
					});
				}
			});
						
		};
						
		$.fn.display_grid = function( url, data_tbl ) {
		
			opts = $.fn.zoomgrid.defaults;
			
			progress_bar_flag = true;
			
			$.fn.init_progress_bar();
			//alert(listing_form_data);
			$.post(url,listing_form_data,function(rdata){
				
				$("#"+data_tbl).parent().html(rdata.listing);
				
				$( "#"+data_tbl ).zoomgrid(opts);

				// $(".checkbox").checkboxradio({ icon: false });

				// init_daterangepicker();
				
				initOuterPerPageOption();

				if(opts.search_option == true)
				{
					$.fn.get_advance_search_form();	
					
					//$('a').tooltip();
					
					
				}
				
			}, 'json');
		};
						
		
						
		$.fn.clear_simple_search = function(){
			listing_form_data = {};
			//$("select[name='search_type']").selectpicker('deselectAll');
			$("input[name='search_text']").val('');
			$("#simple_search_button").trigger('click');
		};
						
		$.fn.get_advance_search_form = function(){
			if($('.advancesearch').length)
			{
				$.post(base_url+'/'+current_controller+'/get_advance_filter_form/'+namespace,{},function(data){
					$("#popOverBox").html(data.advance_filter_form);					
					initDatePickers();					
				}, 'json');
			}
		};

		$.fn.open_advance_search_form = function(){
			$("#popOverBox").css('display', 'block');
			$('#advance_search_form').modal();
		};
						
		$.fn.submit_advance_search_form = function(){
			listing_form_data = {};
			listing_form_data = $("#advance_search_form form").serialize();

			$.fn.display_grid(base_url+'/'+current_controller+'/'+current_method, 'data_table');

			$('#advance_search_form').modal('hide');
		};
			
		$.fn.clear_advance_search = function(){
			listing_form_data = {};
			listing_form_data.clear_advance_search = 'yes';
			if(current_controller == 'purchase'){
				$('form#advance_search_form select').selectpicker('deselectAll');
			}		

			$.fn.display_grid(base_url+'/'+current_controller+'/'+current_method, 'data_table');
		};

		$.fn.custom_search = function(field, txt, obj){
			
			listing_form_data = {};
			//clear both simple and advanced search
			listing_form_data.clear_advance_search = 'yes';
			listing_form_data.clear_simple_search = 'yes';
			listing_form_data.custom_search = 'yes';
			listing_form_data[field] = txt;
			if(namespace == 'shipment_index')
			{
				listing_form_data['back_order'] = 'all';
				listing_form_data['pre_order']  = 'all';
			}
			if(obj)
			{
				listing_form_data[obj.key] = obj.val;
			}
			
			$.fn.display_grid(base_url+'index.php/'+current_controller+'/'+current_method, 'data_table');
		};
		
		//initiate progress bar.It will show progress bar based on the ajax-states.
		$.fn.init_progress_bar = function(){
						
			$(document).ajaxStart(function() {
				if(progress_bar_flag)
				{
					html = '<div id="listing_progress_bar" class="progress"  style="left: 0px; right: 0px; margin: 0px auto; width: 30%; z-index: 9999; position: fixed; top: 60%;">';
					html += '<div class="progress-bar progress-bar-info progress-striped" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%;" class="bar"></div>';
					html += '</div>';
					$('body').append(html);
					$("#listing_progress_bar div").css('width', '50%');
				}
				
			});
			
			$(document).ajaxSend(function() {
				if(progress_bar_flag)
					$("#listing_progress_bar div").css('width', '75%');
				
			});
			
			$(document).ajaxSuccess(function(event, xhr, options) {
				if(progress_bar_flag)
				{
                    
					$("#listing_progress_bar div").css('width', '100%').animate({
					opacity: 0.25
					}, 500, function() {
						$("#listing_progress_bar").remove();
						progress_bar_flag = false;
					});	
				}
                
              /*  if($('.drag_drop').length) {
                    drag_drop();
                }	*/										
			});
			
		};
								
	}( jQuery ));

function initOuterPerPageOption()
{
	$("select[name='outer_per_page_options']").val( $("select[name='per_page_options']").val() );

	$("select[name='outer_per_page_options']").bind('change', function(){
		$("select[name='per_page_options']").val(this.value);
		$("select[name='per_page_options']").trigger('change');
		console.log(this.value);
	});
}

	//to delete selected record from list.
function delete_record(del_url,elm){

	$("#div_service_message").remove();
    
    	retVal = confirm("Are you sure to remove?");

        if( retVal == true ){
   
            $.post(base_url+del_url,{},function(data){           
                
                if(data.status == "success"){
                //success message set.
                service_message(data.status,data.message);
                
                //grid refresh
                refresh_grid();
    
            }
            else if(data.status == "error"){
                 //error message set.
                service_message(data.status,data.message);
            }
            
            },"json");
       }       
      
}

/* refresh grid after ajax submitting form */
function refresh_grid(data_tbl){
     
     data_tbl =(data_tbl)?data_tbl:"data_table";
     var cur_page = $("#base_url").val()+$("#cur_page").val();
     $.fn.init_progress_bar();
     $.fn.display_grid(cur_page,data_tbl);
}

function service_message(err_type,message,div_id){
    
    div_id = (div_id)?div_id:false; 	

    $("#div_service_message").remove();
    
    var str  ='<div id="div_service_message" class="Metronic-alerts alert alert-'+err_type+' fade in">';
        str +='<button class="close" aria-hidden="true" data-dismiss="alert" type="button"><i class="fa-lg fa fa-warning"></i></button>';
	    str +='<strong>'+capitaliseFirstLetter(err_type)+':&nbsp;</strong>';
	    str += message;
        str +='</div>';
        
    if(div_id){
         $("#"+div_id).html(str);
    }
    else
    {
        $(".box-header").after(str);
        scroll_to("div_service_message");
    }
            
}

function scroll_to(jump_id){
    //page scroll
    if(jump_id !=""){
       //$(window).scrollTop($('#'+jump_id).offset().top); 
    }
}

function capitaliseFirstLetter(string)
{
    return string.charAt(0).toUpperCase() + string.slice(1);
}
	
	
$(function() {
    
    init_bulk_all();

    initOuterPerPageOption();

    initDatePickers();
    
})

function initDatePickers()
{
	$('#popOverBox .datepicker').datepicker();

	var options = {};
	options.startDate 	= moment('2017-12-15'); //moment().subtract(29, 'days'),
	options.endDate 	= moment();
	//options.format = 'MMMM-D-YYYY';

	$('#popOverBox .date-range-picker').daterangepicker(options, function (start, end) {
		// var format = 'MMMM D, YYYY';
  		// $('#popOverBox .date-range-picker span').html(start.format(format) + ' - ' + end.format(format))
    });
}

function init_bulk_all() {

    $("#check_all").tooltip({
        title: "Select Records"
    });

    $("#check_all").popover({
        placement: "right",
        title: "Select <button class=\"close\" onclick=\"$('#check_all').popover('hide');$('#check_all').removeAttr('checked');return false;\">&times;</button>",
        html: "true",
        content: $("#div_select_all").html(),
        trigger: "manual",
        callback: function() {
            $("#check_all").tooltip("hide")
        }
    });

    $("#check_all").click(function() {
        if (this.checked) {
            $("#check_all").popover("show")
        } else {
            do_select(0)
        }
    })
}

function do_select(c, b) 
{
    $("input[name^='op_select']").each(function() {
        this.checked = c ? true : false
    });
    var a = $("#check_all");
    a.checked = c ? true : false;
    var d = $("#bulk_all");
    if (b == 1) {
        d.val("1")
    } else {
        d.val("0")
    }
    a.popover("hide")
}

function validate_bulk_options(a, b) {
    a = a ? a : "action";
    b = b ? b : "op_select";

    var c = $("select[name='" + a + "']");

    
    if (c.val() == "") 
    {
        alert("Please select an action");
        c.focus();
        return false
    }

    if ($("input[name^='" + b + "']:checked").length == 0) 
    {
        alert("You must select at least one record.");
        return false
    }

    return true
}

function bulk_action(b, a, c) {
    a = a ? a : "action";
    c = c ? c : "op_select";
    var d = $("select[name='" + a + "']");

    if (!validate_bulk_options(a, c)) {
        return false
    }
    switch (namespace) {

    	case 'users_index':
    		$("#bulk_action").val( d.val() );
    		$("#" + namespace).submit()
    		console.log( $("#" + namespace).serialize() );
    		break;
        default:
            $("#bulk_action").val( d.val() );
    		$("#" + namespace).submit()
    		console.log( $("#" + namespace).serialize() );
   		break;
    }
    return;

    switch (namespace) {
        case "sales_orders_index":
            if (d.selectpicker("val") == "print") {
                $("#bulk_action").val("print");
                $("#" + namespace).submit()
            }
            break;
        case "purchase_index":
            alert();
            break;
        case "shipment_index":
            if (d.selectpicker("val") == "csv") {
                $("#bulk_action").val("csv");
                $("#" + namespace).submit()
            } else {
                if (d.selectpicker("val") == "packing_slip") {
                    $("#bulk_action").val("packing_slip");
                    $("#" + namespace).submit()
                } else {
                    if (d.selectpicker("val") == "print_invoice") {
                        $("#bulk_action").val("print_invoice");
                        $("#" + namespace).submit()
                    } else {
                        if (d.selectpicker("val") == "update_track_shipment") {
                            $("#bulk_action").val("update_track_shipment");
                            $("#" + namespace).submit()
                        }
                    }
                }
            }
            break;
        case "return_authorization_view":
            if (d.selectpicker("val") == "accepted" || d.selectpicker("val") == "rejected") {
                $("#bulk_action").val(d.selectpicker("val"));
                update_return_auth(namespace, $("#btn_bulk_action"))
            }
            break;
        case "exceptional_orders_index":
            if (d.selectpicker("val") == "delete") {
                $("#bulk_action").val("delete");
                $("#" + namespace).submit()
            } else {
                if (d.selectpicker("val") == "pending") {
                    $("#bulk_action").val("pending");
                    $("#" + namespace).submit()
                } else {
                    if (d.selectpicker("val") == "resolve") {
                        $("#bulk_action").val("resolve");
                        $("#" + namespace).submit()
                    }
                }
            }
            break;
        case "feeds_index":
            if (d.selectpicker("val") == "delete") {
                $("#bulk_action").val("delete");
                $("#" + namespace).submit()
            } else {
                if (d.selectpicker("val") == "resolve") {
                    $("#bulk_action").val("resolve");
                    $("#" + namespace).submit()
                }
            }
            break
    }
    return false
}