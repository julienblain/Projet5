<?php


namespace App\Controller;

use \App;
use Core\Controller\Controller;

class AppController extends Controller
{
    //utiliser dans controller.php
    protected $template = 'default';
    protected $viewPath =  ROOT . '/app/Views/';

   /* public function __construct()
    {
        //delimiter dans controller.php
        $this->viewPath = ROOT . '/app/Views/';
    }*/

    //give the model to load
    protected function loadModel(string $modelName) {
        $className = '\\App\\Table\\' . ucfirst($modelName) . 'Table';
        return new $className();
    }

    //home page app
    public function home() {

        $this->render('home.home');
    }
}