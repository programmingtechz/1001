window.tpl = {};

window.Base64 = {_keyStr:"ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=",encode:function(e){var t="";var n,r,i,s,o,u,a;var f=0;e=Base64._utf8_encode(e);while(f<e.length){n=e.charCodeAt(f++);r=e.charCodeAt(f++);i=e.charCodeAt(f++);s=n>>2;o=(n&3)<<4|r>>4;u=(r&15)<<2|i>>6;a=i&63;if(isNaN(r)){u=a=64}else if(isNaN(i)){a=64}t=t+this._keyStr.charAt(s)+this._keyStr.charAt(o)+this._keyStr.charAt(u)+this._keyStr.charAt(a)}return t},decode:function(e){var t="";var n,r,i;var s,o,u,a;var f=0;e=e.replace(/[^A-Za-z0-9\+\/\=]/g,"");while(f<e.length){s=this._keyStr.indexOf(e.charAt(f++));o=this._keyStr.indexOf(e.charAt(f++));u=this._keyStr.indexOf(e.charAt(f++));a=this._keyStr.indexOf(e.charAt(f++));n=s<<2|o>>4;r=(o&15)<<4|u>>2;i=(u&3)<<6|a;t=t+String.fromCharCode(n);if(u!=64){t=t+String.fromCharCode(r)}if(a!=64){t=t+String.fromCharCode(i)}}t=Base64._utf8_decode(t);return t},_utf8_encode:function(e){e=e.replace(/\r\n/g,"\n");var t="";for(var n=0;n<e.length;n++){var r=e.charCodeAt(n);if(r<128){t+=String.fromCharCode(r)}else if(r>127&&r<2048){t+=String.fromCharCode(r>>6|192);t+=String.fromCharCode(r&63|128)}else{t+=String.fromCharCode(r>>12|224);t+=String.fromCharCode(r>>6&63|128);t+=String.fromCharCode(r&63|128)}}return t},_utf8_decode:function(e){var t="";var n=0;var r=c1=c2=0;while(n<e.length){r=e.charCodeAt(n);if(r<128){t+=String.fromCharCode(r);n++}else if(r>191&&r<224){c2=e.charCodeAt(n+1);t+=String.fromCharCode((r&31)<<6|c2&63);n+=2}else{c2=e.charCodeAt(n+1);c3=e.charCodeAt(n+2);t+=String.fromCharCode((r&15)<<12|(c2&63)<<6|c3&63);n+=3}}return t}};

function object_length ( obj )
{
    var l = 0, 
        key;
    
    for ( key in obj )
    {
        if ( obj.hasOwnProperty( key ) ) l++;
    }
    
    return l;
}

var ua = navigator.userAgent,
    touch_click = (ua.match(/(iPhone|iPod|iPad)/i)) ? "touchend" : "click";
    safari_win = ua.toLowerCase().indexOf("safari/") !== -1 && ua.toLowerCase().indexOf("windows") !== -1,
    browser = {
        is_safari: ( ua.indexOf('Safari') != -1 && ua.indexOf('Chrome') == -1 ),
        is_chrome: ( ua.indexOf('Chrome') > -1 ),
        is_ie: ( ua.indexOf('MSIE') > -1 || ( ua.indexOf('Mozilla') > -1 && ua.indexOf('Windows') > -1 && ua.indexOf('Chrome') == -1 ) ),
        is_firefox: ( ua.indexOf('Firefox') > -1 ),
        is_opera: ( ua.indexOf("Presto") > -1 )
    },
    os = {
        is_mac: ( navigator.appVersion.indexOf('Mac') != -1 ),
        is_windows: ( navigator.appVersion.indexOf('Win') != -1 ),
        is_linux: ( navigator.appVersion.indexOf('Linux') != -1 ),
        is_unix: ( navigator.appVersion.indexOf('X11') != -1 )
    };
    
