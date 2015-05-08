<?php

function testingResources(){

	wp_enqueue_style('style', get_stylesheet_uri());
}

add_action('wp_enqueue_scripts', 'testingResources');


//Navigation Menus

register_nav_menus( array(
	'primary' => __('Primary Menu'),
	'footer' => __('Footer Menu')
));

//Get Top Ancenstor

function get_top_ancestor_id() {
	global $post;
	if ($post->post_parent){
		$ancestors = array_reverse(get_post_ancestors($post->ID))	;
		return $ancestors[0];

	}
	return $post->ID;
}
