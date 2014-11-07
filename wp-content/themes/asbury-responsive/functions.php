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

			if (is_page('portfolio') || is_category() || is_front_page()) {
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
			
			wp_register_script( 'retina', get_stylesheet_directory_uri() . '/js/retina-1.1.0.js', array( 'jquery' ) );
			wp_enqueue_script( 'retina' );
			
			if (is_front_page()) {
				wp_register_script( 'bxslider', get_stylesheet_directory_uri() . '/js/jquery.bxslider/jquery.bxslider.min.js', array( 'jquery' ) );
				wp_enqueue_script( 'bxslider' );
				wp_register_script( 'slider', get_stylesheet_directory_uri() . '/js/slider.js', array( 'jquery' ) );
				wp_enqueue_script( 'slider' );
				wp_register_script( 'fancybox', get_stylesheet_directory_uri() . '/js/jquery.fancybox.pack.js', array( 'jquery' ) );
				wp_enqueue_script( 'fancybox' );
				wp_register_script( 'fancybox-helpers', get_stylesheet_directory_uri() . '/js/jquery.fancybox-media.js', array( 'jquery' ) );
				wp_enqueue_script( 'fancybox-helpers' );
			}
			
			if (is_page('portfolio') || is_category()) {
				wp_register_script( 'fancybox', get_stylesheet_directory_uri() . '/js/jquery.fancybox.pack.js', array( 'jquery' ) );
				wp_enqueue_script( 'fancybox' );
				wp_register_script( 'fancybox-helpers', get_stylesheet_directory_uri() . '/js/jquery.fancybox-media.js', array( 'jquery' ) );
				wp_enqueue_script( 'fancybox-helpers' );
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

//-----------------------------------------------------------------------------------------
// 			Registering a custom widget 
//------------------------------------------------------------------------------------------

function custom_widgets_init() {
	register_sidebar(array(
	'name' => 'Footer Widget',
	'id'        => 'footer-widget',
	'description' => 'The main widget to house all footer content',
	'before_widget' => '<div class="footer-widget">',
	'after_widget' => '</div>',
	));
}
add_action( 'widgets_init', 'custom_widgets_init' );


function widget_first_last_classes($params) {

	global $my_widget_num; // Global a counter array
	$this_id = $params[0]['id']; // Get the id for the current sidebar we're processing
	$arr_registered_widgets = wp_get_sidebars_widgets(); // Get an array of ALL registered widgets	

	if(!$my_widget_num) {// If the counter array doesn't exist, create it
		$my_widget_num = array();
	}

	if(!isset($arr_registered_widgets[$this_id]) || !is_array($arr_registered_widgets[$this_id])) { // Check if the current sidebar has no widgets
		return $params; // No widgets in this sidebar... bail early.
	}

	if(isset($my_widget_num[$this_id])) { // See if the counter array has an entry for this sidebar
		$my_widget_num[$this_id] ++;
	} else { // If not, create it starting with 1
		$my_widget_num[$this_id] = 1;
	}

	$class = 'class="widget-' . $my_widget_num[$this_id] . ' '; // Add a widget number class for additional styling options

	if($my_widget_num[$this_id] == 1) { // If this is the first widget
		$class .= 'widget-first ';
	} elseif($my_widget_num[$this_id] == count($arr_registered_widgets[$this_id])) { // If this is the last widget
		$class .= 'widget-last ';
	}

	$params[0]['before_widget'] = preg_replace('/class=\"/', "$class", $params[0]['before_widget'], 1); // Insert our new classes into "before widget"

	return $params;

}
add_filter('dynamic_sidebar_params','widget_first_last_classes');