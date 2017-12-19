<?php
namespace App\Controller;

use \App;
use Core\Auth\DBAuth;

class LoggedController extends AppController {


    public function control() {
        $app = App::getInstance();
        $auth = new DBAuth($app->getDb());

        if(isset($_POST['login']) && isset($_POST['password'])) {
            $login = htmlspecialchars($_POST['login']);
            $password = htmlspecialchars($_POST['password']);

            $user = $auth->login($login, $password);

            //if error login or password
            if($user === false) {
               // login or password error
                include_once($this->viewPath."errors/loginError.php");
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

    public function connection() {
        $this->render('home.home');
    }
}