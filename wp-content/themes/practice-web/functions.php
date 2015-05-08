<?php
//Enqueue

function theme_resources(){
	wp_enqueue_style('style', get_stylesheet_uri());
	wp_enqueue_style( 'prefix-font-awesome', '//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css', array(), '4.0.3' );
	wp_register_style('googleFonts', 'http://fonts.googleapis.com/css?family=Rock+Salt|Open+Sans');
	wp_enqueue_style( 'googleFonts');
}

add_action('wp_enqueue_scripts', 'theme_resources');

function add_meta_viewport(){
	echo '<meta name="viewport" content="width=device-width">' . PHP_EOL;
}

add_action('wp_print_styles', 'add_meta_viewport');


//Navigation Menus

register_nav_menus(array(
	'primary' => __('Primary Menu'),
	'footer' => __('Footer Menu')
));