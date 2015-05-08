<?php
////Registers Meta Boxes for Campaigns
//function add_campaigns_metaboxes (){
//add_meta_box('sc_campaign_startdate', 'Start Date', 'sc_campaign_startdate', 'campaigns', 'side', 'default');
//}
//
//
////HTML for Meta box
//function sc_campaign_startdate(){
//global $post;
//// Noncename needed to verify where the data originated
//echo '<input type="hidden" name="campaignmeta_noncename" id="campaignmeta_noncename" value="' .
//    wp_create_nonce( plugin_basename(__FILE__) ) . '" />';
//// Get the start date data if its already been entered
//$startdate = get_post_meta($post->ID, '_startdate', true);
//// Echo out the field
//echo '<input type="text" name="_startdate" value="' . $startdate  . '" class="widefat" />';
//}
//
////save meta data
//function sc_save_campaigns_meta($post_id, $post) {
//// verify this came from the our screen and with proper authorization,
//// because save_post can be triggered at other times
//if ( !wp_verify_nonce( $_POST['campaignmeta_noncename'], plugin_basename(__FILE__) )) {
//
//return $post->ID;
//}
//
//// Is the user allowed to edit the post or page?
//if ( !current_user_can( 'edit_post', $post->ID )) {
//if (isset($_POST['__startdate']) && 0 < count(strlen(trim ( $_POST['__startdate'])))){
//return $post->ID;
//}
//}
//
//
//// OK, we're authenticated: we need to find and save the data
//// We'll put it into an array to make it easier to loop though.
//
//$campaigns_meta['_startdate'] = $_POST['_startdate'];
//
//// Add values of $events_meta as custom fields
//
//foreach ($campaigns_meta as $key => $value) { // Cycle through the $events_meta array!
//if( $post->post_type == 'revision' ) return; // Don't store custom data twice
//$value = implode(',', (array)$value); // If $value is an array, make it a CSV (unlikely)
//if(get_post_meta($post->ID, $key, FALSE)) { // If the custom field already has a value
//update_post_meta($post->ID, $key, $value);
//} else { // If the custom field doesn't have a value
//add_post_meta($post->ID, $key, $value);
//}
//if(!$value) delete_post_meta($post->ID, $key); // Delete if blank
//}
//
//}
//
//add_action('save_post', 'sc_save_campaigns_meta', 1, 2); // save the custom fields
//
