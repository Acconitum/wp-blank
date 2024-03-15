<?php

namespace Staempfli\Taxonomies;

use Staempfli\Theme;

abstract class AbstractTaxonomy
{
    /**
     * If a single selection is needed change to true
     */
    const SINGLE_SELECTION = false;
    /**
     * Get the labels for registering a taxonomy
     */
    public abstract function getLabels();

    /**
     * Get the arguments for registering a taxonomy
     *
     * @return array
     */
    public abstract function getArgs();

    /**
     * Get the taxonomy name for registering a taxonomy
     *
     * @return string
     */
    public abstract function getTaxonomy();

    /**
     * Get the posttypes associated with the taxonomy
     *
     * @return string
     */
    public abstract function getPosttypes();

    /**
     * Registers the taxonomy to WordPress
     * 
     * Depending SINGLE_SELECTION constant
     * removes the default metabox and adds 
     * a callback that replaces it with a select field
     */
    public function register()
    {
        $args = $this->getArgs();
        $args['labels'] = $this->getLabels();
        if ($this->isSingleSelection()) {
            $args['show_in_quick_edit'] = false;
            $args['meta_box_cb'] = false;
            add_action('add_meta_boxes', [$this, 'addSingleSelectionMetaBox']);
            add_action('save_post', [$this, 'saveSingleSelection']);
        }
        register_taxonomy($this->getTaxonomy(), $this->getPosttypes(), $args);
    }

    /**
     * Checks if taxonomy is marked as single selection via
     * the SINGLE_SELECTION constant
     *
     * @param \WP_Post $post
     */
    public function isSingleSelection()
    {
        return get_called_class()::SINGLE_SELECTION;
    }

    /**
     * Add a single selection field to the backend
     */
    public function addSingleSelectionMetaBox(){
        add_meta_box($this->getTaxonomy() . '_metabox', $this->getLabels()['name'], [$this, 'singleSelectionMtaBoxCallback'], $this->getPosttypes() , 'side');
    }

    /**
     * Callback for the metabox to show in backend
     *
     * @param \WP_Post $post
     */
    public function singleSelectionMtaBoxCallback($post)
    {
        $currentId = get_the_terms($post->ID, $this->getTaxonomy())[0]->term_id ?? 0;
        Theme::includeTemplate('backend/single-selection-taxonomy', ['taxonomy' => $this, 'currentId' => $currentId]);
    }

    /**
     * Validates the nounce as protection from CSRF
     *
     * @return bool
     */
    public function validateNonce()
    {
        return  isset($_REQUEST[$this->getTaxonomy() . '_nonce']) 
                && wp_verify_nonce($_REQUEST[$this->getTaxonomy() . '_nonce'], $this->getTaxonomy() . '_nonce')
                && isset($_REQUEST[$this->getTaxonomy()]);
    }

    /**
     * Saves the single select value to the post
     *
     * @param int $postId
     */
    public function saveSingleSelection($postId)
    {
        if ($this->validateNonce()) {
            wp_set_object_terms($postId, (int)sanitize_text_field($_REQUEST[$this->getTaxonomy()]), $this->getTaxonomy());
        }
    }

    /**
     * Get all terms of the taxonomy
     *
     * @return array
     */
    public function getAll()
    {
        return get_terms([
            'taxonomy' => $this->getTaxonomy(),
            'hide_empty' => false 
        ]);
    }
}