<?php
/*
@package: sm-sitemap-navigator
@plugin URI: http://sethmatics.com
@Description: Lists all pages in site with the exceptions of those marked for inclusion
@Author: sethmatics
*/

// create page for gsitemap
function sm_create_gsitemap(){
	$new_page_title = 'Google Sitemap';
	$page_check = get_page_by_title($new_page_title);
	$new_page = array(
		'post_type' => 'page',
		'post_title' => $new_page_title,
		'post_name' => 'gsitemap',
		'post_content' => 'This page was created by SM Dashboard Pages Navigator Tree and is used for displaying your Google Sitemap. Publish to enable. View and use URL in Google Webmaster Tools to enable sitemap crawling. DO NOT CHANGE SLUG.',
		'post_status' => 'draft',
		'post_author' => 1,
	);
	if(!isset($page_check->ID)){
		$new_page_id = wp_insert_post($new_page);
		update_post_meta($new_page_id, '_sm_sitemap_exclude_completely', 'yes');
	}
}

// permanently trash google sitemap page
function sm_remove_gsitemap(){
	$page_check = get_page_by_title('Google Sitemap');
	if(isset($page_check->ID)){
		wp_delete_post( $page_check->ID, true );
	}
}

/* Add Exclude Page Meta Box  */
add_action('add_meta_boxes', 'sm_sitemap_exclude_init', 10);
add_action('save_post', 'sm_sitemap_exclude_save');

function sm_sitemap_exclude_init(){
	add_meta_box('exclude', __('Exclude from Sitemap', 'sm'), 'sm_exclude_form', 'page', 'side', '');
}

function sm_exclude_form(){ 
	global $post;
	$post_data = get_post_custom($post->ID);
	$exclude = $post_data['sm_sitemap_exclude'][0];
	?>
    <div style="margin-bottom:10px;">
	<input type="checkbox" name="sm_sitemap_exclude" id="sm_sitemap_exclude" value="yes" <?php if(get_post_meta($post->ID, '_sm_sitemap_exclude', true) == 'yes') { echo 'checked="checked"'; } ?> >
	<label for="sm_sitemap_exclude">Display page name in sitemap without link</label>
    </div>
    <input type="checkbox" name="sm_sitemap_exclude_completely" id="sm_sitemap_exclude_completely" value="yes" <?php if(get_post_meta($post->ID, '_sm_sitemap_exclude_completely', true) == 'yes') { echo 'checked="checked"'; } ?> >
	<label for="sm_sitemap_exclude">Exclude this page from sitemap</label>
	<?php 
	// Use nonce for verification
	wp_nonce_field( plugin_basename( __FILE__ ), 'sm_sitemap_nonce' );
} 

function sm_sitemap_exclude_save(){
	global $post;
	if(!isset($post)) return false;
	if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return $post->ID;
	
	// verify
	if (!isset($_POST['sm_sitemap_nonce']) || !wp_verify_nonce( $_POST['sm_sitemap_nonce'], plugin_basename( __FILE__ ) ) ) return;
	if ( 'page' == $_POST['post_type'] ) {
		if ( !current_user_can( 'edit_page', $post_id ) ) return;
		else
		if ( !current_user_can( 'edit_post', $post_id ) ) return;
	}
	// update the option
	update_post_meta($post->ID, '_sm_sitemap_exclude', $_POST['sm_sitemap_exclude']);
	update_post_meta($post->ID, '_sm_sitemap_exclude_completely', $_POST['sm_sitemap_exclude_completely']);
}

