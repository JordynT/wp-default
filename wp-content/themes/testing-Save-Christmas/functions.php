<!--<link rel='stylesheet' id='campaignify-responsive-css'  href='http://saveachristmas.com/wp-content/themes/campaignify/css/responsive.css?ver=20130603' type='text/css' media='all' />-->
<?php
/*
include_once(get_stylesheet_directory() . '/lib/site-options-builder.class.php');

function site_options(){
	// create network-wide settings page
	$network_options_page = new sm_options_page( array (
		'parent_id'    => 'settings.php',
		'id'           => 'network_settings',
		'page_title'   => 'Save a Christmas Options',
		'menu_title'   => 'sc Options'

	) );
	// Create General Network Settings section
	$network_options_page->add_part( $section_network_general = new sm_section( 'network_general', array (
		'title' => 'General'
	) ) );
	// Hide WP Update Notices option
	$section_network_general->add_part( $network_hide_wp_updates = new sm_checkbox( 'network_hide_wp_update_notices', array (
		'label'          => 'Turn on to hide WordPress core update notifications',
		'value'          => 'hidden',
		'classes'        => array ( 'onOffSwitch' ),
		'network_option' => true
	) ) );
}


function theme_resources(){
	wp_enqueue_style('style', get_stylesheet_uri());
	wp_enqueue_script('jquery');
	wp_enqueue_script('main');
	wp_register_script('jquery-migrate', 'http://saveachristmas.com/wp-includes/js/jquery/jquery-migrate.min.js?ver=1.2.1');
	wp_enqueue_script('jquery-migrate');
	wp_enqueue_script('ed-ajax', 'http://saveachristmas.com/wp-content/plugins/easy-digital-downloads/assets/js/edd-ajax.min.js?ver=2.2.1');
	wp_enqueue_script('jquery-currency', 'http://saveachristmas.com/wp-content/plugins/appthemer-crowdfunding/assets/js/jquery.formatCurrency-1.4.0.pack.js?ver=4.1.1' );
	wp_enqueue_script('crowdfunding', 'http://saveachristmas.com/wp-content/plugins/appthemer-crowdfunding/assets/js/crowdfunding.js?ver=4.1.1');
	wp_enqueue_style('googleFonts', 'http://fonts.googleapis.com/css?family=Lato:400,700,400italic|Crete+Round:400,400italic|Norican&#038;subset=latin');
	wp_enqueue_style('manifest', 'http://saveachristmas.com/wp-includes/wlwmanifest.xml');
}

add_action('wp_enqueue_scripts', 'theme_resources');






//Theme Setup
function wordpress_setup(){
	//Add featured image support
	add_theme_support('post-thumbnails');
	add_image_size('small-thumbnail', 180,120, true);
	add_image_size('banner-thumbnail', 920,210, array());
	//Navigation Menus

	register_nav_menus( array(
		'primary' => __('Primary Menu'),
		//'footer' => __('Footer Menu')
	));
}
add_action('after_setup_theme', 'wordpress_setup');

//meta-box setup function
add_action('load-post.php', 'post_meta_boxes_setup');
add_action('load-post-new.php', 'post_meta_boxes_setup');

//meta box setup function
function post_meta_boxes_setup(){
	//adds meta-boxes on the hook
	add_action('add_meta_boxes', 'add_post_meta_boxes');
}

//Creates one or more meta-boxes to be displayed
function add_post_meta_boxes(){
	add_meta_box(
		//Unique ID
		'sac-custom-hero-section',
		//Title
		'Post Class',
		//Call back function
		'post_class_meta_box',
		'post',
		'side',
		'default'
	);
}

//Display the post-meta box
function post_class_meta_box(){

}
*/