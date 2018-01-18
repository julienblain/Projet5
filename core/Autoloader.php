<?php
namespace Core;

class Autoloader {

    static function register () {
        //register in autoload queue
        spl_autoload_register (array(__CLASS__, 'autoload')) ;
    }

    static function autoload ($class) {
        // if class doesn t be in the same namespace, we load
        if (\strpos($class, __NAMESPACE__.'\\') === 0) {

            $class= \str_replace(__NAMESPACE__. '\\', '', $class);

            $class = \str_replace('\\', '/', $class);

            require __DIR__ .'/'. $class .'.php';
        }
    }
}
