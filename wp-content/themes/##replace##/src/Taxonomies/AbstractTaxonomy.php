<?php

namespace Staempfli\Taxonomies;

abstract class AbstractTaxonomy
{
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

    public function register()
    {
        $args = $this->getArgs();
        $args['labels'] = $this->getLabels();
        register_taxonomy($this->getTaxonomy(), $this->getPosttypes(), $args);
    }

}