<?php


namespace App\Controller;

use \App;
use Core\Controller\Controller;
use App\AppException;

class AppController extends Controller
{
    //utiliser dans controller.php
    protected $template = 'default';
    protected $viewPath =  ROOT . '/app/Views/';
    private $_keyPrivate;



    //give the model to load
    protected function loadModel(string $modelName) {
        $className = '\\App\\Entity\\' . $modelName . 'Entity';
        return new $className();
    }

    //home page app
    public function home() {

        $this->render('home.home');
    }

    public function homeLogged() {
        //$navLogged = $this->navLogged();
        $this->render('dreams.homeLogged');
    }


    protected function recaptcha() {
        try {
            if($this->_keyPrivate === null) {
                $config = require(ROOT . '/config/recaptcha.php');
                $this->_keyPrivate = $config['keyPrivate'];
            }
            $secret = $this->_keyPrivate;
            $remoteip = $_SERVER['REMOTE_ADDR'];
            $response = $_POST['g-recaptcha-response'];

            $api_url = "https://www.google.com/recaptcha/api/siteverify?secret="
                . $secret . "&response=" . $response . "&remoteip" . $remoteip;

            $decode = json_decode(file_get_contents($api_url), true);

            if($decode['success'] == true) {
                return true;
            }
            else {
                throw new AppException();
            }
        }
        catch(AppException $ex) {
            $ex->recaptcha();
            $this->home();
            die();
        }
    }
}