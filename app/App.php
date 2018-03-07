<?php

use App\Router;


final class App
{
    private static $_instance;


    private function _autoload()
    {
        require ROOT . '/app/Autoloader.php';
        App\Autoloader::register();
        require ROOT . '/core/Autoloader.php';
        Core\Autoloader::register();
        require ROOT . '/vendor/Composer/vendor/autoload.php';
    }

    private function _router()
    {
        new Router();
    }

    //singleton
    public static function getInstance()
    {
        if (self::$_instance === null) {
            self::$_instance = new App();

            //start the session if it is not started automatically by the server
            if (!isset($_SESSION)) {
                session_start();
            }

            self::$_instance->_autoload();
            self::$_instance->_router();
        }
        return self::$_instance;
    }
}
