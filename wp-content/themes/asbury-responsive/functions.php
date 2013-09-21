<?php
/**
 * Custom functions and definitions.
 */
 
 /* Set permalinks to pretty structure */
 if (get_option('permalink_structure') == '') {
     global $wp_rewrite;
     $wp_rewrite->set_permalink_structure('/%postname%/');
 }
 
 
 /* Change logo for client login */
 add_action("login_head", "client_login_head");
 function client_login_head() {
 	echo "
 	<style>
 	body.login #login h1 a {
 		background: url('".get_stylesheet_directory_uri()."/images/logo-login.png') no-repeat scroll center top transparent;
 		height: 200px;
 		width: 100%;
 	}
 	</style>
 	";
 }

