<?php

namespace App\Controller;

use \App;
use Core\Controller\Controller;
use App\AppException;


class AppController extends Controller
{
    protected $template = 'default';
    protected $viewPath = ROOT . '/app/Views/';
    private $_keyPrivate; // recaptcha key


    public function __construct()
    {
        // include headHtml
        // result search are dynamically included in the page
        if ((isset($_GET['p']) && ($_GET['p'] !== 'dreams.search'))) {
            if ($_GET['p'] !== 'dreams.countSearch') {
                include_once(ROOT . '/app/Views/templates/headHtml.php');
            }
        } elseif (!isset($_GET['p'])) {
            include_once(ROOT . '/app/Views/templates/headHtml.php');
        }
    }

    //give the model to load
    protected function loadModel(string $modelName)
    {
        $className = '\\App\\Entity\\' . $modelName . 'Entity';
        return new $className();
    }

    protected function recaptcha()
    {
        try {
            if ($this->_keyPrivate === null) {
                $config = require(ROOT . '/config/recaptcha.php');
                $this->_keyPrivate = $config['keyPrivate'];
            }

            $secret = $this->_keyPrivate;
            $remoteip = $_SERVER['REMOTE_ADDR'];
            $response = $_POST['g-recaptcha-response'];

            $api_url = "https://www.google.com/recaptcha/api/siteverify?secret="
                . $secret . "&response=" . $response . "&remoteip" . $remoteip;

            $decode = json_decode(file_get_contents($api_url), true);

            if ($decode['success'] == true) {
                return true;
            } else {
                throw new AppException();
            }
        } catch (AppException $ex) {
            $ex->recaptcha();
            $this->home();
            die();
        }
    }


    public function home()
    {
        $this->render('home.home');
    }

    public function homeLogged()
    {
        $this->render('dreams.homeLogged');
    }

    public function legalNotice()
    {
        $this->render('templates.legalNotice');
    }
}
