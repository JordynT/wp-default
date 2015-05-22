<?php

/**
 * Our custom post type function
 */
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
'supports'      => array( 'title', 'editor'),
'has_archive'   => true
);
register_post_type('pledge-options', $args);

}
// Hooking up our function to theme setup
add_action('init', 'create_custom_pledgeoptions_posttype');


//Registers Meta Boxes for pledge options
function sc_add_pledge_options_metaboxes (){
	add_meta_box('pledge_options_metabox', 'Pledge Options', 'sc_pledge_options_callback', 'pledge-options', 'side', 'core');
}
add_action('add_meta_boxes', 'sc_add_pledge_options_metaboxes');


function sc_pledge_options_callback($post){

	wp_nonce_field( 'sc_metabox_nonce', 'sc_nonce_field');
	$value = get_post_meta($post->ID, 'pledge_options', true);
    $is_active = get_post_meta($post->ID, 'pledge_option_is_active', true);

    $html  = '<label for="pledge_option_is_active">';
        $html .= 'Is this Pledge active?';
    $html .= '</label>';
    $html .= '<p><input type="checkbox" name="pledge_option_is_active" value="1"' . (!empty($is_active) ? 'checked="checked" ' : null) . '/></p>';
	$html .= '<label for="pledge-options-amount">';
    $html .= '<label for="pledge-options-amount">';
		$html .= 'Pledge Amount: ';
	$html .= '</label>';
	$html .= '<p>$<input type="number" class="pledge-options-title" name="pledge-options-amount" value="' . $value['amount'] . '" ></p>';
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
				update_post_meta($post_id, 'pledge_options', $my_pledge_options);

                update_post_meta($post_id, 'pledge_option_is_active', esc_attr($_POST['pledge_option_is_active']));
			}
		}
add_action('save_post', 'sc_save_pledge_options_metabox_data');

function sc_user_can_save($post_id, $nonce){
	//is an autosave?
	$is_autosave = wp_is_post_autosave($post_id);
	//is revision?
	$is_revision = wp_is_post_revision($post_id);
	//is nonce valid?
	$is_valid_nonce = (isset($_POST[$nonce]) && wp_verify_nonce($_POST[ $nonce ], 'sc_metabox_nonce'));
    //return info
	return ! ($is_autosave || $is_revision) && $is_valid_nonce;
}