<?php

//get_template_part('campaign-meta-boxes.inc');
// Our custom post type function
function create_custom_posttype()
{
	$labels = array(
		'name'               => _x( 'Campaigns', 'post type general name' ),
		'singular_name'      => _x( 'Campaign', 'post type singular name' ),
		 'add_new'            => _x( 'Add New', 'campaign' ),
		 'add_new_item'       => __( 'Add New Campaign' ),
		 'edit_item'          => __( 'Edit Campaign' ),
		 'new_item'           => __( 'New Campaign' ),
		 'all_items'          => __( 'All Campaigns' ),
		 'view_item'          => __( 'View Campaign' ),
		 'search_items'       => __( 'Search Campaigns' ),
		 'not_found'          => __( 'No campaigns found' ),
		 'not_found_in_trash' => __( 'No campaigns found in the Trash' ),
		 'parent_item_colon'  => '',
		 'menu_name'          => 'Campaigns'
	);
	$args = array(
		'labels'        => $labels,
		'description'   => 'Holds our annual campaigns',
		'public'        => true,
		'menu_position' => 5,
		'register_meta_box_cb' => 'sc_add_campaign_metaboxes',
		'supports'      => array( 'title', 'editor', 'thumbnail', 'excerpt', 'comments', 'custom-fields' ),
		'has_archive'   => true
	);
	register_post_type('campaigns', $args);

}
// Hooking up our function to theme setup
add_action('init', 'create_custom_posttype');

//
//function sc_hello_world(){
//	add_meta_box('campaign_metabox', 'Campaign Options', 'sc_boom', 'campaign-options', 'normal', 'high');
//}
//add_action('add_meta_boxes', 'sc_hello_world');
//
//function sc_boom(){
//	echo "hello";
//}


function sc_add_campaign_metaboxes (){
//	die(__FILE__);
	add_meta_box('campaign_metabox', 'Campaign Options', 'sc_campaign_callback', 'campaigns', 'normal', 'high');
//	add_meta_box('sc_campaign_pledges', 'Pledges', 'sc_campaign_pledges', 'campaigns', 'normal', 'high');
}

add_action('add_meta_boxes', 'sc_add_campaign_metaboxes');


function sc_campaign_callback($post){
	//setup default form values and pull in any values found into
	wp_nonce_field( 'sc_metabox_nonce', 'sc_nonce_field');
	$values = never_empty_values($post->ID,['end-date','start-date','goal']);
	//build form
	$html = '<label for="annual-campaign-start-date">';
	$html .= 'Start date: ';
	$html .= '</label>';
	$html .= '<p><input type="text" class="annual-campaign-start-date" name="annual-campaign-start-date" value="' . $values['start-date'] . '"></p>';
	$html .= '<label for="annual-campaign-end-date">';
	$html .= 'End Date:';
	$html .= '</label>';
	$html .= '<p><input type="date" name="annual-campaign-end-date" value="'. $values['end-date'] . '"></p>';
	$html .= '<label for="annual-campaign-goal">';
	$html .= 'Goal: $';
	$html .= '</label>';
	$html .= '<p><input type="number" class="annual-campaign-goal" name="annual-campaign-goal" min="0" value="' . esc_attr($values['goal']) . '">';
	echo $html;
}

function never_empty_values($post_id,$fields){
	$values = maybe_unserialize(get_post_meta($post_id, 'campaign_options', true));
	//var_export($values);
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
			'goal' => esc_attr($_POST['annual-campaign-goal'])
		];
//		echo '<pre>';var_export($my_campaign_options);
//		$maybe_updated =
		update_post_meta($post_id, 'campaign_options', $my_campaign_options);
//		echo( 'did we update postid['.$post_id.']? '.var_export($maybe_updated,true) );
//		var_export(get_post_meta($post_id,'campaign_options',true));
//		exit;
	}
}
add_action('save_post', 'sc_save_campaign_metabox_data');

function sc_user_can_save_campaign($post_id, $nonce){
	//is an autosave?
	$is_autosave = wp_is_post_autosave($post_id);
	//is revision?
	$is_revision = wp_is_post_revision($post_id);
	//is nonce valid?
//	$is_not_valid_nonce = if( !isset( $_POST['sc_nonse_field'] ) || !wp_verify_nonce( $_POST['meta_box_nonce'], 'my_meta_box_nonce' ) ) return;
	$is_valid_nonce = (isset($_POST[$nonce]) && wp_verify_nonce($_POST[ $nonce ], 'sc_metabox_nonce'));
	return ! ($is_autosave || $is_revision) && $is_valid_nonce;


}


