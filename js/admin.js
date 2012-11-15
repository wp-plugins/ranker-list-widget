/**
 * Admin Scripts
 * @fileoverview Scripts for Ranker plugin options and shortcode admin pages.
 * @package WordPress
 */

/**
 * Plugin Options
 * @desc Functions and event handlers for plugin options.
 */
RNKRWP.options = {
		
		/**
		 * Init Options
		 * @desc Initialize options plugins.
		 */
		init : function(){
		
			//Setup color pickers			
			jQuery( '#rnkrwp_bg' ).miniColors( {
				letterCase	: 'lowercase',
				change		: function( hex, rgb ){

				}
			} );
			jQuery( '#rnkrwp_title-color' ).miniColors( {
				letterCase	: 'lowercase',
				change		: function( hex, rgb ){

				}
			} );
		
		}

};

/**
 * Shortcode Generator
 * @desc Functions and event handlers for shortcode creation.
 */
RNKRWP.shortcode = {
	
		/**
		 * Init Shortcodes
		 * @desc Initialize shortcode generator.
		 */
		init : function(){
			
			//Bind DOM events
			/**
			 * List Input
			 * @desc Handle paste events on the Ranekr list input.
			 */
			jQuery( '#rnkrwp_rankerURL' ).bind('paste',function( e ){
				setTimeout( function(){
					var input = jQuery( '#rnkrwp_rankerURL' ).val();
					//Check for URL
					input = jQuery.trim( input );
					if( input !== null && input !== '' ) RNKRWP.shortcode.getListData( input );
				},10 );
			});
			
			/**
			 * Get Code
			 * @desc Handle clicks to the get code submit button.
			 */
			jQuery( '#rnkrwp_getShortCode' ).click(function( e ){
				setTimeout( function(){
					var input = jQuery( '#rnkrwp_rankerURL' ).val();
					//Check for URL
					input = jQuery.trim( input );
					if( input!== null && input !== '' ) RNKRWP.shortcode.getListData( input );
				},10 );
			});
			
		},
		
		/**
		 * Get Data
		 * @desc Get Ranker list data from provided list URL.
		 * @param {string} url URI encoded URL for list to check.
		 */
		getListData : function( url ){
			
			//Get list data from URL
			jQuery.ajax({
				//Call type
				type		: 'GET',
				//Data type expected
				dataType	: 'json',
				//Domain type
				crossDomain	: true,
				//URL of JSON
				url			: 'http://api.ranker.com/wordpress/lists',
				//Query to send
				data		: 'url='+encodeURIComponent( url ),
				//Define callback
				success		: function( data ){
					//Catch JSON error
					if( !data.error ){
						//Build shortcode
						RNKRWP.shortcode.buildCode( url, data );
					}
					else{
						console.log( data.errorCode+': '+data.errorMessage );
					}
				},
				//Timeout
				timeout		: 60000,
				//On error
				error		: function( xhr, txtStatus, err ){
					if( txtStatus === 'timeout' || xhr.statusText === 'Timeout' ){
						//Notify user of timeout
						alert( "Timeout: We're sorry but processing your request has timed out, please try again." );
					}
					else if( xhr.status === 404 || xhr.statusText === 'Not Found' ){
						//Notify user of 404
						alert( "404: We're sorry but we can't find that list on Ranker, please try again." );
					}
					else{
						//Notify user of error
						alert( "Error: We're sorry but there has been an error, please refresh the page and try again." );
					}
				}
			});
			
		},
		
		/**
		 * Calculate Height
		 * @desc Calculate variable widget height using supplied name and stored defaults.  
		 * @param {string} name URI encoded list name.
		 * @param {string} 
		 * @return {number} totalHeight Total height of the widget for shortcode.
		 */
		calcHeight : function( name, totalItems ){
			
			//Add name to calc div
			jQuery( '#rnrkwp_calc .font' ).text(decodeURIComponent(name));
			
			//Usuable vars
			var size		= 0,
				lineHeight	= 0,
				stringWidth	= 0,
				titleRows	= 0,
				titleHeight	= 0,
				userHeight	= 0,
				listHeight	= 0,
				addHeight	= 11,
				footHeight	= 36,
				totalHeight	= 0,
				//Remap and parse vars
				width		= parseInt( RNKRWP.width, 10 ),
				rows		= RNKRWP.rows;
			
			//Check rows length
			if( rows === 'All' ){
				rows = parseInt( totalItems, 10 );
			}
			else{
				rows = parseInt( RNKRWP.rows, 10 );
			}
			
			//Check width and adjust font-size
			if( width <= 220 ){
				size = 14;
				lineHeight = 18;
			}
			else if( width > 220 && width <= 270 ){
				size = 16;
				lineHeight = 20;
			}
			else if( width > 270 && width <= 370 ){
				size = 22;
				lineHeight = 26;
			}
			else if( width > 370 && width <= 500 ){
				size = 30;
				lineHeight = 34;
			}
			else{
				size = 36;
				lineHeight = 40;
			}
			
			//Remove current calc data and update
			jQuery( '#rnrkwp_calc .font' ).removeClass( 'arial helevtica verdana geneva georgia times' ).attr( 'style','' ).addClass( RNKRWP.title_font ).css({
				fontSize : size+'px'
			});
			
			/* Calculate title */
			//Find total string width
			stringWidth = jQuery( '#rnrkwp_calc .font' ).width();
			//Calculate rows
			titleRows = Math.ceil( stringWidth / (width - 24) ); //24 = 12 * 2 px padding
			//Calculate title height
			titleHeight = Math.round( lineHeight * titleRows ) + 16; //16 = 8 * 2 px padding
			
			/* Calculate full widget height */
			if( parseInt( RNKRWP.show_user, 10 ) ) userHeight = 20;
			
			//Check width and adjust row height
			if( width < 371 ){
				listHeight = (48 * rows) + addHeight;
			}
			else if( width > 370 && width < 501 ){
				listHeight = (58 * rows) + addHeight;
			}
			else{
				listHeight = (67 * rows) + addHeight;
			}
			
			//Calc full height
			totalHeight = parseInt( titleHeight + userHeight + listHeight + footHeight, 10 );			
			return totalHeight;
			
		},
		
		/**
		 * Build Shortcode
		 * @desc Build Ranker list shortcode from data and output to user.
		 * @param {string} url URI encoded URL string.
		 * @param {object} data JSON response object from data call.
		 */
		buildCode : function( url, data ){
			
			//Calculate height
			var height		= RNKRWP.shortcode.calcHeight( encodeURIComponent( data.name ), data.totalItemCount );
			
			//Build code
			var shortcode = '[rnkrwp ' +
				'id="'+data.id+'" ' +
				'height="'+height+'" ';
			
			//Check for show_link
			if( parseInt( RNKRWP.show_link, 10 ) ){
				shortcode += '<span>' +
				'url="'+decodeURIComponent( url )+'" ' +
				'<br/>' +
				'name="'+decodeURIComponent( data.name )+'"' +
				']</span>';
			}
			else{
				shortcode += ']';
			}
			
			//Output Code
			jQuery( '#rnkrwp_shortCodeOutput' ).html( shortcode );
			
		}	
};

/**
 * On Ready
 * @desc Commands to run on page ready.
 */
jQuery( document ).ready(function(){

	if( RNKRWP.page === 'rnkrwp-options' ) RNKRWP.options.init();
	if( RNKRWP.page === 'rnkrwp-shortcodes' ) RNKRWP.shortcode.init();

});