function sm_pages_recursive($parentId, $lvl){
	$output='';
	// get child pages
    $args=array('child_of' => $parentId, 'parent' => $parentId);
    $pages = get_pages($args); 
	
    if ($pages) {
        $lvl ++;
		$hlvl = $lvl+1;
		if($hlvl > 6) $hlvl == 6;
		
		$output.= "<ul class='level$lvl'>".PHP_EOL;
		// loop through pages and add them to list
        foreach ($pages as $page) {
			if(get_post_meta( $page->ID, '_sm_sitemap_exclude_completely', true ) != 'yes') {
				$output.= "<li id='$page->ID' class=\"treelimb\">".PHP_EOL;
				$output.= "<div class='treeleaf'>".PHP_EOL;
				// if exclude box checked or page uses 404template just publish page title without link, otherwise create link to page
				if(get_post_meta( $page->ID, '_wp_page_template', true ) == 'tpl-404.php' || get_post_meta( $page->ID, '_sm_sitemap_exclude', true ) == 'yes' ) {
					$output.=  "<h$hlvl >".$page->post_title."</h$hlvl> ".PHP_EOL;
					if(current_user_can( 'edit_posts' ))
						$output.= "<a class=\"editPage\" href=\"".get_edit_post_link( $page->ID)."\">[edit page]</a>".PHP_EOL;
				}
				else {
					$output.= "<h$hlvl ><a href=\"".get_permalink($page->ID)."\">".$page->post_title."</a></h$hlvl> ".PHP_EOL;
					if(current_user_can( 'edit_posts' ))
						$output.= "<a class=\"editPage\" href=\"".get_edit_post_link( $page->ID)."\">[edit page]</a>".PHP_EOL;
				}
				
			   $output.= "</div>".PHP_EOL;
			   // recall function to see if child pages have children
			   $output .= sm_pages_recursive($page->ID, $lvl);
			   
			   $output.=  "</li>".PHP_EOL;
			} //end if sitemap exclude completely
		   
        }
		$output.=  "</ul>".PHP_EOL;
    }
	return $output;
}


function sm_google_sitemap_recursive($parentId, $lvl){
		$output='';
	// get child pages
    $args=array('child_of' => $parentId, 'parent' => $parentId, 'post_type' => 'page', 'post_status' => 'publish');
    $thePages = get_pages($args); 
	
	$args=array('post_parent' => $parentId, 'post_type' => 'post', 'numberposts' => -1);
    $thePosts = get_posts($args);
	
	//die( (string)count($thePosts) ); 
	
	$pages = array_merge($thePages, $thePosts);
	
    if ($pages) {
		
		// loop through pages and add them to list
        foreach ($pages as $page) {
			
			
			// if exclude box checked or page uses 404template just publish page title without link, otherwise create link to page
			if(get_post_meta( $page->ID, '_wp_page_template', true ) == 'tpl-404.php' || get_post_meta( $page->ID, '_sm_sitemap_exclude', true ) == 'yes' || get_post_meta( $page->ID, '_sm_sitemap_exclude_completely', true ) == 'yes' ) {}
			else {
				$output.= '<url>'.PHP_EOL;
				$output.= '<loc>'.get_permalink($page->ID).'</loc>'.PHP_EOL;
				$output.= '<lastmod>'.preg_replace('~\s.*~', '', $page->post_modified).'</lastmod>'.PHP_EOL;
				$output.= '</url>'.PHP_EOL;
			}
			
		   // recall function to see if child pages have children
		   $output .= sm_google_sitemap_recursive($page->ID, $lvl);
        }
		
    }//if($pages)
	return $output;
}

function get_sm_google_sitemap() {
	$ouput = '<?xml version="1.0" encoding="UTF-8"?>'.PHP_EOL;
	$ouput .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">'.PHP_EOL;
	$ouput .= sm_google_sitemap_recursive(0, 0).PHP_EOL;
	$ouput .= '</urlset> '.PHP_EOL; 
	echo $ouput;
}

// dispalys google sitemap when gsitemap page is called
function sm_google_sitemap() {
	if(is_page('gsitemap')) {
		header('Content-type: text/xml');
		echo get_sm_google_sitemap();
		exit();
	}
}
add_action('template_redirect','sm_google_sitemap');


//SHORTCODE
//name: sm_sitemap
//description: inserts sitemap into page content
//format: [sm_sitemap]

add_shortcode('sm_sitemap', 'sm_sitemap');

function sm_sitemap($atts, $content = null) {
	$ouput =  '<style>'.PHP_EOL;
	$ouput .= '#smSitemap h1,#smSitemap h2,#smSitemap h3,#smSitemap h4,#smSitemap h5,#smSitemap h6 { display:inline; }'.PHP_EOL;
	$ouput .= '</style>'.PHP_EOL; 
	$ouput .= '<div id="smSitemap">'.sm_pages_recursive(0, 0).'</div>'.PHP_EOL;
	return $ouput;
}
?>