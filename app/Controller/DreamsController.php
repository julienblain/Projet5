<?php


namespace App\Controller;

use Core\Controller\Controller;


class DreamsController extends AppController
{
    private $_table;

    private $_dream;
    private $_date;
    private $_hour;
    private $_elaboration;
    private $_eventsPrevious;
    private $_idDream;

    public function __construct() {
        //parent gives viewPath and loadModel
        $this->_table = $this->loadModel('Dreams');


    }

    private function _getDream()
    {
        return $this->_dream;
    }

    private function _setDream(): void
    {
        $this->_dream = htmlspecialchars($_POST['dream']);
    }

    private function _getDate()
    {
        return $this->_date;
    }

    private function _setDate(): void
    {
        isset($_POST['dreamDate']) ? $this->_date = htmlspecialchars($_POST['dreamDate']) : $this->_date = null;
    }

    private function _getHour()
    {
        return $this->_hour;
    }

    private function _setHour()
    {
        isset($_POST['dreamHour']) ? $this->_hour = htmlspecialchars($_POST['dreamHour']) : $this->_hour = null;
    }

    /**
     * @return mixed
     */
    private function _getElaboration()
    {
        return $this->_elaboration;
    }


    private function _setElaboration()
    {
        isset($_POST['elaboration']) ? $this->_elaboration = htmlspecialchars($_POST['elaboration']) : $this->_elaboration  = null;
    }

    /**
     * @return mixed
     */
    private function _getEventsPrevious()
    {
        return $this->_eventsPrevious;
    }

    private function _setEventsPrevious()
    {
        isset($_POST['previousEvents']) ? $this->_eventsPrevious = htmlspecialchars($_POST['previousEvents']) : $this->_eventsPrevious  = null;
    }

    private function _setIdDream() {
        $params = $_GET['p'];
        $params = \explode('.', $params);
        $this->_idDream = $params[2];
    }

    private function _getIdDream() {
        return $this->_idDream;
    }

    public function created() {
            $this->_setDream();
            $this->_setDate();
            $this->_setHour();
            $this->_setElaboration();
            $this->_setEventsPrevious();

            //insert in mysql bddd
            $this->_table->createdDream($this->_getDream(), $this->_getDate(), $this->_getHour(), $this->_getElaboration(), $this->_getEventsPrevious());

            //insert in elastic bdd
            $dream = $this->_table->lastDream($_SESSION['idUser']);

            $elastic = new \App\Controller\Elasticsearch\DreamsController;
            $elastic->indexing($dream);




            include_once ($this->viewPath . '/notification/dreamCreated.php');
            $this->homeLogged();

    }

    public function indexDreams()
    {
        $idUser = $_SESSION['idUser'];
        $dreams = $this->_table->dreamsByIdUser($idUser);
        //put in session
        $this->_listDreams($dreams);

        if(empty($dreams)) {
            include_once ($this->viewPath . '/notification/emptyIndex.php');
            $this->homeLogged();
        } else {
            $this->render('dreams.indexDreams', compact('dreams'));
        }

    }

    public function read() {
        $this->_setIdDream();
        $dream = $this->_table->readDream($this->_getIdDream());
        $dream = $this->_previousAndNextDream($dream);
       $this->render('dreams.readDream', compact('dream'));

    }

    private function _previousAndNextDream($dream) {
        // we recover the previous dream id and the next dream id for the buttons in view
        $idDream = $this->_getIdDream();
        $listDreams = $_SESSION['listDreams'];
        $countListDreams = count($listDreams) -1;

        if($idDream !== $listDreams[0]) {
            $key = array_keys($listDreams, $idDream);

            $keyPrevious = $key[0] -1;
            $dream['previousDream'] = $listDreams[$keyPrevious];
        }
        else {
            $dream['previousDream'] = 'notExist';
        }

        if($idDream != $listDreams[$countListDreams]) {
            $key = array_keys($listDreams, $idDream);
            $keyNext = $key[0] + 1;
            $dream['nextDream'] = $listDreams[$keyNext];
        }
        else {
            $dream['nextDream'] = 'notExist';
        }

        return $dream;
    }

    public function update() {
        $this->_setIdDream();
        $dream = $this->_table->readDream($this->_getIdDream());
        $dream = $this->_previousAndNextDream($dream);
        $this->render('dreams.updateDream', compact('dream'));
    }

    public function updated() {
        $this->_setIdDream();
        $this->_checkUser();

        // giving value of $_Post
        $this->_setDream();
        $this->_setDate();
        $this->_setHour();
        $this->_setElaboration();
        $this->_setEventsPrevious();

        $this->_table->updatedDream($this->_getIdDream(), $this->_getDream(), $this->_getDate(), $this->_getHour(), $this->_getElaboration(), $this->_getEventsPrevious());

        $elastic = new \App\Controller\Elasticsearch\DreamsController;
        //$elastic->indexing($dream);

        include_once ($this->viewPath . 'notification/updatedDream.php');
        $this->indexDreams();
    }

    // check if the dream is at it
    private function _checkUser() {
        if(in_array($this->_idDream, $_SESSION['listDreams'], true)) {
           return true;
        } else {
            include_once ($this->viewPath . 'errors/forbiddenPage.php');
            $this->indexDreams();
            die();
        }

    }

    public function delete() {
        $this->_setIdDream();
        $this->_checkUser();

        $this->_table->deleteDream($this->_getIdDream());
        echo 'ici';
        $elastic = new \App\Controller\Elasticsearch\DreamsController;
        $elastic->deleting($this->_getIdDream());

        include_once ($this->viewPath . 'notification/deletedDream.php');
        $this->indexDreams();
    }


    private function _listDreams($datas) :void {

        if(isset($_SESSION['listDreams'])) {
            unset($_SESSION['listDreams']);
        }

        $_SESSION['listDreams'] = [];
        //listIdDreams = []
        for($i = 0 ; $i < count($datas); $i++) {
            $_SESSION['listDreams'][$i] = $datas[$i]->idDreams;
        }
    }





}