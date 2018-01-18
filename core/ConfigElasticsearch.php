<?php
/**
 * Created by IntelliJ IDEA.
 * User: root
 * Date: 18/01/18
 * Time: 18:01
 */

namespace Core;


class ConfigElasticsearch
{
    private $_settings;

    public function __construct()
    {
        if($this->_settings === null) {
            $this->setSettings(require(ROOT . '/config/configElasticsearch.php'));
        }

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

    private function setSettings(Array $settings)
    {
        $this->_settings = $settings;
    }
}