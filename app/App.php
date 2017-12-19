<?php
use Core\Config;
use Core\Database\MysqlDatabase;
use App\Router;


class App
{
    private static $_instance;
    private $_dbInstance;

    public function router() {
        $route = new Router();
        $getController = $route->getController();
        $action = $route->getAction();
        $controller = new $getController();
        return $controller->$action();
    }

    public function load() {
        require ROOT . '/app/Autoloader.php';
        App\Autoloader::register();
        require ROOT . '/core/Autoloader.php';
        Core\Autoloader::register();
    }

    //singleton

    /**
     * @return App
     */
    public static function getInstance() : App {
        if(self::$_instance === null) {
            self::$_instance = new App();
        }
        return self::$_instance;
    }

    /**
     * @return MysqlDatabase
     */
    public function getDb() : MysqlDatabase {
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

    //TODO question ça me return  une methode?
    /**
     * @param string $modelName
     * @return
     */
    public function getTable(string $modelName) {
        $tableName = '\\App\\Table\\' . ucfirst($modelName) . 'Table';
        return new $tableName($this->getDb());
    }
}