new function ( self, undefined ) {

    self._data = {};
    self._elements = {};

    var data = {},
        elements = {},
        $templates_a = $('#dakbro-app-templates');

    // Needed before DOM ready ( used in JS files after this one )
    $templates_a.find('> div').each(function ()
    {
        self._elements[ this.id ] = new UI( this.id );
    });

    self.log = function ()
    {
        console.log('data:');
        console.dir( self._data );
        console.log('elements:');
        console.dir( self._elements );
    };

    self.init = function ( callback )
    {
        if ( typeof callback == 'function') callback();
    };

    // override basic functionality
    self.element = function ( name )
    {
        return ( self._elements[ name ] || new UI( name ) );
    };

    self.get = self.element;

    self.elements = function ( callback )
    {
        var all = [];

        for ( key in self._elements )
        {
            var elem = self._elements[ key ];

            all.push( elem )
        }

        if ( typeof callback == 'function') callback( all );

        return all;
    };

}( window.tpl );

 // define these templates after DOM ready 
// ( part of the hybrid solution )
new function ( self, undefined )
{
    var data = {},
        elements = {},
        $templates_b = $('.dakbro-app-template');

    $templates_b.each(function ()
    {
        var $temp = $( this ).find('> div')

        $temp.each(function ()
        {
            self._elements[ this.id ] = new UI( this.id );
        });
    });

    $templates_b.remove();

}( window.tpl );

/*
    basic UI component

    ( selector:string, data:object ) => UI:object
*/
function UI ( selector )
{
    // console.log( selector )

    if ( typeof selector == 'string') this.selector = '#'+selector;

    else this.selector = '';



    var template = $( this.selector );

    if ( template[ 0 ] == undefined ) template = $('<div><div class="' +selector+ '"></div></div>');

    this.element = $( template.detach() );

    this.element.addClass( this.element.attr('id') );

    this.element.removeAttr('id');
}

// ( modifier_fn:function ) => jQuery:object
UI.prototype.render = function ( modifier_fn )
{
    var $element = this.element.clone( true );

    $element.self = ( typeof modifier_fn == 'function' ? modifier_fn.self : this );
    // $element.self = this;

    if ( typeof modifier_fn == 'function') modifier_fn.call( $element );

    return $element;
};

