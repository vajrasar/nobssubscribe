jQuery( '#mail-submit-btn' ).on( 'click', function() {

	var thisis = jQuery( this );
	//var name = jQuery( '#subs-name' ).val();
	var email = jQuery( '#subs-email' ).val();
	
	jQuery.ajax({
		
		url: nobsmail.ajax_url,
		type: 'post',
		data: {
			action: 'vg_no_bs_mail_func',
			//thename: name,
			theemail: email,
		},
		success: function( response ) {

				jQuery('#status').html( '' );
				
				jQuery('#status').html( response );
			
		},
		error: function() {
            console.log("Error");            
        }
	
	});
 
});

