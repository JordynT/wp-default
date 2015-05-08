<?php

function create_custom_pledgeoptions_posttype()
{
$labels = array(
'name'               => _x( 'Pledge-options', 'post type general name' ),
'singular_name'      => _x( 'Pledge-option', 'post type singular name' ),
'add_new'            => _x( 'Add New', 'pledge-option' ),
'add_new_item'       => __( 'Add New Pledge-option' ),
'edit_item'          => __( 'Edit Pledge-option' ),
'new_item'           => __( 'New Pledge-option' ),
'all_items'          => __( 'All Pledge-options' ),
'view_item'          => __( 'View Pledge-option' ),
'search_items'       => __( 'Search Pledge-options' ),
'not_found'          => __( 'No Pledge-options found' ),
'not_found_in_trash' => __( 'No Pledge-options found in the Trash' ),
'parent_item_colon'  => '',
'menu_name'          => 'Pledge-options'
);
$args = array(
'labels'        => $labels,
'description'   => 'Holds our annual Pledge-options',
'public'        => true,
'menu_position' => 5,
'register_meta_box_cb' => 'sc_add_pledge_options_metaboxes',
'supports'      => array( 'title', 'editor', 'thumbnail', 'excerpt', 'comments', 'custom-fields' ),
'has_archive'   => true
);
register_post_type('pledge-options', $args);

}
// Hooking up our function to theme setup
add_action('init', 'create_custom_pledgeoptions_posttype');


//Registers Meta Boxes for pledge options
function sc_add_pledge_options_metaboxes (){
	add_meta_box('pledge_options_metabox', 'Pledge Options', 'sc_pledge_options_callback', 'pledge-options', 'normal', 'high');
//	add_meta_box('sc_campaign_pledges', 'Pledges', 'sc_campaign_pledges', 'campaigns', 'normal', 'high');
}

add_action('add_meta_boxes', 'sc_add_pledge_options_metaboxes');


function sc_pledge_options_callback($post){

	wp_nonce_field( 'sc_metabox_nonce', 'sc_nonce_field');
	$value = get_post_meta($post->ID, 'pledge_options', true);
	$html = '<label for="pledge-options-amount">';
		$html .= 'Pledge Amount: ';
	$html .= '</label>';
	$html .= '<p><input type="text" class="pledge-options-title" name="pledge-options-amount" value="' . $value['amount'] . '" placeholder="ex: $25.00"></p>';
	$html .= '<label for="pledge-options-backers">';
		$html .= 'Number of Backers:';
	$html .= '</label>';
	$html .= '<p><input type="number" name="pledge-options-backers" min="0" value="'. $value['backers'] . '"></p>';
	$html .= '<label for="pledge-options-limit">';
		$html .= 'Limit of This Pledge';
	$html .= '</label>';
	$html .= '<p><input type="number" class="pledge-options-limit" name="pledge-options-limit" min="0" value="' . $value['limit'] . '">';
	echo $html;
}


function sc_save_pledge_options_metabox_data($post_id){

		if(sc_user_can_save($post_id,'sc_nonce_field' )){
			//Save Data
			$my_pledge_options = [
				'amount' => sanitize_text_field($_POST['pledge-options-amount']),
				'backers' => sanitize_text_field($_POST['pledge-options-backers']),
				'limit' => sanitize_text_field($_POST['pledge-options-limit'])
			];
//			if(isset( $_POST['pledge-options-amount']) && 0 < count(strlen( trim($_POST['pledge-options-amount'])))) {
//				$pledge_options_amount = stripslashes( strip_tags($_POST['pledge-options-amount']));
				update_post_meta($post_id, 'pledge_options', $my_pledge_options);
			}
		}


add_action('save_post', 'sc_save_pledge_options_metabox_data');

function sc_user_can_save($post_id, $nonce){
	//is an autosave?
	$is_autosave = wp_is_post_autosave($post_id);
	//is revision?
	$is_revision = wp_is_post_revision($post_id);
	//is nonce valid?
//	$is_not_valid_nonce = if( !isset( $_POST['sc_nonse_field'] ) || !wp_verify_nonce( $_POST['meta_box_nonce'], 'my_meta_box_nonce' ) ) return;
	$is_valid_nonce = (isset($_POST[$nonce]) && wp_verify_nonce($_POST[ $nonce ], 'sc_metabox_nonce'));
	return ! ($is_autosave || $is_revision) && $is_valid_nonce;


}
//
////HTML for pledge options Meta box
//function sc_pledgeoptions_callback(){
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
