<?php
namespace App;
use Core\Database\MysqlDatabase;
class Router {

    private $_page;
    private $_action;
    private $_controller;

    public function __construct()
    {
       $this->setPage();
       $this->setAction();
       $this->setController();
       var_dump($this->_page) . 'page<br>';
       echo $this->_action . 'action<br>';
       echo $this->_controller . 'controller<br>';

    }

    /**
     * @return string
     */
    public function getPage()
    {
        return $this->_page;
    }

    public function setPage()
    {
        if(isset($_GET['p'])) {
            $page = $_GET['p'];
            $page = \explode('.', $page);
            $this->_page = $page;
            return $this->_page;
        }
        $page = "user.connection";
        $page = \explode('.', $page);
        $this->_page = $page;
        return $this->_page;
    }

    /**
     * @return string
     */
    public function getAction()
    {
        return $this->_action;
    }


    public function setAction()
    {
        $this->_action = $this->_page[1];
    }

    /**
     * @return string
     */
    public function getController()
    {
        return $this->_controller;
    }


    public function setController()
    {
        $this->_controller = '\App\Controller\\' . ucfirst($this->_page[0]) . 'Controller';
    }



}