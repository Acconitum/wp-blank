<?php

namespace Staempfli\Posttypes;

use Staempfli\Theme;

/**
 * This class is used as an Example
 * 
 * If you like to use it, remname it and adapt the labels
 * as you need.
 */
class CustomPosttype extends AbstractPosttype
{
    /**
     * Get the labels for registering a posttype
     */
    public  function getLabels()
    {
        return [
            'name'               => _x('Custom Posttypes', 'Post Type General Name', Theme::TEXT_DOMAIN),
            'singular_name'      => _x('Custom Posttype', 'Post Type Singular Name', Theme::TEXT_DOMAIN),
            'menu_name'          => __('Custom Posttypes', Theme::TEXT_DOMAIN),
            'parent_item_colon'  => __('Parent Custom Posttyüe:', Theme::TEXT_DOMAIN),
            'all_items'          => __('Custom Posttypes', Theme::TEXT_DOMAIN),
            'view_item'          => __('View Custom Posttype', Theme::TEXT_DOMAIN),
            'add_new_item'       => __('Add New Custom Posttype', Theme::TEXT_DOMAIN),
            'add_new'            => __('Add New', Theme::TEXT_DOMAIN),
            'edit_item'          => __('Edit Custom Posttype', Theme::TEXT_DOMAIN),
            'update_item'        => __('Update Custom Posttype', Theme::TEXT_DOMAIN),
            'search_items'       => __('Search Custom Posttypes', Theme::TEXT_DOMAIN),
            'not_found'          => __('Not found', Theme::TEXT_DOMAIN),
            'not_found_in_trash' => __('Not found in Trash', Theme::TEXT_DOMAIN),
        ];
        
    }

    /**
     * Get the arguments for registering a posttype
     * 
     * You do not have to add the "labels" as this
     * is handled in the AbstractPosttype class
     *
     * @return array
     */
    public function getArgs()
    {
        return [
            'description'         => 'Cutsom posttype', // Description
            'supports'            => ['title', 'editor', 'author', 'thumbnail', 'excerpt'],
            'taxonomies'          => [], // Allowed taxonomies
            'hierarchical'        => false,         // Allows hierarchical categorization, if set to false, the Custom Post Type will behave like Post, else it will behave like Page
            'public'              => true,          // Makes the post type public
            'show_ui'             => true,          // Displays an interface for this post type
            'show_in_menu'        => true,          // Displays in the Admin Menu (the left panel)
            'show_in_nav_menus'   => true,          // Displays in Appearance -> Menus
            'show_in_admin_bar'   => false,         // Displays in the black admin bar
            'menu_position'       => 5,             // The position number in the left menu
            'menu_icon'           => 'carrot',      // The URL for the icon used for this post type
            'can_export'          => true,          // Allows content export using Tools -> Export
            'has_archive'         => true,          // Enables post type archive (by month, date, or year)
            'exclude_from_search' => false,         // Excludes posts of this type in the front-end search result page if set to true, include them if set to false
            'publicly_queryable'  => true,          // Allows queries to be performed on the front-end part if set to true
            'rewrite'             => true,          // Allows override for example the slug
            'capability_type'     => 'post',        // Allows read, edit, delete like “Post”
            'map_meta_cap'        => true,          // Needed for capability_type to work
        ];
        
    }

    /**
     * Get the posttype for registering a posttype
     *
     * @return string
     */
    public  function getPosttype()
    {
        return 'custom_posttype';
    }

}