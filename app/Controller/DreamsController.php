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
        $this->_idDream = $_GET['p'][-1];
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


        /*ELASTIC A SUPPRIMER


        var_dump($dream);
        // conversion en json
        $index = array(
            'index' => array(
                "_index" => "dreams",
                "_type" => "dream",
                "_id" => $dream[0]->idDreams
            )
        );

        $indexJson = json_encode($index);
        $fields = array(
            'fields' => array(
                'idUserDreams' => $dream[0]->idUserDreams,
                'dateDreams' => $dream[0]->dateDreams,
                'hourDreams' => $dream[0]->hourDreams,
                'dreamDreams' => $dream[0]->dreamDreams,
                'previousEventsDreams' => $dream[0]->previousEventsDreams,
                'elaborationDreams' => $dream[0]->elaborationDreams
            )
        );
        $fieldsJson = json_encode($fields);



        $fileName = 'test.json';
        $file = fopen($fileName, 'w+');
        fwrite($file, $indexJson);
        fwrite($file, $fieldsJson);
        fclose($file);

        $hostTruc = '127.0.0.1';
        $portTruc = '9200';
        $indexElastic = 'dreams';
        $type = 'dream';
        $docId = $dream[0]->idDreams;

        //curl
        $url = 'http://'.$hostTruc.':'.$portTruc.'/'.$indexElastic.'/'.$type.'/'.$docId;
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_PORT, $portTruc);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'PUT');
        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($index));
        curl_setopt($curl, CURLOPT_HEADER, array('Accept'=>'application/json','Content-Type' => 'application/json'));

        $curlData = curl_exec($curl);
        curl_close($curl);

        $rep = json_decode($curlData, true);
        var_dump($rep);


        */




        if(empty($dreams)) {
            include_once ($this->viewPath . '/notification/emptyIndex.php');
            $this->homeLogged();
        } else {
            $this->render('dreams.indexDreams', compact('dreams'));
        }

    }

    public function read() {
        $idDream = $_GET['p'][-1];
        $dream = $this->_table->readDream($idDream);
        $dream = $this->_previousAndNextDream($dream);
       $this->render('dreams.readDream', compact('dream'));

    }

    private function _previousAndNextDream($dream) {
        // we recover the previous dream id and the next dream id for the buttons in view
        $idDream = $_GET['p'][-1];
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
            var_dump($key);
            $dream['nextDream'] = $listDreams[$keyNext];
        }
        else {
            $dream['nextDream'] = 'notExist';
        }

        return $dream;
    }

    public function update() {
        $idDream = explode('.', $_GET['p']);
        $dream = $this->_table->readDream($idDream[2]);
        $dream = $this->_previousAndNextDream($dream);
        $this->render('dreams.updateDream', compact('dream'));
    }

    public function updated() {
        $this->_checkUser();
        $this->_table->updatedDream($this->_idDream);
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
        $this->_checkUser();
        $this->_table->deleteDream($this->_idDream);
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