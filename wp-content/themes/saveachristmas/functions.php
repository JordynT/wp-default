<?php

/**
 * Class saveachristmas
 */
class saveachristmas{
	function __construct(){
		include_once(__DIR__.'/inc/register-sidebars.inc.php');
		include_once(__DIR__.'/inc/campaign-custom-post-type.inc.php');
		include_once(__DIR__.'/inc/pledge-option-custom-post-type.inc.php');
		include_once(__DIR__.'/inc/pledge-custom-post-type.inc.php');
		include_once(__DIR__.'/inc/site-options.inc.php');
		include_once(__DIR__.'/inc/shortcodes.inc.php');
		if(class_exists('sc_shortcodes')) {
			new sc_shortcodes();
		}

		add_action('after_setup_theme', array(__CLASS__,'wordpress_setup'));
		add_action('wp_enqueue_scripts', array(__CLASS__,'theme_resources'));
		add_action( 'admin_menu', array(__CLASS__,'remove_menus' ));
	}

	/**
	 * enqueue styles and scripts
	 */
	static function theme_resources(){
		wp_enqueue_style('style', get_stylesheet_uri());
		wp_enqueue_script('jquery');
		wp_enqueue_script('main');
		wp_register_script('jquery-migrate', 'http://saveachristmas.com/wp-includes/js/jquery/jquery-migrate.min.js?ver=1.2.1');
		wp_enqueue_script('jquery-migrate');
		wp_enqueue_script('ed-ajax', 'http://saveachristmas.com/wp-content/plugins/easy-digital-downloads/assets/js/edd-ajax.min.js?ver=2.2.1');
		wp_enqueue_script('jquery-currency', 'http://saveachristmas.com/wp-content/plugins/appthemer-crowdfunding/assets/js/jquery.formatCurrency-1.4.0.pack.js?ver=4.1.1' );
		wp_enqueue_script('crowdfunding', 'http://saveachristmas.com/wp-content/plugins/appthemer-crowdfunding/assets/js/crowdfunding.js?ver=4.1.1');
		wp_enqueue_style('googleFonts', 'http://fonts.googleapis.com/css?family=Lato:400,700,400italic|Crete+Round:400,400italic|Norican&#038;subset=latin');
		wp_enqueue_style('manifest', 'http://saveachristmas.com/wp-includes/wlwmanifest.xml');
	}

	/**
	 * Theme Setup
	 */
	static function wordpress_setup(){
		//Add featured image support
		add_theme_support('post-thumbnails');
		add_image_size('small-thumbnail', 180,120, true);
		add_image_size('banner-thumbnail', 920,210, array());
		//Navigation Menus

		register_nav_menus( array(
			'primary' => __('Primary Menu'),
			'footer' => __('Footer Menu')
		));
	}

	/**
	 * Remove sections of ADMIN
	 */
	static function remove_menus(){
		remove_menu_page( 'edit.php' );                   //Posts
		remove_menu_page( 'edit-comments.php' );          //Comments
	}
} //end of saveachristmas class
$sc_theme = new saveachristmas();