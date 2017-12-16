<?php


namespace App\Controller;
use Core\Controller\Controller;

class DreamsController extends AppController
{
    public function __construct() {
        //parent gives viewPath and loadModel

        //TODO a faire la vue
       // parent::__construct();
        $this->loadModel('Dreams');
    }

    public function dreamsAll() {
        $test = $this->Dreams->queryTest();
        var_dump($test);
    }
}