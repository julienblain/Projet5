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

    public function indexDreams()
    {

        $dreams = $this->_table->dreamsByIdUser($_SESSION['idUser']);

        // dreams datas treatment
        $dreamsYears = [];
        foreach ($dreams as $dream)
        {
            $dateTime = \DateTime::createFromFormat('Y-m-d', $dream->dateDreams);
            $year = $dateTime->format('Y');
            $month = $dateTime->format('m');

            // we push the key year[] in the dreamsYears[], and after we push the key month[] in year[]
            if (!array_key_exists($year, $dreamsYears))
            {
                $dreamsYears[$year] = [];
                if (!array_key_exists($month, $dreamsYears[$year]))
                {
                    $dreamsYears[$year][$month] = [];
                    $dreamsYears[$year][$month][] = $dream;
                }
                else {
                    $dreamsYears[$year][$month][] = $dream;
                }
            }
            else {
                if (!array_key_exists($month, $dreamsYears[$year]))
                {
                    $dreamsYears[$year][$month] = [];
                    $dreamsYears[$year][$month][] = $dream;
                }
                else {
                    $dreamsYears[$year][$month][] = $dream;
                }
            }
        }

        $this->render('dreams.indexDreams', compact('dreamsYears'));
    }

    public function read() {
        $idDream = explode('.', $_GET['p']);
        $dream = $this->_table->readDream($idDream[2]);
        $dateTime = $this->_dateTimeFr($dream);
       $this->render('dreams.readDream', compact('dream', 'dateTime'));

    }

    public function update() {
        $idDream = explode('.', $_GET['p']);
        $dream = $this->_table->readDream($idDream[2]);
        $dateTime = $this->_dateTimeFr($dream);
        $this->render('dreams.updateDream', compact('dream', 'dateTime'));
    }

    private function _dateTimeFr($datas) {

        $date = new \DateTime($datas[0]->dateDreams);
        $dateFr = new \IntlDateFormatter('fr_FR', \IntlDateFormatter::FULL, \IntlDateFormatter::NONE);
        $dateTime[] = $dateFr->format($date);

        $time = $datas[0]->hourDreams;
        $hour = $time[0] . $time[1];
        $min = $time[3] . $time[4];

        if(($hour === "00") || ($hour === '01')) {
            $time = $time[0] . $time[1] . ' heure ' . $time[3] . $time[4] . ' minutes ';
        }
        else {
            $time = $time[0] . $time[1] . ' heures ' . $time[3] . $time[4]. ' minutes ';
        }

        if(($min === '00') || ($min === '01')) {
            $time = str_replace('minutes', 'minute', $time);
        }

        $dateTime[] = $time;

       return $dateTime;

    }
}