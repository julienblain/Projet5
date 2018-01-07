<?php

use App\Router;

//TODO question class Final ?
final class App
{
    private static $_instance;  // (App) content App

    //singleton
    public static function getInstance(): App
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


    private function _autoload(): void
    {
        require ROOT . '/app/Autoloader.php';
        App\Autoloader::register();
        require ROOT . '/core/Autoloader.php';
        Core\Autoloader::register();
    }


    private function _router()
    {
         new Router();
    }

}