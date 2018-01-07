<?php

namespace Core;

class Config {
    private $_settings;

    public function __construct()
    {
        //TODO verifier si c ok
        $this->setSettings(require(ROOT . '/config/config.php'));
    }

    /**
     * @param string $key
     * @return string
     */
    public function getSettings($key)
    {
        return $this->_settings[$key];
    }

    /**
     * @param array $settings
     */
    //TODO Question void ?
    public function setSettings(Array $settings): void
    {
        $this->_settings = $settings;
    }



}