<?php

namespace Staempfli;

use Staempfli\Options\DisableComments;
use Staempfli\Options\DisableGutenberg;
use Staempfli\Posttypes\AbstractPosttype;
use Staempfli\Posttypes\CustomPosttype;

class Theme
{
    /**
     * The theme text domain
     */
    const TEXT_DOMAIN = '##replace##';

    /**
     * Custom Posttype classes which extends AbstractPosttype
     * 
     * Example:
     * Staempfli\Posttypes\CustomPosttype
     */
    const POST_TYPES = [
        CustomPosttype::class
    ];

    /**
     * Holder for registered posttype for easy access over Theme::getPosttype('name')
     */
    static $RegisteredPosttypes = [];

    /**
     * Add actions and hooks to WordPress core
     * 
     * Initialize additional functionality and their
     * actions and hooks
     */
    public static function addActions()
    {
        add_action('wp_enqueue_scripts', __CLASS__ . '::addStyleSheet');
        add_action('after_setup_theme', __CLASS__ . '::addThemeSupport');
        add_action('widgets_init', __CLASS__ . '::addWidgets');
        add_action('init', __CLASS__ . '::removeBackendEditor');
        add_action('init', __CLASS__ . '::registerPosttypes');


        DisableComments::addActions(); // Comment out if you like to enable comments
        DisableGutenberg::addActions(); // Comment out if you like to use the gutenber editor
    }

    /**
     * Registers all custom posttypes from POST_TYPES constant
     * and insert them into the static $RegisteredPosttypes array
     */
    public static function registerPosttypes()
    {
        foreach(self::POST_TYPES as $posttypeClass) {

            $posttype = new $posttypeClass();
            $posttype->register();
            self::$RegisteredPosttypes[$posttype->getPosttype()] = $posttype;
        }
    }

    /**
     * Get registered posttype
     *
     * @param string $name posttype name
     * @return AbstractPosttype|bool
     */
    public static function getPosttype($name)
    {
        return self::$RegisteredPosttypes[$name] ?? false;
    }

    /**
     * Add themesupports
     */
    public static function addThemeSupport()
    {
	    add_theme_support('title-tag');
        add_theme_support('post-thumbnails');
        add_theme_support('customize-selective-refresh-widgets');
    }

    /**
     * Add Sidebar widget
     */
    public static function addWidgets()
    {
        register_sidebar(
            [   'name'          => esc_html__( 'Sidebar', 'test' ),
                'id'            => 'sidebar-1',
                'description'   => esc_html__( 'Add widgets here.', 'test' ),
                'before_widget' => '<section id="%1$s" class="widget %2$s">',
                'after_widget'  => '</section>',
                'before_title'  => '<h2 class="widget-title">',
                'after_title'   => '</h2>',
            ]
        );
    }

    /**
     * Remove plugin and theme editor from within 
     * the backend
     */
    public static function removeBackendEditor()
    {
        if (!defined('DISALLOW_FILE_EDIT')) {
            define('DISALLOW_FILE_EDIT', true);
        }
    }

    /**
     * Add stylesheets
     */
    public static function addStyleSheet()
    {
        $theme = wp_get_theme();
        wp_enqueue_style('style', get_stylesheet_directory_uri() . '/assets/dist/app.css', [], $theme->get('Version'));
    }

    /**
     * Includes given template with arguments used inside the template
     * 
     * This method will create named parameter so you do not have to
     * use $args['whatever'] inside the template but $whatever instead
     *
     * @param string $name
     * @param array $args
     */
    public static function includeTemplate($name, $args = [])
    {
        foreach($args as $key => $value) {
            ${$key} = $value;
        }
        include get_stylesheet_directory() . '/views/' . $name . '.php';
    }
}