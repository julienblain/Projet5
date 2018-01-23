<?php
/**
 * Created by IntelliJ IDEA.
 * User: root
 * Date: 18/01/18
 * Time: 17:02
 */
namespace App\Controller\Elasticsearch;

use App\Controller\AppController;
use App\Entity\Elasticsearch\DreamsEntity;

class DreamsController extends AppController
{
    private $_index;

    public function __construct()
    {
        $this->_index = new DreamsEntity();
    }

    private function _checkUser() {
        $params = $_GET['p'];
        $params = \explode('.', $params);
        $idDream = $params[2];

        if(in_array($idDream, $_SESSION['listDreams'], true)){
            return true;
        }
        else {
            include_once ($this->viewPath . 'errors/forbiddenPage.php');
            $this->indexDreams();
            die();
        }
    }

    private function _dateTimeFr($dateTime) {

        if(gettype($dateTime) == 'object' ) { //TODO a ameliorer questioner
            $datas[0] = (object) $dateTime->_source;
            $datas[0]->id = $dateTime->_id;
        }
        else {
            $datas = $dateTime;
        }


        for($i = 0 ; $i < count($datas); $i++) {

            $date = new \DateTime($datas[$i]->date);
            $dateFr = new \IntlDateFormatter('fr_FR', \IntlDateFormatter::FULL, \IntlDateFormatter::NONE);
            $datas[$i]->dateDreamsFr = $dateFr->format($date);

            $time = $datas[$i]->hour;
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

            $datas[$i]->hourDreamsFr = $time;
        }

        return $datas;
    }

    // insert in $_Session the dream list for this user
    private function _dreamListSession($dreamList) {

        if(!empty($_SESSION['listDreams'])) {
            unset($_SESSION['listDreams']);
        }

        $_SESSION['listDreams'] = [];
        for($i = 0; $i < count($dreamList); $i++) {
            $_SESSION['listDreams'][$i] = $dreamList[$i]->id;
        }
    }

    private function _previousAndNextDreams($dream) {
        // we recover the previous dream id and the next dream id for the buttons in view
        $idDream = $dream[0]->id;
        $listDreams = $_SESSION['listDreams'];
        $countListDreams = count($listDreams) -1;

        if($idDream !== $listDreams[0]) {
            $key = array_keys($listDreams, $idDream);

            $keyPrevious = $key[0] -1;
            $dream[0]->previousDream = $listDreams[$keyPrevious];
        }
        else {
            $dream[0]->previousDream = 'notExist';
        }

        if($idDream != $listDreams[$countListDreams]) {
            $key = array_keys($listDreams, $idDream);
            $keyNext = $key[0] + 1;
            $dream[0]->nextDream = $listDreams[$keyNext];
        }
        else {
            $dream[0]->nextDream = 'notExist';
        }

        return $dream;
    }


    public function indexDreams() {

        $dreams = $this->_index->searchList();
        $dreams = $this->_dateTimeFr($dreams);
        $this->_dreamListSession($dreams);

        if(empty($dreams)) {

            include_once ($this->viewPath . '/notification/emptyIndex.php');
            $this->homeLogged();
        }
        else {
            $this->render('dreams.indexDreams', compact('dreams'));
        }
    }

    public function read() {
        $this->_checkUser();
        var_dump($_POST);
        $dreamDatas = $this->_index->searchByIdDream();
        $dream = $this->_dateTimeFr($dreamDatas);
        $dream = $this->_previousAndNextDreams($dream);

        if(!empty($_POST['search-txt'])){
            $this->search();
            echo 'ici';
        }
        else {
            $this->render('dreams.readDream', compact('dream'));
        }

    }

    public function update() {
        $this->_checkUser();
        $dreamDatas = $this->_index->searchByIdDream();
        $dream = $this->_dateTimeFr($dreamDatas);
        $dream = $this->_previousAndNextDreams($dream);

        if(!empty($_POST['search'])){
            $this->search();
        }
        else {
            $this->render('dreams.updateDream', compact('dream'));
        }
    }

    public function updated() {
        $this->_checkUser();
        $this->_index->updating();
        include_once ($this->viewPath . 'notification/updatedDream.php');
        $this->indexDreams();
    }

    public function delete() {
        $this->_checkUser();
        $this->_index->deleting();

        include_once ($this->viewPath . 'notification/deletedDream.php');
        $this->homeLogged();
    }

    public function created() {
        $this->_index->indexing();
       //$this->_index->mapping();
        $this->homeLogged();
    }


    public function search() {
        if((isset($_POST['search-phrase'])) && (htmlspecialchars($_POST['search-phrase']) === 'checked')) {
            $searchedDreams = $this->_index->searchPhrase();
        }
        else {

            $searchedDreams = $this->_index->searchWord();
            print_r($searchedDreams);
            //$this->_index->dede();
        }

    }





    public function deleteAccount() {
        return $this->_index->deleteAccount();
    }




}