<?php

/*

* Plugin Name:       No BS Email Capture

* Plugin URI:        http://imakewp.com/

* Description:       No Bullshit way to capture Email Address as leads from visitors.

* Version:           0.1

* Author:            Vajrasar Goswami | imakewp.com

*/

function nobsmail_enqueue_scripts() {

	wp_enqueue_script( 'mailcapturejs', plugins_url() . '/mail-capture/mailcapture.js', array('jquery'), '1.0', true );

	wp_localize_script( 'mailcapturejs', 'nobsmail', array( 'ajax_url' => admin_url( 'admin-ajax.php' ) ));

}

add_action( 'wp_enqueue_scripts', 'nobsmail_enqueue_scripts' );


function lets_catch_emails() {
	?>
	<div id="catch-email">
		<!-- If you want to display Name field as well --
		<p>
			<label for="name"/>Name:</label>
			<input type="text" name="name" id="subs-name"/>
		</p>
		-->
		
		<p>
			<label for="email"/>Email:</label>
			<input type="text" name="email" id="subs-email"/>
		</p>
		
		<p>
			<input type="submit" value="Sign up" id="mail-submit-btn"/>
		</p>
		
		<p id="status"></p>
	</div>
	<?php
}



function vg_no_bs_mail_func() {
	
	//$usrname = $_REQUEST['thename'];
	$usremail = $_REQUEST['theemail'];

	$weshoulddie = 0;

	/*
	if( $usrname == null || empty( $usrname ) ) {

		echo "Username Empty." . "<br />";
		$weshoulddie = 1;

	}
	*/ 

	if ( $usremail == null || empty( $usremail ) ) {

		echo "Email Empty." . "<br />";
		$weshoulddie = 1;

	}

	if( $weshoulddie == 1 ) {
		
		die();
		exit();
	
	}

	if ( defined( 'DOING_AJAX' ) && DOING_AJAX && ( $weshoulddie == 0 ) ) {

		if( null == username_exists( $usremail ) ) {

		    $password = wp_generate_password( 12, true );
		    $user_id = wp_create_user ( $usremail, $password, $usremail );
		    $user = new WP_User( $user_id );
		    $user->set_role( 'subscriber' );

		    wp_mail( $usremail, 'Welcome to BCM!', 'You will recieve updates from now on!' );

		    echo "User created Succesfully";


		} else {

			echo "User with this email already exists. Please register with a different Email. Thanks!";

		}
	
		die();
	
	} else {
		
		echo "No Ajax!";
	
	}
	
}

add_action( 'wp_ajax_nopriv_vg_no_bs_mail_func', 'vg_no_bs_mail_func' ); // for ajax

add_action( 'wp_ajax_vg_no_bs_mail_func', 'vg_no_bs_mail_func' ); // for ajax




