var dashboardManager = {};

(function ( module )
{
    
    var shop_id = "all";
    var $order_stats_element = $('#order_stats');
    var orders_pie_lement = $('.all_orders_pie');
    var $latest_orders_element = $('.latest_orders');
    var $calendar_orders_element = $('.cal_orders');
    var orders_line_element = $('.all_orders_line');
    var orders_revenue_element = $('.all_orders_revenue');
    
    module.init = function( refresh ){
         
         if( !refresh ){
            
             $('.shop_select').select2();
         
             $('.shop_select').on('change',function(){
                shop_id = $(this).val();
                
                module.init(true);
             });
             
             shop_id = $('.shop_select').val();
             
             orders_pie_lement.find('.fa-refresh').on('click',function(){
                module.orders_pie_graph(true);
             });
             $latest_orders_element.find('.fa-refresh').on('click',function(){
                module.latest_orders(true);
             });
             $calendar_orders_element.find('.fa-refresh').on('click',function(){
                module.orders_calendar_list(true);
             });
             orders_line_element.find('.fa-refresh').on('click',function(){
                module.orders_line_graph(true);
             });
             orders_revenue_element.find('.fa-refresh').on('click',function(){
                module.revenue_pie_graph(true);
             });
         }
         
         module.order_Status(refresh);
         module.orders_pie_graph(refresh);
         module.latest_orders(refresh);
         module.orders_calendar_list(refresh);
         module.orders_line_graph(refresh);
         module.revenue_pie_graph(refresh);
        
    }
    
    module.order_Status = function( refresh ){
        
        $order_stats_element.find('.custom_loader').removeClass('hide');
        module.api_req({
            action:"order_stats",
            shop_id:shop_id
        },function(resp){
            $order_stats_element.find('.custom_loader').addClass('hide');
            var data = (resp.data)?resp.data:{};
            
            var totalOrders = (data.totalOrders)?data.totalOrders:0;
            var pendingOrders = (data.pendingOrders)?data.pendingOrders:0;
            var CompletedOrders = (data.CompletedOrders)?data.CompletedOrders:0;
            var totalAmount = (data.totalAmount)?data.totalAmount:0;
            
            $order_stats_element.find('.total_order').html(totalOrders);
            $order_stats_element.find('.pending_orders').html(pendingOrders);
            $order_stats_element.find('.completed_orders').html(CompletedOrders);
            $order_stats_element.find('.total_revenue').html("&#8377;"+ module.numberWithCommas(totalAmount));           
            
        });
    }
    
    module.orders_line_graph = function(refresh){
  
        orders_line_element.find('.custom_loader').removeClass('hide');
        
        if( !refresh){
            
            var start = moment().subtract(29, 'days').unix();
            var end = moment().unix();
            
            orders_line_element.find('.date-range').find('span').attr('data-start',start).attr('data-end',end);
            module.date_range_picker( orders_line_element.find('.date-range'),start,end,function($start_date,$end_date){
                load_line_chart($start_date,$end_date,true);
            } );
            
            orders_line_element.find('.status_select').select2();
         
             orders_line_element.find('.status_select').on('change',function(){
                
                module.orders_line_graph(true);
             });
            
        }
        
        function load_line_chart($start_date,$end_date,refresh) {
            
                module.api_req({
                action:"orders_line",
                shop_id:shop_id,
                start_date:$start_date,
                end_date:$end_date,
                status:orders_line_element.find('.status_select').val()
            },function(resp){
                orders_line_element.find('.custom_loader').addClass('hide');
                var data = (resp.data)?resp.data:{};        
                
                if( data.length == 0){
                    data = [{y:'No Data',item1:0}]
                }
                
                if( refresh ){
                    window['orders_line_chart'].setData( data );
                }else{
                     window['orders_line_chart'] = new Morris.Line({
                                  element: orders_line_element.find('.chart-graph'),
                                  resize: true,
                                  data: data,
                                  xkey: 'y',
                                  ykeys: ['item1'],
                                  labels: ['Orders'],
                                  lineColors: ['#3c8dbc'],
                                  hideHover: 'auto'
                                });
                }
            }); 
        }
        $start_date = (start)?start:orders_line_element.find('.date-range').find('span').attr('data-start');
        $end_date = (end)?end:orders_line_element.find('.date-range').find('span').attr('data-end');
        load_line_chart($start_date,$end_date,refresh); 
     
              
    }
    
    module.orders_calendar_list = function( refresh ){
               
                setTimeout(function(){
                    
                    if( refresh ){
                       $calendar_orders_element.find('.cal_list').fullCalendar( "refetchEvents" );
                        return;
                    }
                    
                     $calendar_orders_element.find('.cal_list').fullCalendar({
                          header    : {
                            left  : 'prev,next today',
                            center: 'title',
                            right : 'month'
                          },
                          buttonText: {
                            today: 'today',
                            month: 'month'
                          },
                           eventAfterRender:function( event, element, view ) {
                            element.find('.fc-title').html("<a target='_blank' style='color:white !important' href='"+base_url+"orders/view/"+event['so_id']+"'>"+element.find('.fc-title').text()+"</a>");
                        },
                          events: function( start, end, timezone, callback ) {
                            
                                $calendar_orders_element.find('.custom_loader').removeClass('hide');
                            
                                function get_orders_data(){
                                    
                                    var event = [];
                                    
                                     module.api_req({
                                        action:"cal_orders",
                                        shop_id:shop_id,
                                        start_date:start.unix(),
                                        end_date:end.unix()
                                    },function(resp){
                                        $calendar_orders_element.find('.custom_loader').addClass('hide');
                                        var data = (resp.data)?resp.data:[];
                                        for( var i=0; i<data.length; i++){
                                            
                                                event.push({
                                                  title          : "Order No: #"+data[i]['so_id'],
                                                  start          : moment(data[i]['so_id']*1000),
                                                  end            : moment(data[i]['so_id']*1000),
                                                  so_id            : data[i]['id'],
                                                  backgroundColor: (data[i]['order_status'] == 'ACCEPTED')?'red':'green', //Success (green)
                                                  borderColor    : (data[i]['order_status'] == 'ACCEPTED')?'red':'green' //Success (green)}
                                            });
                                        }
                                        callback(event);           
                                    });
                                }
                                get_orders_data();
                            }
                        });
                },100);
    

    }
    
    module.latest_orders = function( refresh ){
        
        $latest_orders_element.find('.custom_loader').removeClass('hide');
        $latest_orders_element.find('.todo-list').html("");
        
        module.api_req({
            action:"latest_orders",
            shop_id:shop_id
        },function(resp){
            $latest_orders_element.find('.custom_loader').addClass('hide');
            var data = (resp.data)?resp.data:[];
            
            if( data.length ){
                for( var i=0; i<data.length ; i++){
                    
                    if( data[i]['order_status'] == "ACCEPTED") data[i]['order_status'] = "PENDING";
                    
                    var status = (data[i]['order_status'] == "PENDING")?"danger":"success";
                    var str ="<li>";
                    str +='<span class="text">Order no: #<u><a target="_blank" href="'+base_url+'orders/view/'+data[i]['id']+'">'+data[i]['so_id']+'</a></u> Booked Date: '+moment(data[i]['so_id']*1000).format('DD/MM/YYYY')+'</span>';
                    str +='<small class="label label-'+status+'"><i class="fa fa-clock-o"></i> '+data[i]['order_status']+'</small>';
                    str +='</li>';
                    
                    $latest_orders_element.find('.todo-list').append(str);
                }
            }else{
                 var str ="<li>";
                    str +='<span class="text">No Orders</span>';
                    str +='</li>';
                    $latest_orders_element.find('.todo-list').append(str);
            }
            
        });
    }
    
    module.orders_pie_graph = function( refresh ){
       
        orders_pie_lement.find('.custom_loader').removeClass('hide');
        
        if( !refresh){
            
            var start = moment().subtract(29, 'days').unix();
            var end = moment().unix();
            
            orders_pie_lement.find('.date-range').find('span').attr('data-start',start).attr('data-end',end);
            module.date_range_picker( orders_pie_lement.find('.date-range'),start,end,function($start_date,$end_date){
                load_pie_chart($start_date,$end_date,true);
            } );
        }
        
        function load_pie_chart($start_date,$end_date,refresh) {
            
                module.api_req({
                action:"orders_pie",
                shop_id:shop_id,
                start_date:$start_date,
                end_date:$end_date
            },function(resp){
                orders_pie_lement.find('.custom_loader').addClass('hide');
                var data = (resp.data)?resp.data:{};        
                console.log(data);
                
                if( refresh ){
                    window['orders_pie_chart'].setData( data );
                }else{
                     window['orders_pie_chart'] = new Morris.Donut({
                      element: orders_pie_lement.find('.chart-graph'),
                      resize: true,
                      colors: ["#3c8dbc", "#f56954", "#00a65a"],
                      data: data,
                      hideHover: 'auto'
                    });
                }
            }); 
        }
        $start_date = (start)?start:orders_pie_lement.find('.date-range').find('span').attr('data-start');
        $end_date = (end)?end:orders_pie_lement.find('.date-range').find('span').attr('data-end');
        load_pie_chart($start_date,$end_date,refresh); 
    }
    
    module.revenue_pie_graph = function(refresh){
        
        orders_revenue_element.find('.custom_loader').removeClass('hide');
        
        if( !refresh){
            
            var start = moment().subtract(29, 'days').unix();
            var end = moment().unix();
            
            orders_revenue_element.find('.date-range').find('span').attr('data-start',start).attr('data-end',end);
            module.date_range_picker( orders_revenue_element.find('.date-range'),start,end,function($start_date,$end_date){
                load_pie_chart($start_date,$end_date,true);
            } );
        }
        
        function load_pie_chart($start_date,$end_date,refresh) {
            
                module.api_req({
                action:"total_revenue",
                shop_id:shop_id,
                start_date:$start_date,
                end_date:$end_date
            },function(resp){
                orders_revenue_element.find('.custom_loader').addClass('hide');
                var data = (resp.data)?resp.data:{};        
                console.log(data);
                
                if( refresh ){
                    window['orders_pie_chart'].setData( data );
                }else{
                     window['orders_pie_chart'] = new Morris.Donut({
                      element: orders_revenue_element.find('.chart-graph'),
                      resize: true,
                      colors: ["#3c8dbc", "#f56954", "#00a65a"],
                      data: data,
                      hideHover: 'auto'
                    });
                }
            }); 
        }
        $start_date = (start)?start:orders_revenue_element.find('.date-range').find('span').attr('data-start');
        $end_date = (end)?end:orders_revenue_element.find('.date-range').find('span').attr('data-end');
        load_pie_chart($start_date,$end_date,refresh); 
        
    }
    
    module.date_range_picker = function( selector,start_date,end_date,callback ){
        
        var startDate = moment(start_date*1000) || moment().subtract(29, 'days');
        var endDate = moment(end_date*1000) || moment();
        
        selector.daterangepicker(
          {
            ranges   : {
              'Today'       : [moment(), moment()],
              'Yesterday'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
              'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
              'Last 30 Days': [moment().subtract(29, 'days'), moment()],
              'This Month'  : [moment().startOf('month'), moment().endOf('month')],
              'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
            },
            startDate: startDate,
            endDate  :endDate 
          },
          function (start, end) {
            selector.find('span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
            
            if( typeof callback == "function")
            callback(start.unix(),end.unix());
          }
        )
        
        selector.find('span').html(startDate.format('MMMM D, YYYY') + ' - ' + endDate.format('MMMM D, YYYY'));
    }
    
    
    module.api_req = function(data,callback){
        
        var request = {
                type: 'POST',
                url: base_url+'dashboard/get_list',
                data: data
            };
            
            EC.server.request(request, function (resp)
            {
                var out_data = JSON.parse( resp );
                
                callback(out_data);return;
              
            });
    }
    
    module.numberWithCommas = function(x) {
        
        if(x==undefined)return '';
        var parts = x.toString().split(".");
        parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        return parts.join(".");
    };
    
})( dashboardManager || ( dashboardManager = {} ) );

dashboardManager.init();