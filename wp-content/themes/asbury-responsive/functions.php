<?php
/**
 * Custom functions and definitions.
 */
 
 /* Set permalinks to pretty structure */
 if (get_option('permalink_structure') == '') {
     global $wp_rewrite;
     $wp_rewrite->set_permalink_structure('/%postname%/');
 }

