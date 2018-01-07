<?php
namespace App;

final class Router {

    private $_page;
    private $_action;
    private $_controller;


    public function __construct()
    {
        $this->setPage();
        $this->setAction();
        $this->setController();
        echo 'page <br>';
        var_dump($this->_page) ;
        echo $this->_action . ' action<br>';
        echo $this->_controller . ' controller<br>';

       $controller = $this->getController();
       $controller = new $controller;
       $action = $this->getAction();

       return $controller->$action() ;


    }

    public function getPage() : array
    {
        return $this->_page;
    }

    public function setPage()
    {
        //TODO settings list
        if(isset($_GET['p'])) {
            $page = $_GET['p'];
            $page = \explode('.', $page);
            $this->_page = $page;

        }
        else {
            $page = "app.home";
            $page = \explode('.', $page);
            $this->_page = $page;
        }
    }

    public function getAction() : string
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
    public function getController() : string
    {
        return $this->_controller;
    }


    public function setController()
    {
        $this->_controller = '\App\Controller\\' . ucfirst($this->_page[0]) . 'Controller';
    }



}