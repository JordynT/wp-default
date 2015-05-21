<?php

/**
 * Our custom post type function
 */
function create_custom_pledges_posttype(){
	$labels = array(
		'name'               => _x( 'Pledges', 'post type general name' ),
		'singular_name'      => _x( 'Pledges', 'post type singular name' ),
		'add_new'            => _x( 'Add New', 'pledge' ),
		'add_new_item'       => __( 'Add New Pledge' ),
		'edit_item'          => __( 'Edit Pledge' ),
		'new_item'           => __( 'New Pledge' ),
		'all_items'          => __( 'All Pledges' ),
		'view_item'          => __( 'View Pledge' ),
		'search_items'       => __( 'Search Pledges' ),
		'not_found'          => __( 'No Pledges found' ),
		'not_found_in_trash' => __( 'No Pledges found in the Trash' ),
		'parent_item_colon'  => '',
		'menu_name'          => 'Pledges'
	);
	$args = array(
		'labels'        => $labels,
		'description'   => 'Holds our annual Pledges that customers make',
		'public'        => true,
		'menu_position' => 5,
		'register_meta_box_cb' => 'sc_add_pledge_donation_metaboxes',
		'supports'      => array( 'title', 'editor','custom-fields'),
		'has_archive'   => true,
//        'capability_type'       => array('pledge','pledges'),
//        'map_meta_cap'          => true,
//        'capabilities'          => array(
//            //meta_caps don't assign to roles
//            'edit_post'             => 'edit_pledge',
//            'delete_post'           => 'delete_pledge',
//            'read_post'             => 'read_pledge',
//            //primitive/meta
//            'create_posts'          => 'create_pledges',
//            //primitive capabilities outside of meta
//            'publish_posts'         => 'publish_pledges',
//            'edit_posts'            => 'edit_pledges',
//            'edit_others_posts'     => 'edit_others_pledges',
//            'read_private_posts'    => 'read_private_pledges',
//            //primitive capabilities used inside of meta
//            'read'                  =>'read_pledges',
//            'delete_posts'          => 'delete_pledges',
//            'delete_others_posts'   =>'delete_others_pledges',
//            'delete_private_posts'  => 'delete_private_pledges',
//            'delete_published_posts'=> 'delete_published_pledges',
//            'edit_private_posts'    => 'edit_private_pledges',
//            'edit_published_posts'  => 'edit_published_pledges'
//      )
	);
	register_post_type('pledges', $args);

}
// Hooking up our function to theme setup
add_action('init', 'create_custom_pledges_posttype');


function sc_add_pledge_donation_metaboxes (){
	add_meta_box('pledge_donation_metabox', 'Pledge-Donation Options', 'sc_pledge_donation_callback', 'pledges', 'normal', 'high');
}
add_action('add_meta_boxes', 'sc_add_pledge_donation_metaboxes');


function sc_pledge_donation_callback($post){
	//setup default form values and pull in any values found into
	wp_nonce_field( 'sc_metabox_nonce', 'sc_nonce_field');
	$values = pledge_donation_never_empty_values($post->ID,['campaign-id','pledge-option-id']);

	//build form
	$html = '<label>';
	$html .= 'Campaign ID: ';
	$html .= '</label>';
	$html .= '<p><input type="text" name="annual-donation-campaign-id" value="' . $values['campaign-id'] . '"></p>';
	$html .= '<label for="annual-donation-pledge-option-id">';
	$html .= 'Pledge-option ID:';
	$html .= '</label>';
	$html .= '<p><input type="text" name="annual-donation-pledge-option-id" value="'. $values['pledge-option-id'] . '"></p>';
	echo $html;
}

function pledge_donation_never_empty_values($post_id,$fields){
	$values = maybe_unserialize(get_post_meta($post_id, 'pledge_donations', true));
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

function sc_save_pledge_donation_metabox_data($post_id){
	if(sc_user_can_save_pledge_donation($post_id,'sc_nonce_field' )){
		//Save Data
		$my_pledge_donation_options = [
			'campaign-id' => esc_attr($_POST['annual-donation-campaign-id']),
			'pledge-option-id' => esc_attr($_POST['annual-donation-pledge-option-id']),
		];
		update_post_meta($post_id, 'pledge_donations', $my_pledge_donation_options);
	}
}
add_action('save_post', 'sc_save_pledge_donation_metabox_data');

function sc_user_can_save_pledge_donation($post_id, $nonce){
	//is an autosave?
	$is_autosave = wp_is_post_autosave($post_id);
	//is revision?
	$is_revision = wp_is_post_revision($post_id);
	//is nonce valid?
	$is_valid_nonce = (isset($_POST[$nonce]) && wp_verify_nonce($_POST[$nonce], 'sc_metabox_nonce'));
    //return info
	return ! ($is_autosave || $is_revision) && $is_valid_nonce;

}
