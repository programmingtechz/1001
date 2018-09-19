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

            //scrool the doc to top.
            EC.UI.scrollToTop();

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

            //scrool the doc to top.
            EC.UI.scrollToTop();

            setTimeout(function ()
            {
                flash.fadeOut( 500, function ()
                {
                    flash.html('');
                });

            }, delay || 4000 );
        },
        scrollToTop: function(){
            $('html, body').animate({scrollTop: 0}, 800, function(){});
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


var helperManager = {};

(function ( module )
{
    var initialized = false;
    var current_processing_uploads ={};

    // Call on document.ready
    module.init = function ( ) 
    {
        
    }
    
    module.convertToGMT = function (day_number, hour, min, ampm)
    {
        var d = moment.tz( helperManager.timezone ),
            hour = (hour == undefined?0:hour),
            min = (min == undefined?0:min) ,
            ampm = (ampm == undefined?'am':ampm),
            hour = hour==12 ?0:hour,
            hour= (ampm=='am'?0:12)+hour,
            actual_date = moment.tz([d.year(), d.month(), d.date(), hour, min ], helperManager.timezone );

        var timestamp = actual_date.day( day_number ).valueOf();

        var gmt_date = moment.tz( timestamp, 'UTC');

        day_number = gmt_date.day();

        var org_hour = gmt_date.hours(),
            org_min = gmt_date.minutes(),
            org_min = (org_min<=9)?'0'+org_min:org_min,
            org_ampm = (org_hour >= 12)?'pm':'am';
            org_hour = (org_hour > 12)?org_hour-12:org_hour;
            org_hour = org_hour==12 ?0:org_hour;

       return [ org_hour ,org_min ,org_ampm, day_number ];
    }

    module.convertToLocal = function (day_number, hour, min, ampm)
    {
        var d = moment.tz( helperManager.timezone ),
            hour= (hour == undefined?0:hour),
            min = (min == undefined?0:min) ,
            ampm= (ampm == undefined?'am':ampm),
            hour= (hour == 12 )?0:hour,
            hour= (ampm=='am'?0:12)+hour;

        var timestamp = moment.tz([d.year(), d.month(), d.date(), hour, min ], 'UTC').day( day_number ).valueOf();

        var ld = moment.tz( timestamp, helperManager.timezone );

        var org_hour = ld.hours(),
            org_min  = ld.minutes(),
            org_min = (org_min<=9)?'0'+org_min:org_min,
            org_ampm = (org_hour >= 12)?'pm':'am',
            org_hour = ( org_ampm=='am' && org_hour==0 )?12:org_hour,
            org_hour =  (org_hour > 12)?org_hour-12:org_hour;

        day_number = ld.day();
        
       return [ org_hour ,org_min ,org_ampm, day_number ];
    }
    
    module.object_length = function ( obj )
    {
        var l = 0, 
            key;
        
        for ( key in obj )
        {
            if ( obj.hasOwnProperty( key ) ) l++;
        }
        
        return l;
    }

    module.loader = function(option){
        
        if( option && option == 'close'){
            $('.preloader-wrapper').removeClass('active');
            $('body').removeClass('force-loader');
            
        }else{
            $('.preloader-wrapper').addClass('active');
            $('body').addClass('force-loader');
        }
        
    }
    
   module.parse_time = function( moment_obj,prefix ){
        
        prefix = (prefix)?prefix:"";
        
        $postHourFormat = window.UserSettings.postHourFormat;
        
        if( $postHourFormat == '12h') {
            $format = moment_obj.format(prefix+'h:mm A');
        }else {
           $format =  moment_obj.format(prefix+'H:mm');
        }
        
        return $format;
        
    }
    module.amp_encode = function (str)
    {
        str = str.toString();
        return str.replace(/\&/g,'&amp;');
    }
    
    module.amp_decode = function(str)
    {
        str = str.toString();
        return str.replace(/\&amp\;/g,'&');
    }
    
    module.for_each = function( array, fn ) 
    {
        var array = Array.isArray( array ) ? array : [ array ];
    
        for ( var index = 0, length = array.length; index < length; ++index ) fn( array[ index ], index, length );
    }
    
    module.exportToCsv = function(filename, rows, callback) 
    {
        var processRow = function (row) 
        {
            var finalVal = '';
            for (var j = 0; j < row.length; j++) {
                var innerValue = row[j] === null ? '' : row[j].toString();
                if (row[j] instanceof Date) {
                    innerValue = row[j].toLocaleString();
                };
                var result = innerValue.replace(/"/g, '""');
                if (result.search(/("|,|\n)/g) >= 0)
                    result = '"' + result + '"';
                if (j > 0)
                    finalVal += ',';
                finalVal += result;
            }
            return finalVal + '\n';
        };
    
        var content = '\ufeff';
        for (var i = 0; i < rows.length; i++) {
            content += processRow(rows[i]);
        }
    
        downloadToFile(content, filename, 'text/csv;charset=utf-8');
    
        if ( typeof callback === 'function' ) callback();
    }

    module.downloadToFile = function(content, fileName, mimeType) 
    {
        var a = document.createElement('a');
        mimeType = mimeType || 'application/octet-stream';
    
        if (navigator.msSaveBlob) { // IE10
            return navigator.msSaveBlob(new Blob([content], { type: mimeType }), fileName);
        } 
        else if ('download' in a || browser.is_safari) { //html5 A[download]
            a.href = 'data:' + mimeType + ',' + encodeURIComponent(content);
            a.setAttribute('download', fileName);
            if ( browser.is_safari ) a.target = '_blank';
            document.body.appendChild(a);
            setTimeout(function() {
              a.click();
              document.body.removeChild(a);
            }, 100);
            return true;
        } 
        else { //do iframe dataURL download (old ch+FF):
            var f = document.createElement('iframe');
            document.body.appendChild(f);
            f.src = 'data:' + mimeType + ',' + encodeURIComponent(content);
    
            setTimeout(function() {
              document.body.removeChild(f);
            }, 333);
            return true;
        }
    }
    
    module.replaceURLWithHTMLLinks = function(text) {
        if (typeof text != "string") return;
        var exp = /(\b(https?|ftp|file):\/\/[-A-Z0-9+&@#\/%?=~_|!:,.;]*[-A-Z0-9+&@#\/%=~_|])/ig;
        return text.replace(exp,"<a href='$1' target='_blank'>$1</a>");
    }
    
    module.build_tooltip = function(){
        $('.material-tooltip').remove();
        $('.tooltipped').tooltip({delay: 50});
    }
    
    module.object_length = function( obj )
    {
        var l = 0, 
            key;
        
        for ( key in obj )
        {
            if ( obj.hasOwnProperty( key ) ) l++;
        }
        
        return l;
    }
    
    module.findUrls = function( text )
    {
        var source = (text || '').toString(),
            urlArray = [],
            url,
            matchArray,
            regexToken = /(((ftp|https?):\/\/)[\-\w@:%_\+.~#?,&\/\/=]+)|((mailto:)?[_.\w-]+@([\w][\w\-]+\.)+[a-zA-Z]{2,3})/g;
    
        while ( ( matchArray = regexToken.exec( source ) ) !== null )
        {
            var token = matchArray[0];
        
            urlArray.push( token );
        }
        
        return urlArray;
    }
    
    module.get_image_dimension = function(file,ext,callback) {
    
        if( ['mov','avi','mp4'].indexOf(ext) !== -1 ) {
            callback('','',file);
            return;
        }
        
        var img = new Image();

        img.src = window.URL.createObjectURL( file );
    
        img.onload = function() {
            var width = img.naturalWidth,
                height = img.naturalHeight;
    
            window.URL.revokeObjectURL( img.src );
            
           callback(width,height,file);
        };
        
    }
    
    module.check_image_size = function( key,is_video,callback ){
    
        callback();return;
        
            if( is_video ) {
                callback();return;
            }
        
            var request = {
                type: 'POST',
                url: 'ajax.php',
                data: {key:key,action:'getImageSize'}
            };
            
            EC.server.request(request, function (resp)
            {
                var data = JSON.parse( resp );
                
                try{
                    if( data && data.size ) {
                        console.log('updated-size'+data.size);
                        callback(data.size);return;
                    }else{
                        callback();return;
                    }
                    
                }catch(e){
                    console.log(e);
                    callback();return;
                }
              
            });
    }
    
     module.set_current_processing_uploads = function( key, data )
    {
        if( ! key ) {
            current_processing_uploads = [];
        }
        else
        {
            current_processing_uploads[key] = data;
        }
             
    };
    
    module.destroy_current_processing_uploads = function( $element )
    {
        console.log('uploads destroy');
        try{
            current_processing_uploads = [];
            
            if( $element ) {
                $('body .uploading').removeClass('uploading');
                $element.find('.post-media center').html('');
            }
        }
        catch( e ) {
            //console.log('uploads destroy err:'+e.message);
        }
             
    };
     module.update_current_processing_uploads = function( key )
    {
        if( key ){
            var new_data = [];
			 for (var k in current_processing_uploads ) {
				if (  k != key ) {
				   new_data[k] = current_processing_uploads[k];
				}
			}
          current_processing_uploads = new_data;
        }     
    };
    
    module.get_current_processing_uploads = function( key )
    {
        if( key && current_processing_uploads[key] != undefined ){
            return current_processing_uploads[key];
        }else if( key ) {
            return false;
        }
        
        return current_processing_uploads;        
    };
    
    module.unique_name_with_uuid = function($suffix,$prefix){
        
        var name ='';
        $suffix = (!$suffix)?"":$suffix;
        $prefix = (!$prefix)?"":$prefix;
        var d = new Date();
        var n = d.getTime(); 
        
        name = $prefix+uuid.v1()+'_'+ n +$suffix;
        return name;
    }
    
    module.s3_upload = function(params,callback,skip_thumbnail){
            
            if( !params ) {
                callback(); return;
            }
            
            var $parallel_uploads_limit =1; //to set parallel uploads limit
            
            if( $parallel_uploads_limit == Object.keys(helperManager.get_current_processing_uploads()).length ) {
                callback('','Please wait until the Previous upload(s) is complete'); return;
            }
            
            if( params.file_name != undefined ){
                params.file_name = params.file_name.replace(/[^\w\s]/gi, '');
            }
            
            var self = this,
                bucket = '',
                thumb_bucket = '',
                thumb_key = '',
                file = (params.file != undefined)?params.file:false,
                progress_elem = (params.progress_elem != undefined)?params.progress_elem:false,
                ext = (params.ext != undefined)?params.ext:false,
                suffix = "."+ext,
                $file_name = params.file_name,
				$file_type = params.file_type,
                thumbnail_chk_cnt = 0,
                max_thumb_chk_cnt = 10,
				$file_size = params.file_size,
                $video_thumb_ext = "",
                $start_timeout = 2000,
                $loop_timeout = 500,
                $is_video = false,
                bucket_inner_dir= (params.bucket_inner_dir != undefined)?params.bucket_inner_dir:'',
                uniq_file_name = (params.uniq_file_name != undefined)?params.uniq_file_name:false;
                
                if( bucket_inner_dir ) thumb_key = bucket_inner_dir;
            
            //bucket set
            if( params.bucket != undefined ) {
                bucket = params.bucket;
            }
            else {
                
                if( ext && ['mov','avi','mp4'].indexOf(ext) !== -1 ) {
                    
                }
                else
                {
                    bucket ="prod-dakbro";  
                }             
            }
            
            if( !bucket || !file ) { callback(); return;}

            uniq_file_name = ( uniq_file_name )?uniq_file_name:unique_name_with_uuid();
            
            var file_name = uniq_file_name+suffix;
            
            helperManager.set_current_processing_uploads(file_name,{});
            
            
            $.ajax({url:  window.base_url+'users/signing_url', data: {"bucket":bucket}, dataType: "json", type: "POST"})
                    .done(function (data) {
                        
                        /*var $params = {
                            "AWSAccessKeyId": data.awsKey,
                            "policy": data.policy,
                            "signature":data.signature,
                            "region": "us-east-1",
                            Key: bucket_inner_dir+file_name,
                             ContentType: $file_type,
                             Body: file                        
                        };*/
                        //console.log('$params',$params);
                         AWS.config.update({
                            accessKeyId : window.accessKeyId,
                            secretAccessKey : window.secretAccessKey
                        });
					   
                        if( helperManager.get_current_processing_uploads(file_name) === false ){
                             return;//callback();
                        }
                        
                        var bucket_obj = new AWS.S3({params: {Bucket: bucket,ACL:'public-read'},httpOptions :{timeout:1200000}});
                         
                        var thumb_img_name = ( $video_thumb_ext != "" )? thumb_key+uniq_file_name+$video_thumb_ext : thumb_key+uniq_file_name+suffix;
                                                
                        var params = {Key: bucket_inner_dir+file_name, ContentType: $file_type, Body: file};
                        
                        var upload_obj = bucket_obj.upload(params);
                        
                        upload_obj.on('httpUploadProgress', function(evt) {
                            if( progress_elem ) progress_elem.text('Uploading... (' +( parseInt((evt.loaded * 100) / evt.total) )+ '%)');
                            
                            if( helperManager.get_current_processing_uploads(file_name) === false ){
                                try{
                                    upload_obj.abort();
                                }catch( e ){
                                    console.log('upload abort error:'+e.message);
                                }
                                //callback();
                            }
                            
                        }).send(function(err, data) {
                        
                            if(!err) {
                            
                                if( helperManager.get_current_processing_uploads(file_name) === false ){
                                    return;//callback();
                                }
                                
                                response = {};
                                response.source = 'upload';
                                response.name = $file_name;
                                response.size = $file_size;
                                response.type = $file_type;
                                response.file = "";
                                response.ext = ext;
                                response.location = bucket_inner_dir + file_name;
                                response.s3_url = bucket+ "/" + bucket_inner_dir+ file_name;
                                helperManager.set_current_processing_uploads(file_name,response);
                                
                                var check_thumbnail = function( file_name,thumb_bucket,thumb_img_name,thumbnail_chk_cnt ) {
                                    console.log("thumbnail_chk_count:"+thumbnail_chk_cnt);
                                    if( thumbnail_chk_cnt == max_thumb_chk_cnt ) {
                                        var res =  helperManager.get_current_processing_uploads(file_name);
                                        helperManager.update_current_processing_uploads(file_name);                                        
                                        
                                        if($is_video){
                                            callback('','Uploading Failed.');
                                        }else{
                                            callback(res);
                                        }
                                        return;
                                    }
                                
                                    var obj = new AWS.S3({params: {Bucket: thumb_bucket, Key: thumb_img_name}});
                                    obj.getObject(function(err) {
                                        if (err) {
                                            console.log("File is not present");
                                            thumbnail_chk_cnt++;
                                            console.dir(err);
                                            setTimeout(function(){
                                                
                                                if( helperManager.get_current_processing_uploads(file_name) )
                                                    check_thumbnail(file_name,thumb_bucket,thumb_img_name,thumbnail_chk_cnt);
                                                else
                                                {
                                                    helperManager.update_current_processing_uploads(file_name);
                                                    //callback();
                                                }
                                                
                                            },$loop_timeout);                                            
                                        }
                                        else {
                                            
                                            var res = helperManager.get_current_processing_uploads(file_name);
                                            
                                            if( res === false ){
                                                 return;//callback();
                                            }
                                            
                                            res.imageThumbnail = thumb_bucket+ "/" + thumb_img_name;
                                            
                                            helperManager.update_current_processing_uploads(file_name); 
                                            console.dir(res);
                                            if($is_video) {
                                                
                                                    res.videoData ={};
                                                    res.videoData.videoThumbnails ={};
                                                    res.videoData.videoThumbnails.thumbnail = [];
                                                    
                                                    for(var i=1; i<=10; i++ ) {
                                                        $video_thumbnail = thumb_bucket+ "/" +thumb_key + uniq_file_name + "_" + i + '.png';
                                                        res.videoData.videoThumbnails.thumbnail.push($video_thumbnail);
                                                    }
                                                                                                        
                                                    res.location = bucket_inner_dir + uniq_file_name+'.mp4';
                                                    res.s3_url = 'https://s3.amazonaws.com/prod-dakbro'+ "/" + bucket_inner_dir + uniq_file_name+'.mp4'; //converted video path
                                                    res.ext = 'mp4';
                                            }
                                            else
                                            {
                                                callback(res);
                                            }
                                            
                                        }
                                    });
                                };
                                
                                if( !skip_thumbnail ) {
                                      setTimeout(function() {
                                        check_thumbnail(file_name,thumb_bucket,thumb_img_name,thumbnail_chk_cnt);
                                    },$start_timeout);
                                }
                                else {
                                    var res = helperManager.get_current_processing_uploads(file_name);
                                    helperManager.update_current_processing_uploads(file_name); 
                                    callback(res);
                                }
                              
                                
                                if($is_video)
                                    progress_elem.html('<img src="/img/prepare-load.gif" />');
                                
                            }
                            else {
                                console.dir(err);
                                helperManager.update_current_processing_uploads(file_name);
                                //callback();
                            }
                        
                    });
         
            }).fail(function (error) {
                            console.log(JSON.stringify(error));
                            helperManager.update_current_processing_uploads(file_name);
                             callback('','Uploading Failed.');
            });
           
           return true;
    }
    
    module.create_upload = function(btn,$upload_element,maxUploads,maxSize,chk_dim_w,chk_dim_h,update_file,multiple,name,allowedExtensions,videoMaxSize){
        
        var uploader = new ss.SimpleUpload({
                    button: btn,
                    url: 'UploaderHelper',
                    name: name || 'uploadfile',
                    multiple: multiple || false,
                    maxUploads: maxUploads || 1,
                    is_customized:true,
                    maxSize: maxSize || 5120,
                    videoMaxSize: videoMaxSize,
                    debug: false,
                    responseType: 'json',
                    allowedExtensions:  allowedExtensions || ['jpg', 'jpeg', 'png'],//['jpg', 'jpeg', 'png'],
                    
                    onExtError: function (filename, extension)
                    {
                        EC.UI.alert('Only image are supported at this time.');
                
                    },
                    onSizeError: function (filename, fileSize, max_size,extension)
                    {
                         var is_video = (['mov','avi','mp4'].indexOf(extension.toLowerCase()) !== -1)?true:false;
                         
                         if(!is_video) {
                            var maxim = max_size/1024, 
                                maxim_str = maxim + ' MB';
    
                            if ( maxim >= 1024 ) maxim_str = Math.floor(maxim/1000) + ' GB';
    
                            EC.UI.alert('The maximum file size is '+ maxim_str +', please select a smaller file.');
                        }
                         
                    },
                    onSubmit: function( filename, extension, uploadFile,upload_obj )
                    {    
                        /*if(self.has_pinterest_profile && (uploadFile.height > 100 ||   uploadFile.width > 200) ) {
                            
                        }*/
                        extension = extension.toLowerCase();
                        //validate video file size
                        var is_video = (['mov','avi','mp4'].indexOf(extension.toLowerCase()) !== -1)?true:false;
                        
                        //dimension check
                        helperManager.get_image_dimension(uploadFile,extension,function(dim_w,dim_h,new_file){
                            
                            if( !is_video ) {
                                if(chk_dim_w && chk_dim_h && dim_w && dim_h && (( dim_w > chk_dim_w  || dim_h > chk_dim_h ) ) ) {
                                   $msg ="Image is too large. image attachment should be less than "+chk_dim_w+" pixels by "+chk_dim_h+" pixels.";
                                   EC.UI.alert($msg);return false;
                                }
                            }
                            
                            $upload_element.find('.post-media').addClass('uploading');
                            
                            $upload_element.find('.up-progress').text('Uploading... (0%)');
                                          
                             //s3 upload
                             var params = {bucket_inner_dir:rand_hex_no()+'/',file_name:filename,file_size:uploadFile.size,file_type:uploadFile.type,file:new_file,progress_elem:$upload_element.find('.up-progress'),ext:extension};                                                  
                             helperManager.s3_upload(params,function(data,$err_msg){
                                  
                                  helperManager.check_image_size( data.location,is_video,function(chkd_size){
                                          
                                          $upload_element.find('.post-media').removeClass('uploading');  
                                          $upload_element.find('.up-progress').html('');
                                          
                                          $('.post-manager .more').remove();
                                          
                                          if( !data && $err_msg ) { 
                                            $err_msg = (!$err_msg)?'Uploading Failed.':$err_msg;
                                            EC.UI.alert($err_msg);
                                          }
                                          
                                          else {
                                              data.size = (chkd_size)?chkd_size:data.size;
                                              
                                              if( !is_video ) {
                                                data.dimension = {width:dim_w,height:dim_h,size:data.size};
                                                data.name = data.name+'_ecsize_'+dim_w+'_'+dim_h+'_'+data.size //rename with dimension and size
                                              }
                                              if( update_file )
                                                $upload_element.find('textarea').val('');
                                              
                                              helperManager.attach_file( $upload_element,data );
                                          }
                                          
                                          setTimeout(function(){
                                            upload_obj.removeCurrent();
                                          },100)
                                  
                                  });
                                  
                             },true);
                             return false;
                         });
                         
                         return false;
                    },
                    onProgress: function ( percent )
                    {
                        $upload_element.find('.post-media').text('Uploading... (' +( percent > 0 ? percent - 1 : 0 )+ '%)');
                    },
                    onComplete: function(file, response)
                    {
                        return false;
                    },
                    onChange: function( filename, extension ) { 
                        
                        if( $upload_element.find('.post-media').hasClass('uploading') ) {
                            EC.UI.alert('Uploading in Progress');return false;
                        } 
                        if( !update_file && maxUploads == (helperManager.get_uploaded_file_data($upload_element)).length ) {
                            EC.UI.alert('Upload files limited to '+maxUploads);return false;
                        }
                    }
                });
                
                helperManager.render_badge($upload_element);
    };
    
    module.get_uploaded_file_data = function( $upload_element){
        
        var $txt_area = $upload_element.find('textarea');
        
        var $val = $txt_area.val();
      
        if( $.trim($val) ){
            $val = JSON.parse($val);
        }else{
            $val = [];
        }
        
        return $val;
        
    }
    
     module.set_uploaded_file_data = function( $upload_element,data,reset_data){
        
        var $txt_area = $upload_element.find('textarea');
        
        if( reset_data ){
            $val = reset_data;
        }
        else{
            var $val = module.get_uploaded_file_data($upload_element);
        
            if( data )
                $val.push(data);
        }
            
        $txt_area.val(JSON.stringify($val));
    }
    
    module.attach_file = function ( $upload_element,data  ){
    
         console.log(data);
        
         module.set_uploaded_file_data($upload_element,data);
         
         module.render_badge( $upload_element );
    }
    
    module.popup_image = function( $img_element ){
        // Get the modal
        $img_element.on('click',function(){
           
           $('.image_popup').remove();
            var $element = $('<div/>',{class:'image_popup modal'});
            
            $element.append('<span class="close" data-dismiss="modal" >&times;</span><img class="modal-content" src ="'+$(this).attr("src")+'">');
            
            $element.find('.close','click',function(){
                $element.remove();
            });
            
            $('body').append($element);
            
            $('.image_popup').modal();
          
        });
       
    };
    
    module.render_badge = function( $upload_element ) {
        
        $upload_element.find('.post-media').html('');
        
        var $val = module.get_uploaded_file_data($upload_element);
        
        for(var i=0; i<$val.length; i++ ){
            
            var $badge = $('<div/>',{class:'dk-badge'});
            $badge.append('<img class="img-responsive " src="https://s3.amazonaws.com/'+$val[i].s3_url+'"><i class="fa fa-fw fa-remove" data-val="'+$val[i].location+'" title="delete"></i>');
            
            $badge.find('i').on('click',function(e){
                e.stopPropagation();
                var $val = module.get_uploaded_file_data($upload_element);
                var $new_val =[];
                
                for(var j=0; j<$val.length; j++ ){
                    
                    if( $val[j].location != $(this).attr('data-val')){
                        $new_val.push($val[j]);
                    }                    
                }
                
                $(this).parents('.dakUpload').find('textarea').val(JSON.stringify($new_val));
                $(this).parents('.dk-badge').remove();
                
            });
            helperManager.popup_image($badge.find('img'));
            $upload_element.find('.post-media').append($badge);
        }
    }
    module.route_url = function ( $url ){
        window.location = $url;
    };
    
})( helperManager || ( helperManager = {} ) );

function rand_hex_no(){
    
    return Math.floor(Math.random()*16777215).toString(16);
}

function unique_name_with_uuid($suffix,$prefix){
    var name ='';
    $suffix = (!$suffix)?"":$suffix;
    $prefix = (!$prefix)?"":$prefix;
    var d = new Date();
    var n = d.getTime(); 
    
    name = $prefix+uuid.v1()+'_'+ n +$suffix;
    return name;
}


var orderManager = {};
(function ( module )
{
    var cartData = {};

    module.setCartData = function(cdata){
        cartData = cdata;
    };

    module.initUserSelection = function(){
        var $input = $(".user-selection .typeahead");        
        $input.typeahead({          
            source:  function (query, process) {
                        return $.getJSON(base_url + 'users/get_users', { query: query }, function (data) {
                            console.log(data);

                            var users = [];
                            for(var user of data){
                                users.push(user);
                            }
                            return process(users);
                        });
                    }

            // source: [
            //     {id: "someId1", name: "Display name 1"},
            //     {id: "someId2", name: "Display name 2"}
            //   ]
        });

        $input.change(function() {
          var current = $input.typeahead("getActive");          
          module.displayUserInfo(current);
          $('input[name="user_id"]').val(current.id);
        });
    };

    module.displayUserInfo = function(data){
        console.log('data', data);
        if(!data) return;
        $('.user-info .user-name').html(data.original_name?data.original_name:'-');
        $('.user-info .email').html(data.email?data.email:'-');
        $('.user-info .phone').html(data.phone?data.phone:'');
    };

    module.openAddItemPopup = function(data){
        $('#add-item-form').modal();
        $('#add-item-form select[name="vehicle_id"], #add-item-form select[name="service_id"]')
            //.off('change')
            .on('change', function(){
                module.getShops();
            });
        $('#add-item-form select[name="shop_id"]')
            //.off('change')
            .on('change', function(){
                console.log('DDD', $(this).val());
                var sid = $(this).val();
                if(sid && sid !== ''){
                    var itemPrice = $(this).find('option[value="'+sid+'"]').attr('data-price');
                    console.log('itemPrice', itemPrice);
                    $('.item-price').html( module.formatData(itemPrice, 'money') );
                }
                else{
                    $('.item-price').html( '' );
                }
                
            });
    };

    module.getShops = function(){
        $elm = $('#add-item-form');
        var type = $elm.find('select[name="type"]').val(),
            service_id = $elm.find('select[name="service_id"]').val(),
            vehicle_id = $elm.find('select[name="vehicle_id"]').val();

        var request = {
                type: 'POST',
                url: base_url+'orders/getShops',
                data: {
                    type: type,
                    service_id: service_id,
                    vehicle_id: vehicle_id
                }
            }
            
        EC.server.request(request, function (resp)
        {
            var data = JSON.parse( resp );
            var $shop = $elm.find('select[name="shop_id"]');

            $shop.html( $('<option>', {value:'', text: 'Select'}) );
            for(var shop of data){
                $shop.append( $('<option>', {value:shop.id, text: shop.name, 'data-price':shop.price, 'data-item-id': shop.item_id}) );
            }

            $('#add-item-form select[name="shop_id"]').trigger('change');
            console.log(data);
          
        });
    };

    module.addItemToCart = function(){
        
        var $elm = $('#add-item-form');
        var shop_id = $elm.find('select[name="shop_id"]').val(),
            service_id = $elm.find('select[name="service_id"]').val(),
            vehicle_id = $elm.find('select[name="vehicle_id"]').val();

        console.log(shop_id);

        if(!service_id || service_id == ''){
            EC.UI.alert('Please slect service.', 3000);
            return;
        }

        if(!vehicle_id || vehicle_id == ''){
            EC.UI.alert('Please slect vehicle.', 3000);
            return;
        }

        if(!shop_id || shop_id == ''){
            EC.UI.alert('Please slect shop.', 3000);
            return;
        }

        var itemID = $elm.find('select[name="shop_id"] option[value="'+shop_id+'"]').attr('data-item-id'),
            qty = 1;

        var request = {
                type: 'POST',
                url: base_url+'orders/addItemToCart',
                data: {
                    item_id: itemID,
                    qty: qty
                }
            };
            
        EC.server.request(request, function (resp)
        {
            var data = JSON.parse( resp );
            
            if(data.status == 'SUCCESS'){
                module.setCartData(data.cart_data);
                module.renderCart();
                $('input[name="shop"]').val(shop_id);
                $('#add-item-form').modal('toggle');
            }
            else {
                EC.UI.alert(data.message, 3000);
            }
            
            console.log(data);
          
        });


    };

    module.removeItemFromCart = function(rowid){        

        if(!rowid || rowid == ''){
            alert('Invalid ID.');
            return;
        }

        var request = {
                type: 'POST',
                url: base_url+'orders/removeItemFromCart',
                data: {
                    rowid: rowid
                }
            };
            
        EC.server.request(request, function (resp)
        {
            var data = JSON.parse( resp );
            
            if(data.status == 'SUCCESS'){
                module.setCartData(data.cart_data);
                module.renderCart();
            }
            
            console.log(data);
          
        });


    };

    module.renderCart = function(){
        
        $elm = $('.cart-info');

        $elm.find('tbody').html('');
        console.log('rendering', cartData);

        var sub_total = 0;
        var discount = 0;
        var tax = 0;
        $.each( cartData, function( key, item ) {
            $row = $('<tr>');
            $row.append( $('<td>', {text: item.name}) );
            $row.append( $('<td>', {text: item.qty}) );
            $row.append( $('<td>', {html: module.formatData(item.price, 'money')}));

            var item_total = (item.qty*item.price);
            sub_total += item_total;

            $row.append( $('<td>', {html: module.formatData(item_total, 'money')}));

            $del = '<button type="button" class="btn btn-xs btn-danger">Delete</button>';
            $del = $($del);
            $del.attr('data-id', item.rowid);
            $del.on('click', function(){
                module.removeItemFromCart($(this).attr('data-id'));
            });
            $action = $('<td>');
            $row.append( $action.append($del) );

            $elm.find('tbody').append($row);
        });

        $('.sub-total').html( module.formatData(sub_total, 'money') );
        $('.discount').html( module.formatData(discount, 'money') );
        $('.tax').html( module.formatData(sub_total, 'money') );
    };

    module.createOrder = function(){
        
        $elm = $('.cart-info');

        var user_id = $('input[name="user_id"]').val();
        var shop_id = $('input[name="shop"]').val();
        var vehicle_model = $('input[name="vehicle_model"]').val();
        var vehicle_number = $('input[name="vehicle_number"]').val();

        if(user_id == ''){
            EC.UI.alert('Please select user.', 3000);
            return;
        }

        if(shop_id == ''){
            EC.UI.alert('Please add service.', 3000);
            return;
        }

        if(vehicle_model == ''){
            EC.UI.alert('Please enter vehicle model.', 3000);
            return;
        }

        if(vehicle_number == ''){
            EC.UI.alert('Please enter vehicle number.', 3000);
            return;
        }

        var request = {
                type: 'POST',
                url: base_url+'orders/create',
                data: {
                    user_id: user_id,
                    shop_id: shop_id,
                    vehicle_model: vehicle_model,
                    vehicle_number: vehicle_number,
                    message: ''
                }
            };
            
        EC.server.request(request, function (resp)
        {
            var data = JSON.parse( resp );
            
            if(data.status == 'SUCCESS'){
                module.setCartData(data.cart_data);
                module.renderCart();
                EC.UI.flash('Order created successfully!.', 3000);
                setTimeout(function(){
                    location.href = base_url + 'orders';
                }, 2000);
            }
            
            console.log(data);
          
        });
    };

    module.formatData = function(str, type){
        type = type || '';

        switch(type){

            case 'money':
                str = '<i class="fa fa-rupee"></i>' + str;
            break;

            default:
            str = str;
        }

        return str;

    }

})(orderManager || ( orderManager = {} ));


(function($)
{    
    $.sanitize = function( input )
    {
        if( !input ) return '';
        
        input = input.toString();
        var output = input.replace(/<script[^>]*?>.*?<\/script>/gi, '').
                     replace(/<[\/\!]*?[^<>]*?>/gi, '').
                     replace(/<style[^>]*?>.*?<\/style>/gi, '').
                     replace(/<![\s\S]*?--[ \t\n\r]*>/gi, '');
        return output;
    };
    
    $('.dakUpload').each(function(){
        var $btn = $(this).find('.btn');
        var $element = $(this);
        var max_upload = ($(this).attr('data-max-upload'))?$(this).attr('data-max-upload'):1;
        var max_size =  ($(this).attr('data-max-size'))?$(this).attr('data-max-size'):5120;
        var max_width =  ($(this).attr('data-max-width'))?$(this).attr('data-max-width'):2000;
        var max_height =  ($(this).attr('data-max-height'))?$(this).attr('data-max-height'):2000;
        var update_file = ($(this).attr('data-update-exist-file') == 'true')?true:false;
        helperManager.create_upload($btn,$element,max_upload,max_size,max_width,max_height,update_file,false);
    });
    
     $('.js-example-basic-single').select2();

    $('.datetpicker').datepicker({format:'dd/mm/yyyy'});    
    orderManager.initUserSelection();
   
})(jQuery); 


