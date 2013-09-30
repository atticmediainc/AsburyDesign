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
		}
	}
}
add_action( 'wp_enqueue_scripts', 'loadScripts' );


function bg_style($image_or_acf, $echo=true) {

  $url = "";
  
  if (gettype($image_or_acf) == 'string') {
    // the function has been passed an ACF field name
    $imageObj = get_field($image_or_acf);
    $url = $imageObj['url'];
    
  } elseif ( isset($image_or_acf['url']) ){
    // the function has been passed an image object
    $url = $image_or_acf['url'];
  } else {
    //the function has been passed an attachment source obj
    $url = $image_or_acf[0];
  }

/*   console_log(gettype($acf_field), 'acf field type' ); */
/*   console_log(gettype($imageObj), 'image obj type' ); */
  $string = 'style="background-image: url(\'' . $url. '\');background-repeat:no-repeat;background-position: center center; background-size:cover;"';
  
  if ($echo) {
    echo $string;
  } else {
    return $string;
  }
  
} // end bg_style()

function set_slide_bg($feat_image, $echo=true) {
	$string = 'style="background:url(' . $feat_image . ');background-repeat:no-repeat;background-position: 50% 0%;"';
	
	if ($echo) {
	  echo $string;
	} else {
	  return $string;
	}
}