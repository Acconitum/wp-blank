<?php

namespace Staempfli;

use Staempfli\Options\DisableComments;
use Staempfli\Options\DisableGutenberg;
use Staempfli\Posttypes\AbstractPosttype;
use Staempfli\Posttypes\CustomPosttype;
use Staempfli\Taxonomies\CustomTaxonomy;

class Theme
{
    /**
     * The theme text domain
     */
    const TEXT_DOMAIN = '##replace##';

    const OPTIONS = [
        DisableComments::class,
        DisableGutenberg::class,
    ];

    /**
     * Custom Posttype classes which extends AbstractPosttype
     * 
     * Example:
     * Staempfli\Posttypes\CustomPosttype
     */
    const POSTTYPES = [
        CustomPosttype::class
    ];

    /**
     * Custom taxonomy classes which extends AbstractTaxonomy
     * 
     * Example:
     * Staempfli\Taxonomies\CustomTaxonomy
     */
    const TAXONOMIES = [
        CustomTaxonomy::class
    ];

    /**
     * Holder for registered posttype for easy access over Theme::getPosttype('name')
     */
    static $RegisteredPosttypes = [];

    /**
     * Holder for registered taxonomies for easy access over Theme::getTaxonomy('name')
     */
    static $RegisteredTaxonomies = [];

    /**
     * Add actions and hooks to WordPress core
     * 
     * Initialize additional functionality and their
     * actions and hooks
     */
    public static function addActions()
    {
        add_action('wp_enqueue_scripts', __CLASS__ . '::addStyleSheet');
        add_action('wp_enqueue_scripts', __CLASS__ . '::addScripts');
        add_action('after_setup_theme', __CLASS__ . '::addThemeSupport');
        add_action('widgets_init', __CLASS__ . '::addWidgets');
        add_action('init', __CLASS__ . '::removeBackendEditor');
        add_action('init', __CLASS__ . '::registerPosttypes');
        add_action('init', __CLASS__ . '::registerTaxonomies');

        self::handleOptions();
    }

    /**
     * Handles Option classes
     */
    public static function handleOptions()
    {
        foreach(self::OPTIONS as $optionClass) {
            $optionClass::addActions();
        }
    }

    /**
     * Registers all custom posttypes from POSTTYPES constant
     * and insert them into the static $RegisteredPosttypes array
     */
    public static function registerPosttypes()
    {
        foreach(self::POSTTYPES as $posttypeClass) {

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
     * Registers all custom taxonomies from POST_TAXONOMIES constant
     * and insert them into the static $RegisteredTaxonomies array
     */
    public static function registerTaxonomies()
    {
        foreach(self::TAXONOMIES as $taxonomyClass) {

            $taxonomy = new $taxonomyClass();
            $taxonomy->register();
            self::$RegisteredTaxonomies[$taxonomy->getTaxonomy()] = $taxonomy;
        }
    }

    /**
     * Get registered taxonomy
     *
     * @param string $name taxonomy name
     * @return AbstractTaxonomy|bool
     */
    public static function getTaxonomy($name)
    {
        return self::$RegisteredTaxonomies[$name] ?? false;
    }

    /**
     * Add themesupports
     */
    public static function addThemeSupport()
    {
	    add_theme_support('title-tag');
        add_theme_support('post-thumbnails');
        add_theme_support('customize-selective-refresh-widgets');
        add_theme_support(
            'html5',
            [
                'search-form',
                'comment-form',
                'comment-list',
                'gallery',
                'caption',
                'style',
                'script',
            ]
        );
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
     * Add scripts
     */
    public static function addScripts()
    {
        $theme = wp_get_theme();
        wp_enqueue_script( 'scripts', get_stylesheet_directory_uri() . '/assets/dist/app.min.js', [], $theme->get('Version'), true);
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