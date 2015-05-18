<?php

define( 'SITEOPTION_PREFIX', 'jt_option_' );
get_template_part('/lib/site-options-builder.class');

function site_options(){
	// create network-wide settings page
	$network_options_page = new sm_options_page( array (
		'id'           => 'network_settings',
		'page_title'   => 'Save a Christmas Options',
		'menu_title'   => 'sc Options'

	) );
	// Create General Network Settings section
	$network_options_page->add_part( $section_network_general = new sm_section( 'network_general', array (
		'title' => 'General'
	) ) );
	$section_network_general->add_part( $network_hide_wp_updates = new sm_textfield( 'site_featured_header_post_id', array (
		'label'          => 'Enter page ID of for pulling site featured header'
	) ) );
	$section_network_general->add_part( $network_hide_wp_updates = new sm_textfield( 'site_featured_modal_css_class', array (
		'label'          => 'Enter css class name for current modal'
	) ) );
	$section_network_general->add_part( $network_hide_wp_updates = new sm_textfield( 'site_fully_booked_modal_css_class', array (
		'label'          => 'Enter css class name for Fully Booked modal'
	) ) );
	$section_network_general->add_part( $network_hide_wp_updates = new sm_media_upload( 'site_featured_header_button_image', array (
		'label'          => 'What Image would you like to see in the main header\'s button?'
	) ) );
	$section_network_general->add_part( $network_hide_wp_updates = new sm_textfield( 'site_featured_copyright', array (
		'label'          => 'Enter what txt you would like to see after your copyright image. (suggestion: YYYY. Site Title . All Rights Reserved'
	) ) );

	// Create Hero Network Settings section
	$network_options_page->add_part( $section_network_hero = new sm_section( 'network_hero_section', array (
		'title' => 'Hero Section'
	) ) );
	$section_network_hero->add_part( $network_hide_wp_updates = new sm_textfield( 'site_featured_hero_title', array (
		'label'          => 'Enter a Title'
	) ) );
	$section_network_hero->add_part( $network_hide_wp_updates = new sm_textfield( 'site_featured_hero_button', array (
		'label'          => 'Enter a Title for the button'
	) ) );
	$section_network_hero->add_part( $network_hide_wp_updates = new sm_media_upload( 'site_featured_hero_image', array (
		'label'          => 'Enter an image, you would like for the hero image'
	) ) );

	// Create Pledge-options Network Settings section
	$network_options_page->add_part( $section_network_pledge_options = new sm_section( 'network_pledge_options', array (
		'title' => 'Pledge Options',
	) ) );
	$section_network_pledge_options->add_part( $network_hide_wp_updates = new sm_textfield( 'pledge_options_title', array (
		'label'          => 'Enter a title for the Pledge section'
	) ) );

	// Create Social Media Network Settings section
	$network_options_page->add_part( $section_network_social = new sm_section( 'network_social', array (
		'title' => 'Social Media',
	) ) );
	$section_network_social->add_part( $network_hide_wp_updates = new sm_textfield( 'social_title', array (
		'label'          => 'Social media Title'
	) ) );
	$section_network_social->add_part($network_hide_wp_updates = new sm_checkbox('social_facebook', array(
		'label'=>'Check to include facebook icon',
		'value'=>'true'
	)));
	$section_network_social->add_part( $network_hide_wp_updates = new sm_checkbox( 'social_twitter', array (
		'label'          => 'Check to include twitter icon',
		'value' => 'true'
	) ) );
	$section_network_social->add_part( $network_hide_wp_updates = new sm_checkbox( 'social_googleplus', array (
		'label'          => 'Check to include google plus icon',
		'value' => 'true'
	) ) );
	$section_network_social->add_part( $network_hide_wp_updates = new sm_textfield( 'social_text', array (
		'label'          => 'What would you like to share(max limit 120characters)',
	) ) );
	$section_network_social->add_part( $network_hide_wp_updates = new sm_textfield( 'social_site', array (
		'label'          => 'What website would you like to share',
	) ) );

	$network_options_page->build();
}

add_action('init', 'site_options');