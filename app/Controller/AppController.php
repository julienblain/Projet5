<?php


namespace App\Controller;

use \App;
use Core\Controller\Controller;
class AppController
{
    //give the model to load
    protected function loadModel($modelName) {
        $this->$modelName = App::getInstance()->getTable($modelName);
    }
}