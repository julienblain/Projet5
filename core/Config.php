<?php

namespace Core;


class Config {

    private $_settings;


    public function __construct()
    {
        if($this->_settings === null) {
            $this->setSettings(require(ROOT . '/config/config.php'));
        }
    }

    private function setSettings(Array $settings)
    {
        $this->_settings = $settings;
    }

    //get settings in config folder
    public function getSettings($key)
    {
        return $this->_settings[$key];
    }





}