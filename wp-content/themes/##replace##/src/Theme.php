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