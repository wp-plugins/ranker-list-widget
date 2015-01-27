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
			jQuery( '#rnkrwp_header-bgcolor' ).miniColors( {
				letterCase	: 'lowercase',
				change		: function( hex, rgb ){
				}
			} );
			jQuery( '#rnkrwp_header-fontcolor' ).miniColors( {
				letterCase	: 'lowercase',
				change		: function( hex, rgb ){
				}
			} );
			jQuery( '#rnkrwp_list-fontcolor' ).miniColors( {
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
				success		: function( response ){
					//Catch JSON error
					if( !response.error ){
						//Build shortcode
						RNKRWP.shortcode.buildCode( url, response );
					}
					else{
						console.log( response.errorCode+': '+response.errorMessage );
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
		 * Build Shortcode
		 * @desc Build Ranker list shortcode from data and output to user.
		 * @param {string} url URI encoded URL string.
		 * @param {object} response JSON response object from data call.
		 */
		buildCode : function( url, response ){
			
			//Build code
			var name		= decodeURIComponent( response.name ),
				shortcode	= '[rnkrwp ' +
					'id="' + response.id + '" ' +
					'format="' + ( ( typeof response.listFormatType === 'undefined' || response.listFormatType === '' || response.listFormatType === 'BLOG' ) ? 'grid' : response.listFormatType.toLowerCase() ) + '" ' +
					'url="' + decodeURIComponent( url ) + '" ' +
					'name="' + name.replace( /"/g, '' ).replace( /&quot;/g, '' ) + '"' +
				']';
			
			//Output Code
			jQuery( '#rnkrwp_shortCodeOutput' ).html( shortcode );
			
		}	
};

/**
 * On Ready
 * @desc Commands to run on page ready.
 */
jQuery( document ).ready(function(){

	if( RNKRWP.page === 'rnkrwp-options' ){
		
		RNKRWP.options.init();
		
		//Bind Events
		/* All rows clicks */
		jQuery( '#rnkrwp_size-rowsall' ).click( function( e ){
			//Check state
			if( jQuery( this ).prop( 'checked' ) ){
				jQuery( "#rnkrwp_size-rows" ).val( '' ).prop( 'disabled', true );
			}
			else{
				jQuery( "#rnkrwp_size-rows" ).val( '20' ).prop( 'disabled', false );
			}
		} );
		
		/* Footer color clicks */
		jQuery( '.colorSelect' ).click( function( e ){
			var	item	= jQuery( this ),
				color	= this.id.split( /_/ )[ 2 ];
			
			if( item.hasClass( 'slideBgColor' ) ){
				//Update hidden value
				jQuery( '#rnkrwp_list-slidebgcolor' ).val( color );
				//Update display chicklet
				jQuery( '.colorSelect.slideBgColor' ).removeClass( 'selected' );
				jQuery( '#rnkrwp_list-slidebgcolor_' + color ).addClass( 'selected' );
			}
			else{
				//Update hidden value
				jQuery( '#rnkrwp_footer-bgcolor' ).val( color );
				//Update display chicklet
				jQuery( '.colorSelect.footBgColor' ).removeClass( 'selected' );
				jQuery( '#rnkrwp_footColor_' + color ).addClass( 'selected' );
			}
		} );
		
	}
	
	if( RNKRWP.page === 'rnkrwp-shortcodes' ) RNKRWP.shortcode.init();

});