var EC = (function(){

    var _priv = {},
        queue = {},
        request_hashes = [],
        debug = false;
 
    function dakbroBase () {}

    dakbroBase.prototype.env = function(){

        var environment;

        if ( location.href.indexOf('dakbroincredible.com') < 0 ) environment = 'localhost';

        else environment = 'production';

        return environment;
    };
    
    dakbroBase.prototype.debug = function( bool ){

        if ( typeof bool == 'boolean') debug = bool;

        else debug = true;
    };
    
    dakbroBase.prototype.server = {
        
        request: function( request_data, callback ){

            if ( request_data.data && request_data.data.attachments ) {}
            else  console.log('%c'+JSON.stringify( request_data, null, 4 ), 'color:blue;')
            // console.log('%c'+( arguments.callee.caller ), 'color:navy;')
            // console.log( Base64.encode( callback.toString().trim() ) )


            // if ( ! window.connect ) return; 


            var server = this,
                request = Base64.encode( JSON.stringify( request_data ) ),
                // request = Base64.encode( JSON.stringify( request_data.data || request_data ) ),
                callback = callback;

            // console.log('%c'+request, 'color:lightblue;')

            if ( queue[ request ] == undefined 
                && object_length( queue ) < 10 ) // maximum n-1 simultaneous requests
            {
                // console.log( request )

                queue[ request ] = $.ajax( request_data ).done(function( response ){

                    // if ( request_hashes )
                    if ( response == undefined || response == '') return;

                    // maintenance mode > 1
                    // if ( response == 'Reload page' || response == 'reload')
                    if ( response == 'maintenance_mode' 
                        || response.indexOf('<html id="maintenance_mode">') == 0 )
                    {
                        console.error('Maintenance mode');
                        console.error( Base64.decode( request ) );


                        EC.UI.flash('Sorry for the inconvenience, a system upgrade is in progress. <br><br>Click "OK" and you will be logged out. <br><br>Please log in again in a few minutes. <br><br>Thank you,<br> -the Dakbro team', 4000) // 4000 is the duration of the toast
                        
                        $( document ).off('keyup');

                        return;
                    }
                     // server error
                    else if ( response == 'Reload page' 
                        || response == 'reload' 
                        || response == 'server error')
                    {
                        console.error('Server reload');
                        console.error( Base64.decode( request ) );

                        location.reload();

                        return;
                    }

                    if( queue[ request ] !== undefined  )
                        delete queue[ request ];

                    if ( debug )
                    {
                        try
                        {
                            var o = JSON.parse( response );

                            console.dir( o )
                        }

                        catch ( e )
                        {
                            console.log( response )
                        }
                    }

                    callback( response );
                });
                
                //queue request cleanup
                setTimeout(function(){

                    if ( queue[ request ] !== undefined  ) 
                    {
                        console.log('cleared');
                        if( queue[ request ] !== undefined  )
                            delete queue[ request ];
                    }
                
                }, 80000 );
            }

            else if ( queue[ request ] == undefined )
            {
                setTimeout(function(){

                    if ( debug ) console.log('delaying 100ms');

                    server.request( request_data, callback );
                
                }, 100 );
            }

            else 
            {
                // delete queue[ request ];

                // server.request( request_data, callback );
                // queue[ request ].done( callback );
                console.log('%cRequest denied: '+request, 'color:#ea9;')
                console.dir( request_data )
            }
        },
        flush: function(){ queue = {} }
    };

    dakbroBase.prototype.queue_list = queue;
    
    dakbroBase.prototype.remove_queue = function( req ) {
        if ( queue[ req ] != undefined ) delete queue[ req ];
    };
    
    dakbroBase.prototype.events = $({});
    
    dakbroBase.prototype.UI = {
        
        flash: function ( msg, delay )
        {
            
            var str = '<div id="div_service_message" class="Metronic-alerts alert alert-success fade in">';
            
            str += '<button class="close" aria-hidden="true" data-dismiss="alert" type="button">';
            str += '<i class="fa-lg fa fa-warning"></i></button>';
            str += '<strong>Success:&nbsp;</strong>'+msg;
            str += '</div>';
            
            var is_model = ($(".modal.in").length)?true:false;
           
            if( is_model ) {
                
                if( !$(".modal.in").find('#flash').length)
                     $(".modal.in").prepend("<div id='flash'></div>");
                     
                var flash = $(".modal.in #flash");
            }
            else{
                var flash = $('#flash');
            }
           
            flash.fadeIn( 50 ).html(str);

            setTimeout(function ()
            {
                flash.fadeOut( 500, function ()
                {
                   flash.html('');
                });

            }, delay || 4000 );
        },
        alert: function( msg, delay )
        {
            var str = '<div id="div_service_message" class="Metronic-alerts alert alert-danger fade in">';
            
            str += '<button class="close" aria-hidden="true" data-dismiss="alert" type="button">';
            str += '<i class="fa-lg fa fa-warning"></i></button>';
            str += '<strong>Success:&nbsp;</strong>'+msg;
            str += '</div>';
            
             var is_model = ($(".modal.in").length)?true:false;
           
            if( is_model ) {
                
                if( !$(".modal.in").find('#flash').length)
                     $(".modal.in").prepend("<div id='flash'></div>");
                     
                var flash = $(".modal.in #flash");
            }
            else{
                var flash = $('#flash');
            }
            
            flash.fadeIn( 50 ).html(str);

            setTimeout(function ()
            {
                flash.fadeOut( 500, function ()
                {
                    flash.html('');
                });

            }, delay || 4000 );
        }
    };

    return new dakbroBase();
})();


var Element = (function ( $ )
{
    function Element ( selector, data )
    {
        this.selector = selector || '<div><div></div></div>';

        this.template = $( selector );

        // this.element = $( selector ).clone();
        this.element = $( this.template.html() );

        this.element.data = data || {};

        this.element.removeAttr('id');
    }

    Element.prototype.render = function () { return this.element; };

    return Element;

})( jQuery );

