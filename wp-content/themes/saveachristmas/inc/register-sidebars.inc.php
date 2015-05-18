<?php
/**
 * register sidebar
 */

class sc_sidebar{

    function __construct ()
    {
        add_action('widgets_init', array(__CLASS__,'theme_slug_widgets_init'));
    }
    static function theme_slug_widgets_init()
    {
        register_sidebar(array(
            'name' => 'Main Sidebar',
            'id' => 'primary',
            'description' => 'Widgets in this area will be shown on all posts and pages.',
            'before_widget' => '<aside id="%1$s" class="blog-widget widget_text %2$s">',
            'after_widget' => '</aside>',
            'before_title' => '<h2 class="widgettitle">',
            'after_title' => '</h2>',
        ));
    }
}