<?php 
/*
Plugin Name: Plugin With React Js
Author: Raihan Islam
Author URI: https://raihan.website
Version: 1.0.0
Description: Plugin with React js

*/

if( ! defined( 'ABSPATH' ) ) : exit(); endif; // No direct access allowed.

/**
* Define Plugins Contants
*/
define ( 'WPWR_PATH', trailingslashit( plugin_dir_path( __FILE__ ) ) );
define ( 'WPWR_URL', trailingslashit( plugins_url( '/', __FILE__ ) ) );

add_action('admin_enqueue_scripts','load_scripts');
function load_scripts(){
    wp_enqueue_script( 'wp-react-plugin', WPWR_URL . 'dist/bundle.js', [ 'jquery', 'wp-element' ], wp_rand(), true );
    wp_localize_script( 'wp-react-plugin', 'appLocalizer', [
        'apiUrl' => home_url('/wp-json'),
        'nonce' => wp_create_nonce('wp_rest')
    ] );
}

function new_dashboard_setup(){
    wp_add_dashboard_widget( 
        'new_dashboard_widget',
        'New Graph Widget',
        'new_dashboard_widget_callback'
    );
}
add_action('wp_dashboard_setup', 'new_dashboard_setup');

function new_dashboard_widget_callback(){
    echo '<div id="new-dashboard-widget"></div>';
}



?>