// Reactive module with UI component
var Thing = new function ( tpl )
{
    function Thing ( name, items, data, render_fn )
    {
        // var renderer = render_fn || function () {};
        this.renderer = render_fn || function () {};

        this.renderer.self = this;

        this.name = name || '';

        this.items = items || [];

        this.data = data || {};

        this.ui = tpl.element( name );
        
        this.element = this.ui.render( this.renderer );
    }

    // Use to change properties on the object (will update UI automatically)
    Thing.prototype.val = function ( key, val ) 
    {
        if ( key === undefined ) return '';

        else if ( val === undefined ) return this.data[ key ] || '';

        else
        {
            var old_val = this.data[ key ] || '';

            this.data[ key ] = val;

            this.element.trigger('value_change', [ key, old_val, val ]);
        }
    };

    Thing.prototype.reset = function ( key )
    {
        if ( key === undefined ) return;

        else
        {
            var old_val = this.data[ key ] || '';

            delete this.data[ key ];

            this.element.trigger('value_change', [ key, old_val, '' ]);
        }
    };

    // new Thing( ... ).view( modifier_fn ).appendTo('container') || $('container').append( new Thing( ... ).view( modifier_fn ) )
    Thing.prototype.view = function ( modifier_fn ) 
    {
        var $element = this.element;
        // var $element = this.ui.render( this.renderer );

        $element.self = this;

        data_bind.call( $element );

        if ( typeof modifier_fn == 'function') modifier_fn.call( $element );

        return $element;
    };

    return Thing;

}( window.tpl );

function data_bind ()
{
    var self = this.self,
        $this = this;

    $this
        .find('input[data-name]')
        .each(function ()
        {
            var key = $( this ).attr('data-name'),
                val = self.val( key );

            $( this )
                .val( val )
                .on('input', function () 
                {
                    self.val( key, $(this).val() )
                });
        });

    $this
        .find('*[data-bind]')
        .each(function ()
        {
            var name = $( this ).attr('data-bind');

            $( this )
                .text( self.val( name ) );
        })

    $this
        .find('*[data-height]')
        .each(function ()
        {
            var name = $( this ).attr('data-height'),
                val = self.val( name );

            $( this )
                .css('height', function ()
                {
                    var type = __type.call( val ),
                        result;
                    
                    // console.dir( $( this ) )
                    console.dir( type )

                    switch ( type )
                    {
                        case 'string': result = val.length;
                            break;

                        case 'number': result = val;
                            break;

                        case 'array': result = val.length;
                            break;

                        case 'object': result = new Date().getTime() / 10000000000;
                            break;

                        default: result = 0;
                            break;
                    }

                    return result;

                    // return self.val( name ).length
                }); 
        })

    $this
        .find('*[data-width]')
        .each(function ()
        {
            var name = $( this ).attr('data-width'),
                val = self.val( name );

            $( this )
                .css('width', function ()
                {
                    var type = __type.call( val ),
                        result;
                    
                    // console.dir( $( this ) )
                    console.dir( type )

                    switch ( type )
                    {
                        case 'string': result = val.length;
                            break;

                        case 'number': result = val;
                            break;

                        case 'array': result = val.length;
                            break;

                        case 'object': result = new Date().getTime() / 10000000000;
                            break;

                        default: result = 0;
                            break;
                    }

                    return result;

                    // return self.val( name ).length
                }); 
        })

    $this
        .on('value_change', function ( event, key, old_val ) 
        {
            var val = self.val( key );

            $this
                .find('input[data-name="' +key+ '"]')
                .val( val );

            $this
                .find('*[data-bind="' +key+ '"]')
                .text( val );

            $this
                .find('*[data-height="' +key+ '"]')
                .css('height', function ()
                {
                    var type = __type.call( val ),
                        result;
                    
                    // console.dir( $( this ) )
                    console.dir( type )

                    switch ( type )
                    {
                        case 'string': result = val.length;
                            break;

                        case 'number': result = val;
                            break;

                        case 'array': result = val.length;
                            break;

                        case 'object': result = new Date().getTime() / 10000000000;
                            break;

                        default: result = 0;
                            break;
                    }

                    return result;
            });

            $this
                .find('*[data-width="' +key+ '"]')
                .css('width', function ()
                {
                    var type = __type.call( val ),
                        result;
                    
                    // console.dir( $( this ) )
                    console.dir( type )

                    switch ( type )
                    {
                        case 'string': result = val.length;
                            break;

                        case 'number': result = val;
                            break;

                        case 'array': result = val.length;
                            break;

                        case 'object': result = new Date().getTime() / 10000000000;
                            break;

                        default: result = 0;
                            break;
                    }

                    return result;
            });
    });
}

