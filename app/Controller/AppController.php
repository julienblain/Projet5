<?php


namespace App\Controller;

use \App;
use Core\Controller\Controller;

class AppController
{
    //give the model to load
    protected function loadModel(string $modelName) {
        $this->$modelName = App::getInstance()->getTable($modelName);
    }
}