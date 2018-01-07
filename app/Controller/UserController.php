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

        if(isset($_POST['login']) && isset($_POST['password'])) {
            $login = htmlspecialchars($_POST['login']);
            $password = htmlspecialchars($_POST['password']);

            // User is the loaded UserTable, created by loadModel in the constructor
            $user = $this->_table->login($login, $password);

            if (($user) && ($user[0]->passwordUsers === sha1($password))) {
                $_SESSION['user'] = $login;
                $_SESSION['idUser'] = $user[0]->idUsers;
                $this->render('dreams.homeLogged');
            } else {
                // login or password error
                include_once($this->viewPath . 'errors/loginError.php');
                $this->home();
            }
        }
    }
}