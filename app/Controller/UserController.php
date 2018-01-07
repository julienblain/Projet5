<?php
namespace App\Controller;

use \App;
//use Core\Table\Table;

class UserController extends AppController {

    public function __construct() {
        //parent gives viewPath and loadModel
        $this->loadModel('User');
    }

    public function control() {

        if(isset($_POST['login']) && isset($_POST['password'])) {
            $login = htmlspecialchars($_POST['login']);
            $password = htmlspecialchars($_POST['password']);

            //TODO question comprend pas que c'est defini dans le parent ??
            $user = $this->User->login($login, $password);

            //if error login or password
            if($user === false) {
               // login or password error
                include_once($this->viewPath .'errors/loginError.php');
                return $this->connection();
            } else {
                $_SESSION['user'] = $login;
                $_SESSION['idUser'] = $user[0]->idUsers;
                return $this->render('dreams.homeLogged');
            }
        }
        else {
            include_once($this->viewPath."errors/loginError.php");
            return $this->connection();
        }
    }


}