////Registers Meta Boxes for Campaigns
//function add_campaigns_metaboxes (){
//	add_meta_box('sc_campaign_startdate', 'Start Date', 'sc_campaign_startdate', 'campaigns', 'side', 'default');
////	add_meta_box('sc_campaign_pledges', 'Pledges', 'sc_campaign_pledges', 'campaigns', 'normal', 'high');
//}
//
//
////HTML for start date Meta box
//function sc_campaign_startdate(){
//	global $post;
//// Noncename needed to verify where the data originated
//	echo '<input type="hidden" name="campaignmeta_noncename" id="campaignmeta_noncename" value="' .
//		wp_create_nonce( plugin_basename(__FILE__) ) . '" />';
//// Get the start date data if its already been entered
//	$startdate = get_post_meta($post->ID, '_startdate', true);
//// Echo out the field
//
//	echo '<input type="text" name="_startdate" value="' . $startdate  . '" class="widefat" />';
//}
//
////save meta data
//function sc_save_campaigns_meta($post_id, $post) {
//// verify this came from the our screen and with proper authorization,
//// because save_post can be triggered at other times
//	if ( !wp_verify_nonce( $_POST['campaignmeta_noncename'], plugin_basename(__FILE__) )) {
//
//		return $post->ID;
//	}
//
//// Is the user allowed to edit the post or page?
//	if ( !current_user_can( 'edit_post', $post->ID )) {
//		if (isset($_POST['__startdate']) && 0 < count(strlen(trim ( $_POST['__startdate'])))){
//			return $post->ID;
//		}
//	}
//
//
//// OK, we're authenticated: we need to find and save the data
//// We'll put it into an array to make it easier to loop though.
//
//	$campaigns_meta['_startdate'] = $_POST['_startdate'];
//
//// Add values of $events_meta as custom fields
//
//	foreach ($campaigns_meta as $key => $value) { // Cycle through the $events_meta array!
//		if( $post->post_type == 'revision' ) return; // Don't store custom data twice
//		$value = implode(',', (array)$value); // If $value is an array, make it a CSV (unlikely)
//		if(get_post_meta($post->ID, $key, FALSE)) { // If the custom field already has a value
//			update_post_meta($post->ID, $key, $value);
//		} else { // If the custom field doesn't have a value
//			add_post_meta($post->ID, $key, $value);
//		}
//		if(!$value) delete_post_meta($post->ID, $key); // Delete if blank
//	}
//
//}
//
//add_action('save_post', 'sc_save_campaigns_meta', 1, 2); // save the custom fields


////HTML for pledges Meta box
//function sc_campaign_pledges(){
//	global $post;
//// Noncename needed to verify where the data originated
//	echo '<input type="hidden" name="campaignmeta_noncename" id="campaignmeta_noncename" value="' .
//		wp_create_nonce( plugin_basename(__FILE__) ) . '" />';
//// Get the pledge data if its already been entered
//	$pledges = get_post_meta($post->ID, 'sc_campaign_pledges ', true);
//// Echo out the field
//	$html = '<p><input type="checkbox" name="sc_campaign_pledges[\'25\']" value="' . $pledges  . '" class="widefat" /> $25.00</p>';
//	$html .= '<input type="checkbox" name="sc_campaign_pledges[\'50\']" value="' . $pledges  . '" class="widefat" /> $50.00';
//	$html .= '<p><input type="checkbox" name="sc_campaign_pledges[\'150\']" value="' . $pledges  . '" class="widefat" /> $150.00</p>';
//	$html .= '<input type="checkbox" name="sc_campaign_pledges[\'200\']" value="' . $pledges  . '" class="widefat" /> $200.00';
//	$html .= '<p><input type="checkbox" name="sc_campaign_pledges[\'500\']" value="' . $pledges  . '" class="widefat" /> $500.00</p>';
//	$html .= '<input type="checkbox" name="sc_campaign_pledges[\'2000\']" value="' . $pledges  . '" class="widefat" /> $2000.00';
//	$html .= '<p><input type="checkbox" name="sc_campaign_pledges[\'1\']" value="' . $pledges  . '" class="widefat" /> $1.00</p>';
//
//	echo $html;
////	echo '<input type="checkbox" name="sc_campaign_pledges[\'25\']" value="' . $pledges . '"> Pledge $25.00';
//}