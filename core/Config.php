<?php

namespace Core;

class Config {
    private $_settings;
    private static $_instance; //bdd instance

    public function __construct(string $fileConfig)
    {
        //TODO verifier si c ok
        $this->setSettings(require($fileConfig));
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

    /**
     * call in App.php
     * @param string $fileConfig
     * @return object
     */
    public static function getInstance($fileConfig)
    {
        if(is_null(self::$_instance)) {
            self::setInstance(new Config($fileConfig));
        }
        return self::$_instance;
    }

    /**
     * @param Config $instance
     */
    public static function setInstance(Config $instance): void
    {
        self::$_instance = $instance;
    }

}