var tpj=jQuery;			
var revapi4;
tpj(document).ready(function() {
	if(tpj("#rev_slider").revolution == undefined){
		revslider_showDoubleJqueryError("#rev_slider");
	}else{
		revapi4 = tpj("#rev_slider").show().revolution({
			jsFileLocation:"script/",
			sliderType:"standard",
			sliderLayout:"fullwidth",
			dottedOverlay:"none",
			delay:9000,
			responsiveLevels:[1920,1189,959,767,479],
			gridwidth:[1170,940,750,460,300],
			gridheight:$gridheight,
			lazyType:"none",
			navigation: {
				keyboardNavigation:"on",
				mouseScrollNavigation:"off",
				onHoverStop:"on",
				keyboard_direction: "horizontal",
				touch:{
					touchenabled:"on",
					swipe_treshold : 75,
					swipe_min_touches : 1,
					drag_block_vertical:false,
					swipe_direction:"horizontal",
				},
				arrows: {
					style:"preview1",
					enable:true,
					hide_onmobile:true,
					hide_onleave:true,
					hide_delay:200,
					hide_delay_mobile:1500,
					hide_under:0,
					hide_over:9999,
					tmp:'',
					left: {
						h_align:"left",
						v_align:"center",
						h_offset:0,
						v_offset:0,
					},
					right: {
						h_align:"right",
						v_align:"center",
						h_offset:0,
						v_offset:0,
					}
				},
				bullets: {
					style:"preview1",
					enable:true,
					hide_onmobile:true,
					hide_onleave:true,
					hide_delay:200,
					hide_delay_mobile:1500,
					hide_under:0,
					hide_over:9999,
					direction:"horizontal",
					h_align:"center",
					v_align:"bottom",
					space:10,
					h_offset:0,
					v_offset:20,
					tmp:'<span class="tp-bullet-image"></span><span class="tp-bullet-title"></span>'
				},
			},
			shadow:0,
			spinner:"spinner1",
			stopAfterLoops:-1,
			stopAtSlide:-1,
			disableProgressBar: "on",
			shuffle:"off",
			autoHeight:"off",
			hideSliderAtLimit:0,
			hideCaptionAtLimit:0,
			hideAllCaptionAtLilmit:0,
			debugMode:false,
			fallbacks: {
				simplifyAll:"off",
				nextSlideOnWindowFocus:"off",
				disableFocusListener:false,
			}
	});
	}
    

     	$('.template-header-top').templateHeader();
        $('#template-booking').booking();
      
        loginManager.render();
        
        $('.page-shops .add_info li').on('click',function(){
            $(this).parents('.row').find('.shop_sub_data').html($(this).find('span').html());
        });
      
        $('.page-shops .add_info li:first-child').trigger('click');
        
    	$('.template-component-google-map-button').on('click',function(e)
			{
				e.preventDefault();
				if(!$('.template-component-google-map').hasClass('template-state-open'))
				{
					$('.template-component-google-map .template-component-google-map-box').animate({'height':400},{duration:500,complete:function()
					{
						$('.template-component-google-map').addClass('template-state-open');
					}});
				}
				else
				{
					$('.template-component-google-map .template-component-google-map-box').animate({'height':0},{duration:500,complete:function()
					{
						$('.template-component-google-map').removeClass('template-state-open');
					}});						
				}
			});
        
       
}); /*ready*/

function phonenumber(inputtxt)
{
  var phoneno = /^\d{10}$/;
  if(inputtxt.value.match(phoneno) )
    {
    return true;
    }
    else
    {
    return false;
    }
}

