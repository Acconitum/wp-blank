<?php

namespace Staempfli;

class Theme
{
    const TEXT_DOMAIN = '##replace##';

    /**
     * Add actions and hooks to WordPress core
     * 
     * Initialize additional functionality and their
     * actions and hooks
     *
     * @static
     * @return void
     */
    public static function addActions()
    {
        add_action('wp_enqueue_scripts', __CLASS__ . '::addStyleSheet');
        add_action('after_setup_theme', __CLASS__ . '::addThemeSupport');
        add_action('widgets_init', __CLASS__ . '::addWidgets');
        add_action('init', __CLASS__ . '::removeBackendEditor');


        Comments::addActions(); // Comment out if you like to enable comments
    }

    public static function addThemeSupport()
    {
	    add_theme_support('title-tag');
        add_theme_support('post-thumbnails');
        add_theme_support('customize-selective-refresh-widgets');
    }

    public static function addWidgets()
    {
        register_sidebar(
            ['name'             => esc_html__( 'Sidebar', 'test' ),
                'id'            => 'sidebar-1',
                'description'   => esc_html__( 'Add widgets here.', 'test' ),
                'before_widget' => '<section id="%1$s" class="widget %2$s">',
                'after_widget'  => '</section>',
                'before_title'  => '<h2 class="widget-title">',
                'after_title'   => '</h2>',
            ]
        );
    }

    public static function removeBackendEditor()
    {
        if (!defined('DISALLOW_FILE_EDIT')) {
            define('DISALLOW_FILE_EDIT', true);
        }
    }

    /**
     * Add stylesheets from parent theme and child-theme
     *
     * @static
     * @return void
     */
    public static function addStyleSheet()
    {
        $theme = wp_get_theme();
        wp_enqueue_style('style', get_stylesheet_directory_uri() . '/dist/app.css', [], $theme->get('Version'));
    }

    /**
     * Includes given template with arguments used inside the template
     * 
     * This method will create named parameter so you do not have to
     * use $args['whatever'] inside the template but $whatever instead
     *
     * @param string $name
     * @param array $args
     * @return void
     */
    public static function includeTemplate($name, $args = [])
    {
        foreach($args as $key => $value) {
            ${$key} = $value;
        }
        include get_stylesheet_directory() . '/views/' . $name . '.php';
    }
}