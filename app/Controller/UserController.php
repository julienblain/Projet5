<?php
namespace App\Controller;

use \App;


class UserController extends AppController {
    private $_table;

    public function __construct() {
        //parent gives viewPath and loadModel
        $this->_table = $this->loadModel('User');
    }

    public function control() {

        if(isset($_POST['mail']) && isset($_POST['password'])) {
            $mail = htmlspecialchars($_POST['mail']);
            $password = htmlspecialchars($_POST['password']);

            // User is the loaded UserTable, created by loadModel in the constructor
            $user = $this->_table->login($mail, $password);
            if (($user) && ($user[0]->passwordUsers === sha1($password)) && ($user[0]->activeUsers === '1')) {
                $_SESSION['idUser'] = $user[0]->idUsers;
                $this->render('dreams.homeLogged');
            } else {
                // login or password error
                include_once($this->viewPath . 'errors/loginError.php');
                $this->home();
            }
        }
        else {
            // login or password error
            include_once($this->viewPath . 'errors/loginError.php');
            $this->home();
        }
    }

    public function createAccount() {
        if(isset($_POST['mail']) && isset($_POST['password'])) {
            $mail = htmlspecialchars($_POST['mail']);
            $password = htmlspecialchars($_POST['password']);
            $validationKey = random_int(0, 10000);

            $this->_table->createAccount($mail, $password, $validationKey);



            /*if (($user) && ($user[0]->passwordUsers === sha1($password)) && ($user[0]->activeUsers === '1')) {
                $_SESSION['idUser'] = $user[0]->idUsers;
                $this->render('dreams.homeLogged');
            } else {
                // login or password error
                include_once($this->viewPath . 'errors/loginError.php');
                $this->home();
            }*/
        }
        else {
            // login or password error
            include_once($this->viewPath . 'errors/createAccount.php');
            $this->home();
        }

    }
}