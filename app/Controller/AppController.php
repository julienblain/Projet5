<?php


namespace App\Controller;

use \App;
use Core\Controller\Controller;

class AppController extends Controller
{
    //utiliser dans controller.php
    protected $template = 'default';

    public function __construct()
    {
        //delimiter dans controller.php
        $this->viewPath = ROOT . '/app/Views/';
    }

    //give the model to load
    protected function loadModel(string $modelName) {
        $this->$modelName = App::getInstance()->getTable($modelName);
    }
}