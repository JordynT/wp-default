<?php

/**
 * Our custom post type function
 */
function create_custom_posttype()
{
	$labels = array(
		'name'                  => _x( 'Campaigns', 'post type general name' ),
		'singular_name'         => _x( 'Campaign', 'post type singular name' ),
		 'add_new'              => _x( 'Add New', 'campaign' ),
		 'add_new_item'         => __( 'Add New Campaign' ),
		 'edit_item'            => __( 'Edit Campaign' ),
		 'new_item'             => __( 'New Campaign' ),
		 'all_items'            => __( 'All Campaigns' ),
		 'view_item'            => __( 'View Campaign' ),
		 'search_items'         => __( 'Search Campaigns' ),
		 'not_found'            => __( 'No campaigns found' ),
		 'not_found_in_trash'   => __( 'No campaigns found in the Trash' ),
		 'parent_item_colon'    => '',
		 'menu_name'            => 'Campaigns'
	);
	$args = array(
		'labels'                => $labels,
		'description'           => 'Holds our annual campaigns',
		'public'                => true,
		'menu_position'         => 5,
		'register_meta_box_cb'  => 'sc_add_campaign_metaboxes',
		'supports'              => array( 'title', 'editor'),
		'has_archive'           => true,
        'capability_type'       => array('campaign','campaigns'),
        'map_meta_cap'          => true,
        'capabilities'          => array(
                //meta_caps don't assign to roles
                'edit_post'             => 'edit_campaign',
                'delete_post'           => 'delete_campaign',
                'read_post'             => 'read_campaign',
                //primitive/meta
                'create_posts'          => 'create_campaigns',
                //primitive capabilities outside of meta
                'publish_posts'         => 'publish_campaigns',
                'edit_posts'            => 'edit_campaigns',
                'edit_others_posts'     => 'edit_others_campaigns',
                'read_private_posts'    => 'read_private_campaigns',
                //primitive capabilities used inside of meta
                'read'                  =>'read_campaigns',
                'delete_posts'          => 'delete_campaigns',
                'delete_others_posts'   =>'delete_others_campaigns',
                'delete_private_posts'  => 'delete_private_campaigns',
                'delete_published_posts'=> 'delete_published_campaigns',
                'edit_private_posts'    => 'edit_private_campaigns',
                'edit_published_posts'  => 'edit_published_campaigns'
        )
	);
	register_post_type('campaigns', $args);

}
// Hooking up our function to theme setup
add_action('init', 'create_custom_posttype');

function sc_add_campaign_metaboxes () {
	add_meta_box (
		'campaign_metabox', 
		'Campaign Options', 
		'sc_campaign_callback', 
		'campaigns', 
		'side'
	);
}
add_action('add_meta_boxes', 'sc_add_campaign_metaboxes');


function sc_campaign_callback($post){
	//setup default form values and pull in any values found into
	wp_nonce_field( 'sc_metabox_nonce', 'sc_nonce_field');
	$values = never_empty_values($post->ID,['end-date','start-date','goal', 'is_fully_booked']);
	$is_active = get_post_meta($post->ID, 'is_active', true);

	//build form
	$html = '<div><input type="checkbox" name="is_active" value="1" '. (!empty($is_active) ? ' checked="checked" ' : null) .' /><label><strong> Is Active Campaign?</strong></label></div>';
	$html .= '<div><input type="checkbox" name="is_fully_booked" value="1" '. (!empty($values['is_fully_booked']) ? ' checked="checked" ' : null) .' /><label><strong> Is Fully Booked?</strong></label></div>';
	$html .= '<p><label for="annual-campaign-start-date">';
	$html .= '<strong>Start date: </strong>';
	$html .= '</label>';
	$html .= '<input type="date" class="annual-campaign-start-date" name="annual-campaign-start-date" value="' . $values['start-date'] . '"></p>';
	$html .= '<label for="annual-campaign-end-date">';
	$html .= '<strong>End Date: </strong>';
	$html .= '</label>';
	$html .= '<input type="date" name="annual-campaign-end-date" value="'. $values['end-date'] . '"></p>';
	$html .= '<p><label for="annual-campaign-goal">';
	$html .= '<strong>Goal: $</strong>';
	$html .= '</label>';
	$html .= '<input type="number" class="annual-campaign-goal" name="annual-campaign-goal" min="0" value="' . esc_attr($values['goal']) . '">';
	echo $html;
}

function never_empty_values($post_id,$fields){
	$values = maybe_unserialize(get_post_meta($post_id, 'campaign_options', true));
	if(!$values) {
		$values = [];
	}
	$NE_values = [];
	foreach($fields as $fname){
		$NE_values[$fname] = '';
	}
	$NE_values = array_merge($NE_values, $values);
	return $NE_values;
}

function sc_save_campaign_metabox_data($post_id){
	if(sc_user_can_save_campaign($post_id,'sc_nonce_field' )){
		//Save Data
		$my_campaign_options = [
			'start-date' => esc_attr($_POST['annual-campaign-start-date']),
			'end-date' => esc_attr($_POST['annual-campaign-end-date']),
			'goal' => esc_attr($_POST['annual-campaign-goal']),
			'is_fully_booked' => esc_attr($_POST['is_fully_booked'])
		];
		update_post_meta($post_id, 'campaign_options', $my_campaign_options);

			
		update_post_meta($post_id, 'is_active', esc_attr($_POST['is_active']));
	}
}
add_action('save_post', 'sc_save_campaign_metabox_data');

function sc_user_can_save_campaign($post_id, $nonce){
	//is an autosave?
	$is_autosave = wp_is_post_autosave($post_id);
	//is revision?
	$is_revision = wp_is_post_revision($post_id);
    //is valid nonce?
	$is_valid_nonce = (isset($_POST[$nonce]) && wp_verify_nonce($_POST[ $nonce ], 'sc_metabox_nonce'));
    //return info
	return ! ($is_autosave || $is_revision) && $is_valid_nonce;
}