var loginManager = {};
(function ( module )
{    
    var $elm,phone_no;
    module.render = function(){
        
            var divs = $('.logindivs>div');
            var now_div = 0; // currently shown div
            divs.hide().first().show();
       
          $('a[data-target="#phoneModal"]').on('click',function(){
           
                $("#phoneModal").modal();
                
                $elm = $('.phoneModal-popup');
                $elm.find('.login-form input,.verify-form input').val('');
                if($elm.find(".store-find").css('display') == 'none')
                    $elm.find('button[name="login-prev"]').trigger('click');
            
                $elm.find("button[name=login-prev]").click(function(e) {
                    $elm.find('.verify-form input').val('');
                    $elm.find(".errmsg").html('');
                      divs.eq(now_div).hide();
                    now_div = (now_div > 0) ? now_div - 1 : divs.length - 1;
                    divs.eq(now_div).show(); // or .css('display','block');
                   
                });
               
                $elm.find(".login-form").on('submit',function(e) {
                    
                    
                    phone_no = $elm.find('#verify-Phone').val();
                  
                    if( $.trim(phone_no) == "" ){
                        $elm.find(".errmsg").html('Enter Valid number');return false;
                    }
                    module.add_loader();
                    module.login(function( resp ){
                        
                        module.remove_loader();
                        if( resp.status == 'success') {
                            $elm.find(".errmsg").html('Verification key sent to your phone number.');
                            divs.eq(now_div).hide();
                            now_div = (now_div + 1 < divs.length) ? now_div + 1 : 0;
                            divs.eq(now_div).show(); // show next
                        }else{
                            
                            var msg = 'Error Occured. Please try again later.';
                            
                            if( resp.msg != undefined  ){
                                msg = resp.msg;
                            }
                            
                            $elm.find(".errmsg").html(msg)
                        }
                    });
                  
                    return false;
                });
                
                $elm.find(".verify-form").on('submit',function(e) {
                 
                    module.add_loader();
                    
                    module.verify($( this ).serializeArray(),function( resp ){
                        
                        module.remove_loader();
                        
                        if( resp.status == 'success') {
                            
                            if( resp.data != undefined ) {
                                window.user_data = resp.data;
                                module.open_user_menu();
                                $('.page-booking .email-phone').css('display', 'none');
                            }
                            
                           $elm.find(".close-pop ").trigger('click');
                        }else{
                            $elm.find(".errmsg").html(resp.msg);
                        }
                    });
                  
                    return false;
                });
                
            });
    };
    
    module.open_user_menu = function(){
        var $user_name ="";
        
        if( window && window.user_data  )
            $user_name = (  (window.user_data.user_name == 'null' || window.user_data.user_name == '' || !window.user_data.user_name) )?window.user_data.phone:window.user_data.user_name;
        $('a[data-target="#phoneModal"]').replaceWith('<span>('+$user_name+')</span><a href="'+ base_url+'/login/logout'+'">Logout</a>');
        $('.my_account_menu').removeClass('hide');
    }
    
    module.add_loader = function(){
        $elm.find(".load").addClass('loader');
    }
    
    module.remove_loader = function(){
        $elm.find(".load").removeClass('loader');
    }
    
    module.timer_reset = function(){
        
    }

    module.login = function( callback ){
        
        var request = {
                type: 'POST',
                url: base_url+'login',
                data: {
                    phone_no: phone_no
                }
            };
            
        EC.server.request(request, function (resp)
        {
            var resp = JSON.parse( resp );
            
            if ( typeof callback == 'function') callback(resp);
          
        });


    };
    
     module.verify = function( verify_data, callback ){
        
        var request = {
                type: 'POST',
                url: base_url+'login/verify',
                data: {
                    phone_no: phone_no,
                    verify_data:verify_data
                }
            };
            
        EC.server.request(request, function (resp)
        {
            var resp = JSON.parse( resp );
            
            if ( typeof callback == 'function') callback(resp);
          
        });


    };

})(loginManager || ( loginManager = {} ));


function contactForm(){
    
      var request = {
                type: 'POST',
                url: base_url+'contact/add',
                data: {
                    data: $('#contact-form').serializeArray()
                }
            };
        $('.template-state-block').block({message:false,overlayCSS:{opacity:'0.2'}});    
        EC.server.request(request, function (resp)
        {
            grecaptcha.reset();
            var resp = JSON.parse( resp );
            
            if( resp['status'] == 'success'){
                $('input[name ="contact-form-name"],input[name ="contact-form-phone"],input[name ="contact-form-email"],#contact-form textarea[name ="contact-form-message"]').val("");
                $('#contact-form').find('.warning-msg').addClass('success').removeClass('error');
            }else {
                $('#contact-form').find('.warning-msg').addClass('error').removeClass('success');
            }
            $('#contact-form').find('.warning-msg').html(resp['msg']);
            
            $('.template-state-block').unblock();
          
        });
        
}

function isValidPhonenumber(inputtxt = '')
{
    var phoneno = /^\d{10}$/;
    if((inputtxt.match(phoneno))) {
      return true;
    } else{
        return false;
    }
}

function isValidaEmail(email) {
    var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(String(email).toLowerCase());
}