<?php

namespace App\Controller\Elasticsearch;

use App\Controller\AppController;
use App\Entity\Elasticsearch\DreamsEntity;


class DreamsController extends AppController
{
    private $_index;


    public function __construct()
    {
        parent::__construct();
        $this->_index = new DreamsEntity();
    }

    // check if the requested dream belongs to the user
    private function _checkUser()
    {
        $params = $_GET['p'];
        $params = \explode('.', $params);
        $idDream = $params[2];

        if (in_array($idDream, $_SESSION['listDreams'], true)) {
            return true;
        } else {
            include_once($this->viewPath . 'notification/error/forbiddenPage.php');
            $this->indexDreams();
            die();
        }
    }

    //time converter
    private function _dateTimeFr($dateTime)
    {
        if (gettype($dateTime) == 'object') {
            $datas[0] = (object)$dateTime->_source;
            $datas[0]->id = $dateTime->_id;
        } else {
            $datas = $dateTime;
        }

        for ($i = 0; $i < count($datas); $i++) {
            $date = new \DateTime($datas[$i]->date);
            $dateFr = new \IntlDateFormatter('fr_FR', \IntlDateFormatter::FULL, \IntlDateFormatter::NONE);
            $datas[$i]->dateDreamsFr = $dateFr->format($date);

            $time = $datas[$i]->hour;
            $hour = $time[0] . $time[1];
            $min = $time[3] . $time[4];

            if (($hour === "00") || ($hour === '01')) {
                $time = $time[0] . $time[1] . ' heure ' . $time[3] . $time[4] . ' minutes ';
            } else {
                $time = $time[0] . $time[1] . ' heures ' . $time[3] . $time[4] . ' minutes ';
            }

            if (($min === '00') || ($min === '01')) {
                $time = str_replace('minutes', 'minute', $time);
            }

            $datas[$i]->hourDreamsFr = $time;
        }

        return $datas;
    }

    //date converter
    private function _dayHourFr($dateTime)
    {
        $listMonth = array(
            '01' => 'janvier',
            '02' => 'février',
            '03' => 'mars',
            '04' => 'avril',
            '05' => 'mai',
            '06' => 'juin',
            '07' => 'juillet',
            '08' => 'août',
            '09' => 'septembre',
            '10' => 'octobre',
            '11' => 'novembre',
            '12' => 'décembre'
        );

        if (gettype($dateTime) == 'object') {
            $datas[0] = (object)$dateTime->_source;
            $datas[0]->id = $dateTime->_id;
        } else {
            $datas = $dateTime;
        }

        for ($i = 0; $i < count($datas); $i++) {

            $date = new \DateTime($datas[$i]->date);
            $dateFr = new \IntlDateFormatter('fr_FR', \IntlDateFormatter::FULL, \IntlDateFormatter::NONE);

            $datas[$i]->yearFr = $date->format('Y');
            $month = $date->format('m');
            $datas[$i]->monthFr = $listMonth[$month];

            $day = $dateFr->format($date);
            $deleteYear = substr($day, -4);
            $day = str_replace((' ' . $deleteYear), '', $day);
            $deleteMonth = $datas[$i]->monthFr;
            $datas[$i]->dayFr = str_replace((' ' . $deleteMonth), '', $day);

            $time = $datas[$i]->hour;
            $hour = $time[0] . $time[1] . 'h';
            $min = $time[3] . $time[4] . 'm';
            $time = $hour . $min;

            $datas[$i]->hour = $time;
        }

        return $datas;

    }

    // insert in session the dream list for this user
    private function _dreamListSession($dreamList)
    {

        if (!empty($_SESSION['listDreams'])) {
            unset($_SESSION['listDreams']);
        }

        $_SESSION['listDreams'] = [];
        for ($i = 0; $i < count($dreamList); $i++) {
            $_SESSION['listDreams'][$i] = $dreamList[$i]->id;
        }
    }

    // we recover the previous dream id and the next dream id for the buttons view
    private function _previousAndNextDreams($dream)
    {
        $idDream = $dream[0]->id;
        $listDreams = $_SESSION['listDreams'];
        $countListDreams = count($listDreams) - 1;

        if ($idDream !== $listDreams[0]) {
            $key = array_keys($listDreams, $idDream);

            $keyPrevious = $key[0] - 1;
            $dream[0]->previousDream = $listDreams[$keyPrevious];
        } else {
            $dream[0]->previousDream = 'notExist';
        }

        if ($idDream != $listDreams[$countListDreams]) {
            $key = array_keys($listDreams, $idDream);
            $keyNext = $key[0] + 1;
            $dream[0]->nextDream = $listDreams[$keyNext];
        } else {
            $dream[0]->nextDream = 'notExist';
        }

        return $dream;
    }


    public function indexDreams()
    {
        $dreams = $this->_index->searchList();
        $dreams = $this->_dayHourFr($dreams);
        $this->_dreamListSession($dreams);

        if (empty($dreams)) {

            include_once($this->viewPath . '/notification/emptyIndex.php');
            return $this->homeLogged();
        } else {
            $this->render('dreams.indexDreams', compact('dreams'));
        }
    }

    public function read()
    {
        $this->_checkUser();
        $dreamDatas = $this->_index->searchByIdDream();
        $dream = $this->_dateTimeFr($dreamDatas);
        $dream = $this->_previousAndNextDreams($dream);
        $this->render('dreams.readDream', compact('dream'));
    }

    public function update()
    {
        $this->_checkUser();
        $dreamDatas = $this->_index->searchByIdDream();
        $dream = $this->_dateTimeFr($dreamDatas);
        $dream = $this->_previousAndNextDreams($dream);
        $this->render('dreams.updateDream', compact('dream'));

    }

    public function updated()
    {
        $this->_checkUser();

        if (empty($_POST['dream'])) {
            include_once($this->viewPath . 'notification/error/emptyTextarea.php');
            $this->indexDreams();
        } else {
            $this->_index->updating();
            include_once($this->viewPath . 'notification/updatedDream.php');
            $this->indexDreams();
        }
    }

    public function delete()
    {
        $this->_checkUser();
        $this->_index->deleting();
        include_once($this->viewPath . 'notification/deletedDream.php');
        $this->homeLogged();
    }

    public function created()
    {
        if (empty($_POST['dream'])) {
            include_once($this->viewPath . 'notification/error/emptyTextarea.php');
            $this->homeLogged();
        } else {
            $this->_index->indexing();
            include_once($this->viewPath . 'notification/dreamCreated.php');
            $this->homeLogged();
        }
    }

    // ajax call by search.js
    public function search()
    {
        if (!empty($_POST['search-txt'])) {
            $datas = $this->_index->searchWord();
            $datas = json_encode($datas);// js object build
            echo $datas;
        } else {
            include_once($this->viewPath . 'notification/error/notWordSearch.php');
            return false;
        }
    }

    // ajax call by search.js for the pagination of results
    public function countSearch()
    {
        $datas = $this->_index->countSearch();
        $datas = json_encode($datas);
        echo $datas;
    }

    public function deleteAccount()
    {
        return $this->_index->deleteAccount();
    }


}