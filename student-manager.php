<?php
/**
 * Plugin Name: Student Manager
 * Description: Quản lý sinh viên với Custom Post Type, Meta Box và hiển thị Shortcode.
 * Version: 1.0
 * Author: Nhat Minh
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; 
}

require_once plugin_dir_path( __FILE__ ) . 'includes/student-cpt.php';
require_once plugin_dir_path( __FILE__ ) . 'includes/student-metabox.php';
require_once plugin_dir_path( __FILE__ ) . 'includes/student-shortcode.php';
function sm_enqueue_frontend_styles() {
    wp_enqueue_style( 'sm-student-style', plugin_dir_url( __FILE__ ) . 'assets/style.css' );
}
add_action( 'wp_enqueue_scripts', 'sm_enqueue_frontend_styles' );