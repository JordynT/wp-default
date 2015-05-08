<?php

add_action( 'widgets_init', 'theme_slug_widgets_init' );
function theme_slug_widgets_init() {
	register_sidebar( array(
		'name' => 'Main Sidebar',
		'id' => 'primary',
		'description' => 'Widgets in this area will be shown on all posts and pages.',
//		'before_widget' => '<li id="%1$s" class="widget %2$s">',
		'before_widget' => '<aside id="%1$s" class="blog-widget widget_text %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widgettitle">',
		'after_title'   => '</h2>',
	) );
}