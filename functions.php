<?php 

// load css files
function add_styles(){
    // add bootstrap and fontAwsome from google
    wp_register_style('bootstrap-css',get_template_directory_uri().'/css/bootstrap.min.css',array(),false,'all');
    wp_register_style('fontAwsome',get_template_directory_uri().'/css/all.min.css');
    wp_register_style('main-css',get_template_directory_uri().'/css/main.css');
    wp_enqueue_style('bootstrap-css');
    wp_enqueue_style('fontAwsome');
    wp_enqueue_style('main-css');
}
add_action('wp_enqueue_scripts','add_styles');

// load script files
// add jquery , popper and bootstrap
function add_scripts(){
    wp_deregister_script('jquery');
    wp_register_script('jquery',includes_url('/js/jquery/jquery.js'),array(),false,true);
    wp_register_script('popper-js',get_template_directory_uri().'/js/popper.min.js',array(),false,true);
    wp_register_script('bootstrap-js',get_template_directory_uri().'/js/bootstrap.min.js',array('jquery'),false,true);
    wp_register_script('main-js',get_template_directory_uri().'/js/main.js',array(),false,true);
    wp_enqueue_script('jquery');
    wp_enqueue_script('popper-js');
    wp_enqueue_script('bootstrap-js');
    wp_enqueue_script('main-js');
    
}
add_action('wp_enqueue_scripts','add_scripts');

// Theme Options
add_theme_support('menus');

// Menus 
register_nav_menus(
    array(
        'top-menu'          => 'Top Menu Location',
        'mobile-menu'       => 'Mobile Menu Location',
        'footer-menu'       => 'Footer Menu Location'
    )
);

function mine_header_menu(){
    wp_nav_menu(array(
        'theme_location'        => 'top-menu',
        'menu_class'            => 'top-bar d-flex  list-unstyled m-0 p-0',
        'container'             => false
    ));
}

function mine_footer_menu(){
    wp_nav_menu(array(
        'theme_location'        => 'footer-menu',
        'menu_class'            => 'footer-bar',
    ));
}