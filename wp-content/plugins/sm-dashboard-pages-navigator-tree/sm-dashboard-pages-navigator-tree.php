<?php
/**
 * Plugin Name: SM Sitemap Navigator
 * Plugin URI: http://sethmatics.com/extend/plugins/sm-dashboard-pages-navigator-tree/
 * Description: Lists all pages in site in admin
 * Author: sethmatics, bigj9901
 * Version: 1.0.5
 * Author URI: http://sethamtics.com/
 * License: GNU General Public License v2 or later
 * License URI: http://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: sm-dashboard-pages-navigator-tree
 *
 * @package sm-dashboard-pages-navigator-tree
 * @category plugin
 * @author sethmatics, bigj9901
 */

define('SM_SITEMAP_NAV_DIR', WP_PLUGIN_DIR.'/sm-dashboard-pages-navigator-tree/');
define('SM_SITEMAP_NAV_URL',plugins_url('/', __FILE__));

include_once(SM_SITEMAP_NAV_DIR.'sm-sitemap.php');

// functions to perform when plugin is activated
register_activation_hook( __FILE__, 'sm_sitemap_navigator_activation' );
function sm_sitemap_navigator_activation() {
	sm_create_gsitemap();
}

// functions to perform when plugin is deactivated
register_deactivation_hook( __FILE__, 'sm_sitemap_navigator_deactivation' );
function sm_sitemap_navigator_deactivation() {
	sm_remove_gsitemap();
}

// Register the new dashboard widget into the 'wp_dashboard_setup' action
add_action('wp_dashboard_setup', 'sm_add_dashboard_widgets' );
function sm_add_dashboard_widgets() {
	wp_add_dashboard_widget('sm-pagetree', 'Page Navigator', 'list_sm_pagetree');
}

//add admin stylesheet
add_action('admin_print_styles', 'sm_pagetree_admin_styles');
function sm_pagetree_admin_styles() {
	if(did_action( 'wp_dashboard_setup' ) >0 )
		wp_enqueue_style('sm-pagetree-admin-styles', SM_SITEMAP_NAV_URL.'css/sm-pagetree-admin-styles.css', array(), '1.0.0', 'all');
}

// add admin javascript
add_action( 'admin_enqueue_scripts', 'sm_pagetree_admin_scripts' );
function sm_pagetree_admin_scripts() {
	if(did_action( 'wp_dashboard_setup' ) >0 ) {
		wp_enqueue_script( 'sm-pagetree-admin-scripts', SM_SITEMAP_NAV_URL.'js/sm-pagetree-admin-scripts.js', array('jquery') );
		wp_enqueue_script( 'simple-tree-view', SM_SITEMAP_NAV_URL.'js/jquery.simpletreeview.js', array('jquery') );
	}
}

