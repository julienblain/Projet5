<?php
use Core\Config;
use Core\Database\MysqlDatabase;
use App\Router;


class App
{
    private static $_instance;
    private $_dbInstance;

    public function router() {
        new Router();
    }

    public function load() {
        require ROOT . '/app/Autoloader.php';
        App\Autoloader::register();
        require ROOT . '/core/Autoloader.php';
        Core\Autoloader::register();
    }

    //singleton
    public static function getInstance() {
        if(self::$_instance === null) {
            self::$_instance = new App();
        }
        return self::$_instance;
    }

    public function getDb() {
        $config = Config::getInstance(ROOT . '/config/config.php');

        if($this->_dbInstance === null) {
            $this->_dbInstance = new MysqlDatabase(
                $config->getSettings('db_name'),
                $config->getSettings('db_user'),
                $config->getSettings('db_pass'),
                $config->getSettings('db_host')
            );
        }

        return $this->_dbInstance;
    }

    //Factory
    public function getTable($modelName) {
        $className = '\\App\\Table\\' . ucfirst($modelName) . 'Table';
        return new $className($this->getDb());
    }
}