<?php

namespace Staempfli\Posttypes;

use Staempfli\Theme;

abstract class AbstractPosttype
{
    /**
     * Get the labels for registering a posttype
     */
    public abstract function getLabels();

    /**
     * Get the arguments for registering a posttype
     *
     * @return array
     */
    public abstract function getArgs();

    /**
     * Get the posttype for registering a posttype
     *
     * @return string
     */
    public abstract function getPosttype();

    /**
     * Registers the posttype "Product Reservation"
     */
    public function register()
    {
        $args['labels'] = $this->getLabels();
        register_post_type($this->getPosttype(), $args);
    }

    /**
     * Get all posts of the specific posttype
     *
     * @return array
     */
    public function getAll()
    {
        $args = [
            'post_type'      => $this->getPosttype(),
            'posts_per_page' => -1,
        ];
        return get_posts($args);
    }

    /**
     * Get all posts of the specific posttype by category
     * 
     * @param int|string $category ID or slug of the category
     * @return array
     */
    public function getByCategory($category)
    {
        $args = [
            'post_type'      => $this->getPosttype(),
            'posts_per_page' => -1,
        ];

        if (is_numeric($category)) {
            $args['cat'] = $category;
        } else {
            $args['category_name'] = $category;
        }
        return get_posts($args);
    }
}