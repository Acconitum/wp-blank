<?php

namespace Staempfli\Options;

/**
 * All needed functionality to remove gutenberg editor from WordPress completly
 * 
 * This happens in favor of using ACF Pro the old fashion
 */
class DisableGutenberg
{
    /**
     * Add actions and hooks to WordPress core
     */
    public static function addActions()
    {
        add_action( 'wp_enqueue_scripts', __CLASS__ . '::removeStyles');

        add_filter( 'use_block_editor_for_post', '__return_false' );
        add_filter( 'use_widgets_block_editor', '__return_false' );
    }

    /**
     * Remove stylesheets for gutenberg
     */
    public static function removeStyles()
    {
        wp_dequeue_style( 'wp-block-library' );
        wp_dequeue_style( 'wp-block-library-theme' );
        wp_dequeue_style( 'global-styles' );
        wp_dequeue_style( 'classic-theme-styles' );
    }
}
