  window.holiday_data = {};
  $(document).ready(function() {

    $('#holiday_list').fullCalendar({
      header: {
        left: 'prev,next today',
        center: 'title',
        right: ''
      },
        events: function( start, end, timezone, callback ) {
                        
            $('#holiday_list').addClass('cal-loading');
                    function events_render( data ) {
                          var event = [];
                          window.holiday_data = {};
                          for( var i=0; i<data.length; i++){
                            
                              window.holiday_data[data[i].date] = data[i].reason;
                              
                             var $date = moment(data[i].date*1000).format("YYYY-MM-DD");
                             event.push({
                                            title: data[i].reason,
                                            start:$date,
                                            end: $date,
                                            start_date_str:data[i].date
                                            }); 
                            }
                             
                           callback(event);
                           $('#holiday_list').removeClass('cal-loading'); 
                           
                    }
                    
                    get_holiday_data(start,end,events_render);
                                                  
                   
            },
             eventClick: function(calEvent, jsEvent, view) {
                      console.dir(calEvent);
                      
                        var sel_date = calEvent.start_date_str;
                
                        var message = calEvent.title;
                        
                        render_holiday_form(sel_date,message);
                    },
              dayClick: function(date, jsEvent, view) {

                var sel_date = date.unix();
                
                var message ="";
                
                if( window.holiday_data && window.holiday_data[sel_date] != undefined ){
                    message = window.holiday_data[sel_date];
                }
                render_holiday_form(sel_date,message);
        
            },
            eventAfterRender:function( event, element, view ) {
            },
            eventAfterAllRender:function( view ) {
            }
    });

  });
  
  function get_holiday_data(start,end,callback) {
        
        window.holiday_data = {};
        
        var req = {
                type:'GET',
                url:base_url +'index.php/holidays/listing/'+start.unix()+'/'+end.unix(),
                data: {
                }
            }; 
 
        EC.server.request( req, function( resp )
        {
            resp = JSON.parse( resp );
            var data = resp.data;
            
            if ( typeof callback == 'function' ) callback( data );
        });              
    
  }
  
  function add_holiday( sel_date,message,callback ){
    
     var req = {
                type:'post',
                url:base_url +'index.php/holidays/add/'+sel_date,
                data: {
                    reason:message
                }
            }; 
 
        EC.server.request( req, function( resp )
        {
            resp = JSON.parse( resp );
            
            if ( typeof callback == 'function' ) callback( resp );
             
        });   
  }
  
    function delete_holiday( sel_date,callback ){
    
     var req = {
                type:'post',
                url:base_url +'index.php/holidays/delete/',
                data: {
                    sel_date:sel_date
                }
            }; 
 
        EC.server.request( req, function( resp )
        {
            resp = JSON.parse( resp );
            
            if ( typeof callback == 'function' ) callback( resp );
             
        });   
  }
  
  function render_holiday_form( sel_date,message ){
     
     var holidays_temp = new Element('#holiday-template');
     var $element = holidays_temp.element;
        
    $('.holiday_popup').remove();
    
    $element.addClass('holiday_popup').addClass('modal');
  
  
    $element.find('input[name="date"]').val(moment(sel_date*1000).format('YYYY-MM-DD'));
    $element.find('textarea[name="reason"]').val(message);
    
    $('body').append($element);
    
    $('.holiday_popup').modal();
   
     $('.holiday_popup').find('.delete').on('click',function(){
     
      delete_holiday(sel_date,function( resp ){
            
            $('.holiday_popup').find('.cancel').trigger('click');
            
                 if( resp.status == "success"){
                     EC.UI.flash(resp.message);
                     $('#holiday_list').fullCalendar('refetchEvents');
                   }else{
                     EC.UI.alert(resp.message);
                   }
                   
                   return;
            });
     });
    
    $('.holiday_popup').find('.save').on('click',function(){
        
        var message = $element.find('textarea[name="reason"]').val();
        
        if( $.trim(message) == "") {
             EC.UI.alert("Please Enter Reason"); return false;
        }
        
        add_holiday(sel_date,message,function( resp ){
            
            $('.holiday_popup').find('.cancel').trigger('click');
            
             if( resp.status == "success"){
                 EC.UI.flash(resp.message);
                 $('#holiday_list').fullCalendar('refetchEvents');
               }else{
                 EC.UI.alert(resp.message);
               }
               
               return;
        });
    });
    
    $('.holiday_popup modal').find('.delete').off('click').on('click',function(){
        $('.holiday_popup').remove();
    });
    
      $('.holiday_popup').find('.cancel').off('click').on('click',function(){
        $('.holiday_popup').find('.close').trigger('click');
        $('.holiday_popup').remove();
    });  
  }