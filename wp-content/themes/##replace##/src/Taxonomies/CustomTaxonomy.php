<?php

namespace Staempfli\Taxonomies;

use Staempfli\Theme;

/**
 * This class is used as an Example
 * 
 * If you like to use it, remname it and adapt the labels
 * as you need.
 * 
 * Don't forget to add the class to Theme::TAXONOMIES
 */
class CustomTaxonomy extends AbstractTaxonomy
{
    /**
     * Get the labels for registering a taxonomy
     */
    public function getLabels()
    {
        return  [
            'name'              => _x('Custom Taxonomy', 'taxonomy general name', Theme::TEXT_DOMAIN),
            'singular_name'     => _x('Custom Taxonomy', 'taxonomy singular name', Theme::TEXT_DOMAIN),
            'search_items'      => __('Search Custom Taxonomies', Theme::TEXT_DOMAIN),
            'all_items'         => __('All Custom Taxonomies', Theme::TEXT_DOMAIN),
            'parent_item'       => __('Parent Custom Taxonomy', Theme::TEXT_DOMAIN),
            'parent_item_colon' => __('Parent Custom Taxonomy:', Theme::TEXT_DOMAIN),
            'edit_item'         => __('Edit Custom Taxonomy', Theme::TEXT_DOMAIN),
            'update_item'       => __('Update Custom Taxonomy', Theme::TEXT_DOMAIN),
            'add_new_item'      => __('Add New Custom Taxonomy', Theme::TEXT_DOMAIN),
            'new_item_name'     => __('New Custom Taxonomy', Theme::TEXT_DOMAIN),
            'menu_name'         => __('Custom Taxonomy', Theme::TEXT_DOMAIN),
        ];
    }
  
    /**
     * Get the arguments for registering a taxonomy
     *
     * @return array
     */
    public function getArgs()
    {
        return [
            'hierarchical'      => true,
            'show_ui'           => true,
            'show_admin_column' => true,
            'query_var'         => true,
            'rewrite'           => ['slug' => 'custom-taxonomy'],
        ];
    }

    /**
     * Get the taxonomy name for registering a taxonomy
     *
     * @return string
     */
    public function getTaxonomy()
    {
        return 'custom_taxonomy';
    }

    /**
     * Get the posttypes associated with the taxonomy
     *
     * @return string
     */
    public function getPosttypes()
    {
        return ['custom_posttype'];
    }
}