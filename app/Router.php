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
        try {
            //TODO settings list
            if(isset($_GET['p'])) {
                $get = $_GET['p'];
                try {
                    switch ($get) {
                        case "user.control":
                            $this->_routingValid();
                            break;
                        case "user.createAccount":
                            $this->_routingValid();
                            break;
                            default :
                            $this->_routingHome();
                            throw new AppException();
                    }
                }
                catch (AppException $e) {
                    echo $e->router();
                }

            }
            elseif (count($_GET) === 0) {
                $this->_routingHome();
            }
            else {
                //TODO a voir
                $this->_routingHome();
               throw new AppException();
            }
        }
        catch (AppException $e) {
            //TODO creation de la class error write in log
            echo $e->router();
        }
    }

    private function _routingValid() {
        $page = $_GET['p'];
        $page = \explode('.', $page);
        $this->_page = $page;
    }

    private function _routingHome() {
        $page = "app.home";
        $page = \explode('.', $page);
        $this->_page = $page;
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