/*
 * BUILD PAGE TREE - PRIMARY FUNCTION
*/
function get_sm_pagetreee($parentId, $lvl){
	$output = $childCount = '';
	$pages = get_pages(array('child_of' => $parentId, 'parent' => $parentId, 'post_type' => 'page', 'post_status' => array('publish','pending','draft','private')));
	$postRevisions = get_posts(array('post_parent' => $parentId, 'post_type' => 'revision', 'post_status' => 'pending'));
	$pages = array_merge((array)$postRevisions, (array)$pages );

	if ($pages) {	
		if($lvl<1) $output .= "<ul id=\"simpletree\" class='level".$lvl++."'>".PHP_EOL;
		else $output.= "<ul class='treebranch level".$lvl++."'>".PHP_EOL;
		
		// loop through pages and add them to treebranch
        foreach ($pages as $page) {
			$children = array();
			// get template being used by page so we can exclude those set to 404 tpl
			//TODO: Fix the fact that 404 pages have a view button that costs too much RAM.
	        $pageTemplate ='';
			//$pageTemplate = get_post_meta($page->ID, '_wp_page_template',true );

			// get child pages and revisions for current post and combine child pages and revisions and count them
			
			/*
			$children = get_pages(array('child_of' => $page->ID, 'parent' => $page->ID, 'post_type' => 'page', 'post_status' => array('publish','pending','draft'), 'hierarchical' => 0));
			$childRevisions = get_posts(array('post_parent' => $page->ID, 'post_type' => 'revision', 'post_status' => 'pending'));
			if(is_array($childRevisions)) $children = array_merge((array)$childRevisions, (array)$children );
			$childCount = count($children); 
			*/
			
			//if($childCount > 1) die(print_r($childRevisions));
			
			//if branch has children branches, create a new treebranch, otherwise create a treeleaf
			if($childCount > 0) $output.= "<li id=\"$page->ID\" class=\"treebranch\">".PHP_EOL;
			else $output.= "<li id=\"$page->ID\" class=\"treeleaf\">".PHP_EOL;
			
			//begin setting up treeleaf leaflet content
			$output.= "<div class='treeleaflet'>".PHP_EOL;
			$output.= "<span class=\"leafname\">$page->post_title</span>";
			
			// show child count if there are children
			if($childCount > 0) $output.= '<span class="childCount"> ('.$childCount.')</span> ';

	        //setup page author
	        $revAuthorID = $page->post_author;

			// if its not a revision
			if($page->post_type != 'revision') {
				
				// display status
				$output.= " <span class=\"status $page->post_status\">$page->post_status</span>";
				
				// show excluded if it is
				if(get_post_meta($page->ID, '_sm_sitemap_exclude_completely', true) == 'yes' && $page->post_status =='publish' ) {
					$output.= " <span class=\"status excluded\">no sitemap</span>";
				}
				$output.= "<span class=\"action-links\">  - ";
				
				//view link
				if($pageTemplate != 'tpl-404.php')
					$output.= "<a class=\"viewPage\" href=\"".get_permalink($page->ID)."\">view</a> ".PHP_EOL;
				else $output.= "Placeholder Page ";
				
				// if current user not revision editor do not allow to make changes
				if( $revAuthorID == $GLOBALS['current_user']->ID && !current_user_can('edit_others_revisions') ) {}
				$post_type_object = get_post_type_object( $page->post_type );
					
				if(current_user_can( 'edit_others_pages' ) || ($revAuthorID == $GLOBALS['current_user']->ID && current_user_can('edit_pages')) )
					$output.= "| <a class=\"editPage\" href=\"".admin_url( sprintf($post_type_object->_edit_link . '&action=edit', $page->ID) )."\">edit</a> ".PHP_EOL;
				
				$output.= "</span>";
				$output.= "</div>".PHP_EOL;	
				
			}// if($page->post_type != 'revision')		
			
			// if its a revision
			elseif($page->post_type == 'revision') {
				
				//display revision status
				$output.= " <span class=\"status $page->post_type\">$page->post_type</span>";
				$output.= "<span class=\"action-links\"> - ";
				$output.= "<a class=\"viewPage\" href=\"/?p=$page->ID&amp;post_type=revision&amp;preview=true\">preview</a>".PHP_EOL;
				
				$current_user = wp_get_current_user();
				$currentUserID = $current_user->ID ;
				
				// if current user not revision editor do not allow to make changes
				if( $revAuthorID == $currentUserID && current_user_can('edit_others_revisions') )
					$output.= " | <a class=\"editPage\" href=\"/wp-admin/admin.php?page=rvy-revisions&amp;revision=$page->ID&amp;action=edit\">edit</a>".PHP_EOL;
					
				$output.= "</span>";
			}
			
			// recall function to see if child pages have children
			unset($pages);
			$output .= get_sm_pagetreee($page->ID, $lvl);
			$output.=  "</li>".PHP_EOL;
        }
		$output.=  "</ul>".PHP_EOL;
    }
	
	return $output;
}

function meg($mem_usage)
 {
	 $output = '';
	if ($mem_usage < 1024)
            $output .= $mem_usage." bytes";
        elseif ($mem_usage < 1048576)
            $output .= round($mem_usage/1024,2)." kilobytes";
        else
            $output .= round($mem_usage/1048576,2)." megabytes"; 
	return $output;
 }

function list_sm_pagetree() {
	// get and combine child pages and revision s
    $memstart2 = memory_get_usage();
	$output = '<div id="smPagetree"><p><a href="#" id="expand">Expand All</a> | <a href="#" id="collapse">Collapse All</a></p>'.get_sm_pagetreee(0, 0).'</div>'.PHP_EOL;
	$memend2 = memory_get_usage();
	$mem_usage = (float)($memend2-$memstart2);
	//$output = '<h2>Memory Used: '.meg($mem_usage).' of '.meg($memend2).'</h2>'.$output;
	echo $output;
}
?>