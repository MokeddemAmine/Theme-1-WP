<?php 

// load css files
function add_styles(){
    // add bootstrap and fontAwsome from google
    wp_register_style('bootstrap-css',get_template_directory_uri().'/css/bootstrap.min.css',array(),false,'all');
    wp_register_style('fontAwsome',get_template_directory_uri().'/css/all.min.css');
    wp_enqueue_style('bootstrap-css');
    wp_enqueue_style('fontAwsome');
}
add_action('wp_enqueue_scripts','add_styles');

// load script files
// add jquery , popper and bootstrap
function add_scripts(){
    wp_deregister_script('jquery');
    wp_register_script('jquery',includes_url('/js/jquery/jquery.js'),array(),false,true);
    wp_register_script('popper-js',get_template_directory_uri().'/js/popper.min.js',array(),false,true);
    wp_register_script('bootstrap-js',get_template_directory_uri().'/js/bootstrap.min.js',array('jquery'),false,true);
    wp_enqueue_script('jquery');
    wp_enqueue_script('popper-js');
    wp_enqueue_script('bootstrap-js');
    
}
add_action('wp_enqueue_scripts','add_scripts');