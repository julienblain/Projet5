<?php


namespace App\Controller;
use Core\Controller\Controller;

class DreamsController extends AppController
{
    private $_table;
    private $_idUser;
    private $_dream;
    private $_date;
    private $_hour;
    private $_elaboration;
    private $_eventsPrevious;

    public function __construct() {
        //parent gives viewPath and loadModel
        $this->_table = $this->loadModel('Dreams');
        $this->_idUser = $_SESSION['idUser'];
    }

    private function _getDream()
    {
        return $this->_dream;
    }

    private function _setDream(): void
    {
        $this->_dream = htmlspecialchars($_POST['dreamWrite']);
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
        isset($_POST['elaborationWrite']) ? $this->_elaboration = htmlspecialchars($_POST['elaborationWrite']) : $this->_elaboration  = null;
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
        isset($_POST['previousEventsWrite']) ? $this->_eventsPrevious = htmlspecialchars($_POST['previousEventsWrite']) : $this->_eventsPrevious  = null;
    }

    public function created() {
            $this->_setDream();
            $this->_setDate();
            $this->_setHour();
            $this->_setElaboration();
            $this->_setEventsPrevious();

            $this->_table->createdDream($this->_getDream(), $this->_getDate(), $this->_getHour(), $this->_getElaboration(), $this->_getEventsPrevious());

            include_once ($this->viewPath . '/notification/dreamCreated.php');
            $this->homeLogged();

    }

}