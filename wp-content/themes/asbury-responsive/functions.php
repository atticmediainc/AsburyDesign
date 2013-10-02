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

//----------------------------------------------
//    Load custom .css file on particular page  
//-----------------------------------------------
if (!function_exists('navScript')) {
	function loadCSS() {	
		if (!is_admin()) {

			if (is_page('portfolio') || is_category()) {
				wp_register_style( 'fancybox', get_stylesheet_directory_uri() . '/css/jquery.fancybox.css' );
				wp_enqueue_style( 'fancybox' );
			}
		}
	}
}
add_action( 'wp_print_styles', 'loadCSS' );

//----------------------------------------------
//    Load custom .js file on particular page  
//-----------------------------------------------
if (!function_exists('navScript')) {
	function loadScripts() {	
		if (!is_admin()) {
			
			if (is_front_page()) {
				wp_register_script( 'bxslider', get_stylesheet_directory_uri() . '/js/jquery.bxslider/jquery.bxslider.min.js', array( 'jquery' ) );
				wp_enqueue_script( 'bxslider' );
				wp_register_script( 'slider', get_stylesheet_directory_uri() . '/js/slider.js', array( 'jquery' ) );
				wp_enqueue_script( 'slider' );
			}
			
			if (is_page('portfolio') || is_category()) {
				wp_register_script( 'fancybox', get_stylesheet_directory_uri() . '/js/jquery.fancybox.pack.js', array( 'jquery' ) );
				wp_enqueue_script( 'fancybox' );
				wp_register_script( 'portfolio', get_stylesheet_directory_uri() . '/js/portfolio.js', array( 'jquery' ) );
				wp_enqueue_script( 'portfolio' );
				
			}
		}
	}
}
add_action( 'wp_enqueue_scripts', 'loadScripts' );


//----------------------------------------------
//    Set background-image of element  
//-----------------------------------------------
// Example usage:
// $feat_image = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
// <div class="slider-img" <?php set_slide_bg($feat_image); [php closing tag]>

function set_slide_bg($feat_image, $echo=true) {
	$string = 'style="background:url(' . $feat_image . ');background-repeat:no-repeat;background-position: 50% 0%;"';
	
	if ($echo) {
	  echo $string;
	} else {
	  return $string;
	}
}