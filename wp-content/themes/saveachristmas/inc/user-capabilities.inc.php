<?php

class sc_roles_capabilities
{
    function __construct(){

        add_action('admin_init', array(__CLASS__,'add_custom_roles'));
        add_action('admin_init', array(__CLASS__,'add_full_cpt_capability'));
//        add_action('admin_init', array(__CLASS__, 'add_editor_cpt_capabilities'));
    }

    /**
     * adding new roles
     */
    static function add_custom_roles()
    {
        $result = add_role(
            'pledge_maker',
            __('Pledge Maker'),
            array(
                //all Editor Capabilities
                'read' => true,  // true allows this capability
                'edit_posts' => true,
                'delete_posts' => true, // Use false to explicitly deny
                'delete_others_pages' => true,
                'delete_others_posts' => true,
                'delete_pages' => true,
                'delete_private_pages' => true,
                'delete_private_posts' => true,
                'delete_published_pages' => true,
                'delete_published_posts' => true,
                'edit_others_pages' => true,
                'edit_others_posts' => true,
                'edit_pages' => true,
                'edit_private_pages' => true,
                'edit_private_posts' => true,
                'edit_published_pages' => true,
                'edit_published_posts' => true,
                'manage_categories' => true,
                'manage_links' => true,
                'moderate_comments' => true,
                'publish_pages' => true,
                'publish_posts' => true,
                'read_private_pages' => true,
                'read_private_posts' => true,
                'upload_files' => true,
                //things this role shouldn't be able to do, that can cripple the site
                'edit_themes' => false, // false denies this capability. User can’t edit your theme
                'install_plugins' => false, // User cant add new plugins
                'update_plugin' => false, // User can’t update any plugins
                'update_core' => false, // user cant perform core updates
            )
        );

    }

    /**
     * adding new capabilities to roles
     */
    static function add_full_cpt_capability()
    {
        //custom post type capabilities
        $capabilities = array(
            'read_private_campaigns',
            'read_campaigns',
            'publish_campaigns',
            'create_campaigns',
            'edit_campaigns',
            'edit_others_campaigns',
            'edit_private_campaigns',
            'edit_published_campaigns',
            'delete_campaigns',
            'delete_private_campaigns',
            'delete_published_campaigns',
//            'create_pledges','publish_pledges', 'edit_pledges',
//            'edit_others_pledges', 'read_private_pledges',
//            'read_pledges', 'delete_pledges', 'delete_others_pledges',
//            'delete_private_pledges', 'delete_published_pledges',
//            'edit_private_pledges', 'edit_published_pledges'
        );

        $role = get_role('administrator');
        if (!empty($role)) {
            foreach ($capabilities as $cap) {
                $role->add_cap($cap);
//            $role->add_cap('read_private_campaigns');
//            $role->add_cap('read');
//            $role->add_cap('publish_campaigns');
//            $role->add_cap('create_campaigns');
//            $role->add_cap('edit_campaigns');
//            $role->add_cap('edit_others_campaigns');
//            $role->add_cap('edit_private_campaigns');
//            $role->add_cap('edit_published_campaigns');
//            $role->add_cap('delete_campaigns');
//            $role->add_cap('delete_others_campaigns');
//            $role->add_cap('delete_private_campaigns');
//            $role->add_cap('delete_published_campaigns');
            }
        }
        $pledge_maker = get_role('pledge_maker');
        if (!empty($pledge_maker)) {
            foreach ($capabilities as $cap) {
                $pledge_maker->add_cap($cap);
            }
        }
    }


    /**
     * @Todo add editor capabilities to campaigns
     */
    static function add_editor_cpt_capabilities(){
        global $wp_roles;
//        $editor = get_role('editor');
//        if(!empty($editor)){
        if(isset($wp_roles)){
            $wp_roles->add_cap('editor', 'read_private_campaigns');
        }

//            $editor->add_cap('read_private_campaigns');
//            $editor->add_cap('read');
//            $editor->add_cap('publish_campaigns');
//            $editor->add_cap('create_campaigns');
//            $editor->add_cap('edit_campaigns');
//            $editor->add_cap('edit_others_campaigns');
//            $editor->add_cap('edit_private_campaigns');
//            $editor->add_cap('edit_published_campaigns');
//            $editor->add_cap('delete_campaigns');
//            $editor->add_cap('delete_others_campaigns');
//            $editor->add_cap('delete_private_campaigns');
//            $editor->add_cap('delete_published_campaigns');
//
//      }

    }
}


?>