<?php 

    //  Include PHPMailer library
    // use PHPMailer\PHPMailer\PHPMailer;
    // use PHPMailer\PHPMailer\Exception;

    // require_once('vendor/autoload.php');

use PHPMailer\PHPMailer\PHPMailer;

    require_once('wp-bootstrap-navwalker.php');
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
    // wp_localize_script('custom-ajax', 'ajax_object', array('ajax_url' => admin_url('admin-ajax.php')));
    
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
        'footer-menu'       => 'Footer Menu Location',
        'bootstrap-menu'    => 'Bootstrap Menu',
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
function mine_bootstrap_menu(){
    wp_nav_menu(array(
        'theme_location'    => 'bootstrap-menu',
        'container'         => false,
        'menu_class'        => 'navbar-nav me-auto mb-2 mb-lg-0',
        'depth'                 => 2,
        'walker'                => new WP_Bootstrap_Navwalker()
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

// custom post types
function my_first_post_type(){
    $labels = array(
        'name'               => _x( 'Cars', 'post type general name' ),
        'singular_name'      => _x( 'Car', 'post type singular name' ),
        'add_new'            => _x( 'Add New Car', 'car' ),
        'add_new_item'       => __( 'Add New Car  Type' ),
        'edit_item'          => __( 'Edit Car Type' ),
        'new_item'           => __( 'New Car Type' ),
        'all_items'          => __( 'All Cars Types' ),
        'view_item'          => __( 'View Car Type' ),
        'search_items'       => __( 'Search Car Type' ),
        'not_found'          => __( 'No Car type found' ),
        'not_found_in_trash' => __( 'No Car type found in the Trash' ),
        'parent_item_colon'  => '',
        'menu_name'          => 'Cars'
    );
    $args = array(
        'labels'    => $labels,
        'hierarchical'  => true,
        'public'        => true,
        'has_archive'   => true,
        'menu_icon'     => 'dashicons-car',
        'supports'      => array('title','editor','thumbnail','custom-fields'),
        // rewrite => array('slug' => 'my-cars)
    );

    register_post_type('cars',$args);
}

add_action('init','my_first_post_type');

// add taxonomy to cars

function my_first_taxonomy(){
    
    $labels2 = array(
        'name'          => 'Brands',
        'singular_name' => 'Brand',
    );

    $args = array(
        'labels'        => $labels2,
        'public'        => true,
        'hierarchical'  => true,
    );

    register_taxonomy('brands',array('cars'),$args);

}
add_action('init','my_first_taxonomy');

// custom ajax form

function enquiry_form(){

    if(!wp_verify_nonce($_POST['nonce'],'ajax-nonce')){
        wp_send_json_error('Nonce is incorrect',401);
        die();
    }
    $formdata = [];
    wp_parse_str($_POST['enquiry'],$formdata);

    // Admin email
    $admin_email = get_option('admin_email');
    
    // Email headers
    $headers[] = 'Content-Type: text/html; charset=UTF-8';
    $headers[] = 'From:' . $admin_email;
    $headers[] = 'Reply-to:'. $formdata['email'];

    // Who are we sending the email to ?
    $send_to = $admin_email;

    // subject
    $subject = "Enquiry Form : ".$formdata['fname'].' '.$formdata['lname'];

    // Message
    $message = '';

    foreach($formdata as $index => $field){
        $message .= '<strong style="text-transform:capitalize;">'.$index.': </strong>'.$field.'<br/>';
    }


// Send email using wp_mail() function
    
    try{
        if(wp_mail( $send_to, $subject, $message, $headers )){
            wp_send_json_success('Email sent');
        }else{
            wp_send_json_error('Email error');
        }
    }catch(Exception $e){
        wp_send_json_error($e->getMessage());
    }

// Create a new PHPMailer instance
// $mail = new PHPMailer();

// try {
//     // Server settings
//     $mail->isSMTP(); // Set mailer to use SMTP
//     $mail->Host = 'smtp.gmail.com'; // Specify main and backup SMTP servers
//     $mail->SMTPAuth = true; // Enable SMTP authentication
//     $mail->Username = 'mokeddemamine1707@gmail.com'; // SMTP username
//     $mail->Password = 'sryq qtqx qtar zuhw'; // SMTP password
//     $mail->SMTPSecure = 'tls'; // Enable TLS encryption, `ssl` also accepted
//     $mail->Port = 587; // TCP port to connect to

//     // Recipients
//     $mail->setFrom($formdata['email'], $formdata['fname'].' '.$formdata['lname']);
//     $mail->addAddress($send_to, 'mokeddem amine'); // Add a recipient
//     // $mail->addReplyTo('replyto@example.com', 'Reply To');

//     // Content
//     $mail->isHTML(true); // Set email format to HTML
//     $mail->Subject = $subject;
//     $mail->Body    = $message;
//     // $mail->AltBody = 'This is the plain text version of the email.';

//     // Send the email
//     if($mail->send()) {
//         wp_send_json_success('Email sent');
//     } else {
//         wp_send_json_error('Email error');
//     }
// } catch (Exception $e) {
//     wp_send_json_error($e->getMessage());
// }

    // wp_send_json_success($formdata['fname']);
}

add_action('wp_ajax_enquiry','enquiry_form');
add_action('wp_ajax_nopriv_enquiry','enquiry_form');

// php mailer

function custom_mailer(PHPMailer $phpmailer){
    $phpmailer->SetFrom('mokeddem2024@gmail.com','mohammed mokeddem');
    $phpmailer->Host        = 'smtp.gmail.com';
    $phpmailer->Port        = 587;
    $phpmailer->SMTPAuth    = true;
    $phpmailer->SMTPSecure  = 'tls';
    $phpmailer->Username = 'mokeddemamine1707@gmail.com';
    $phpmailer->Password = 'sryq qtqx qtar zuhw';
    $phpmailer->isSMTP();
}

add_action('phpmailer_init','custom_mailer');


// shortcode of latest cars

function latest_cars(){
    ob_start();
    get_template_part('includes/latest','cars');
    return ob_get_clean();
}
add_shortcode('latest_cars','latest_cars');

function my_phone(){
    return '<a href="">+213655069573</a>';
}
add_shortcode('phone','my_phone');

//search query function for search-cars page
function search_query(){
    $args = [
        'post_type'     => 'cars',
        'posts_per_page'=> 0,
        'tax_query'     => [],
        'meta_query'    => [
            'relation'  => 'AND',
        ]
    ];
    // set the keyword
    if(isset($_GET['keyword']) && !empty($_GET['keyword'])){
        $args['s'] = sanitize_text_field($_GET['keyword']);
    }

    // set the brand
    if(isset($_GET['brand']) && !empty($_GET['brand'])){
        $args['tax_query'][] = [
            'taxonomy'  => 'brands',
            'field'     => 'slug',
            'terms'     => array(sanitize_text_field($_GET['brand'])),
        ];
    }
    // set the price above
    if(isset($_GET['price_above']) && !empty($_GET['price_above'])){
        $args['meta_query'][] = array(
            'key'       => 'price',
            'value'     => sanitize_text_field($_GET['price_above']),
            'compare'   => '>=',
            'type'      => 'numeric' 
        );
    }
    //set the price below
    if(isset($_GET['price_below']) && !empty($_GET['price_below'])){
        $args['meta_query'][] = array(
            'key'       => 'price',
            'value'     => sanitize_text_field($_GET['price_below']),
            'compare'   => '<=',
            'type'      => 'numeric' 
        );
    }

    return new WP_Query($args);
}