<?php

namespace app;

use Pimple\Container;

/**
 * Class responsible for managing basic configurations
 *
 * @author Lucas Lima <lucasdevelopmaster@gmail.com>
 */
class App
{
    /**
     * basic configurations
     *
     * @var array
     */
    private $settings;

    /**
     * Depedency injection
     *
     * @var Pimple\Container;
     */
    private $container;

    public function __construct($settings = [])
    {
        if (!empty($settings)) {
            $this->setSettings($settings);
        }

        if (is_array($this->getSettings())) {
            $this->container = new Container($this->getSettings());
        }
    }

    /**
     * Get the value of settings
     */
    public function getSettings()
    {
        return $this->settings;
    }

    /**
     * Set the value of settings
     *
     * @return  self
     */
    public function setSettings($settings)
    {
        $this->settings = $settings;

        return $this;
    }

    /**
     * Get depedency injection
     *
     * @return  Pimple\Container;
     */
    public function getContainer()
    {
        return $this->container;
    }
}
