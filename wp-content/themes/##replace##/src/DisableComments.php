<?php

namespace Staempfli;

/**
 * All needed functionality to remove comments from WordPress completly
 */
class DisableComments
{

    /**
     * Add actions and hooks to WordPress core to remove comments completly
     * 
     * @static
     * @return void
     */
    public static function addActions()
    {
        add_action('admin_init', __CLASS__ . '::removeComments');
        add_action('admin_menu', __CLASS__ . '::removeCommentsMenu');
        add_action('init', __CLASS__ . '::removeCommentsMenuInAdminBar');

        add_filter('comments_array', '__return_empty_array', 10, 2);
        add_filter('comments_open', '__return_false', 20, 2);
        add_filter('pings_open', '__return_false', 20, 2);
    }

    /**
     * Remove posttype support for every posttype
     * Redirect if optionpage is accessed directly
     *
     * @return void
     */
    public static function removeComments()
    {
        $types = get_post_types();
        foreach ($types as $type) {
            if(post_type_supports($type, 'comments')) {
                remove_post_type_support($type, 'comments');
                remove_post_type_support($type, 'trackbacks');
            }
        }
        remove_meta_box('dashboard_recent_comments', 'dashboard', 'normal');

        global $pagenow;
        
        if ($pagenow === 'edit-comments.php' || $pagenow === 'options-discussion.php') {
            wp_safe_redirect(admin_url());
            exit;
        }
    }

    /**
     * Remove comment related menu entries from backend
     *
     * @return void
     */
    public static function removeCommentsMenu()
    {
        remove_menu_page('edit-comments.php');
        remove_submenu_page( 'options-general.php', 'options-discussion.php' );
    }

    /**
     * Remove comment from admin bar
     *
     * @return void
     */
    public static function removeCommentsMenuInAdminBar()
    {
        if (is_admin_bar_showing()) {
            remove_action('admin_bar_menu', 'wp_admin_bar_comments_menu', 60);
        }
    }
}