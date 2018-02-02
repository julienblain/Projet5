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
      //  echo 'page <br>';
       // var_dump($this->_page) ;
        //echo $this->_action . ' action<br>';
        //echo $this->_controller . ' controller<br>';
        //var_dump($_SESSION);
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
            if(isset($_GET['p'])) {
                //cleaning $_GET
                $get = \explode('.', $_GET['p']);
                $get = $get[0].'.'.$get[1];

                try {
                    switch ($get) {
                        case "app.logout":
                            session_destroy();
                            $this->_routingHome();
                            break;

                        case "user.control":
                            $this->_routingValid();
                            break;
                        case "user.createAccount":
                            $this->_routingValid();
                            break;
                        case "user.createdAccount":
                            $this->_routingValid();
                            break;
                        case "user.forgetPass":
                            $this->_routingValid();
                            break;
                        case "user.updateAccount":
                            $this->_routingValidLogged();
                            break;
                        case "user.updatedAccountMail":
                            $this->_routingValidLogged();
                            break;
                        case "user.updatedAccountPassword":
                            $this->_routingValidLogged();
                            break;
                        case "user.homeLogged":
                            $this->_routingValidLogged();
                            break;
                        case "user.deletedAccount";
                            $this->_routingValidLogged();
                            break;

                        case "dreams.created":
                            $this->_routingValidLogged();
                            break;
                        case "dreams.indexDreams":
                            $this->_routingValidLogged();
                            break;
                        case "dreams.read":
                            $this->_routingValidLogged();
                            break;
                        case "dreams.update":
                            $this->_routingValidLogged();
                            break;
                        case "dreams.updated":
                            $this->_routingValidLogged();
                            break;
                        case "dreams.delete":
                            $this->_routingValidLogged();
                            break;
                        case "dreams.search":
                            $this->_routingValidLogged();
                            break;

                        default :
                            throw new AppException();
                    }
                }
                catch (AppException $e) {
                    echo $e->router();
                    $this->_routingHome();
                }
            }
            elseif (count($_GET) === 0) {
                $this->_routingHome();
            }
            else {
               throw new AppException();
            }
        }
        catch (AppException $e) {
            echo $e->router();
            $this->_routingHome();
        }
    }

    private function _routingValid() {
        $page = $_GET['p'];
        $page = \explode('.', $page);
        $this->_page = $page;
    }

    private function _routingValidLogged() {
        isset($_SESSION['idUser']) ? $this->_routingValid() : $this->_routingHome();

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


    public function getController()
    {
        return $this->_controller;
    }


    public function setController()
    {
        if(($this->_page[0] == 'user') || ($this->_page[0] == 'app')) {
            $this->_controller = '\App\Controller\\' . ucfirst($this->_page[0]) . 'Controller';
        }
        else {
            $this->_controller = '\App\Controller\Elasticsearch\\' . ucfirst($this->_page[0]) . 'Controller';
        }
    }

}