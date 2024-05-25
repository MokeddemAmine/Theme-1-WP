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
// port thumbnails
add_theme_support('post-thumbnails');
// add widgets
add_theme_support('widgets');
// custom image sizes
add_image_size('blog-large',800,400,true);
add_image_size('blog-small',300,200,true); 

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

// Register the Sidebar
function mine_sidebars(){
    register_sidebar(array(
        'name'          => 'main sidebar',
        'id'            => 'main-sidebar',
        'before_sidebar'=> '<ul class="widgets-sidebar list-unstyled">',
        'after_sidebar' => '</ul>',
        // 'before_title'  => '<h4 class="widgets-title">',
        // 'after_title'   => '</h4>'
    ));

    register_sidebar(array(
        'name'          => 'blog sidebar',
        'id'            => 'blog-sidebar',
        'before_sidebar'=> '<div class="widgets-sidebar m-0 p-0 list-unstyled">',
        'after_sidebar' => '</div>',
        'before_title'  => '<h4 class="widgets-title">',
        'after_title'   => '</h4>'
    ));
}
add_action('widgets_init','mine_sidebars');