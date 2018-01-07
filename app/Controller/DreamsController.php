<?php


namespace App\Controller;
use Core\Controller\Controller;

class DreamsController extends AppController
{   private $_idUser;

    public function __construct() {
        //parent gives viewPath and loadModel

        //TODO a faire la vue
       parent::__construct();
        $this->loadModel('Dreams');

        $this->setIdUser(S_SESSION['idUser']);
    }

    public function submit() {
        $idUser = $this->_idUser;
        $dream = $_POST['dreamWrite'];

        if(isset($_POST['dreamDate'])) {
            $date = $_POST['dreamDate'];
        }
        if(isset($_POST['dreamHour'])) {
            $hour = $_POST['dreamHour'];
        }


    }

    /**
     * @return mixed
     */
    public function getIdUser()
    {
        return $this->_idUser;
    }

    /**
     * @param mixed $idUser
     */
    public function setIdUser($idUser): void
    {
        $this->_idUser = $idUser;
    }
}