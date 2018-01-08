<?php
namespace App\Controller;

use \App;
use App\AppException;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require(ROOT. '/lib/PHPMailer/src/Exception.php');
require(ROOT. '/lib/PHPMailer/src/PHPMailer.php');
require(ROOT. '/lib/PHPMailer/src/SMTP.php');


class UserController extends AppController {
    private $_table;
    private $_settingsMailer;

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
            $mailUser = htmlspecialchars($_POST['mail']);
            $password = htmlspecialchars($_POST['password']);
            $password = sha1($password);
            $validationKey = random_int(0, 10000);

            // verification if a account with its mail already existing by a count req
            $alreadyExisting = $this->_table->alreadyExistingAccount($mailUser);
            if(($alreadyExisting[0]->countMail) != '0') {
                include_once($this->viewPath. 'errors/accountExistingAlready.php');
                $this->home();
            }
            else {
                $this->_table->createAccount($mailUser, $password, $validationKey);

                //configuration phpMailer
                if($this->_settingsMailer === null) {
                    $this->_settingsMailer = require(ROOT . '/config/phpMailer.php');
                }

                //send mail
                $mail = new PHPMailer;
                try{
                    $mail->isSMTP();
                    $mail->SMTPSecure = 'tls';
                    $mail->SMTPAuth = true;
                    $mail->Host = $this->_settingsMailer['Host'];
                    $mail->Port = $this->_settingsMailer['Port'];
                    $mail->Username = $this->_settingsMailer['Username'];
                    $mail->Password = $this->_settingsMailer['Password'];
                    $mail->setFrom($this->_settingsMailer['setFrom']);
                    $mail->addAddress($mailUser);
                    $mail->Subject = 'Validation de votre inscription au journal des reves';
                    $mail->Body =
                        'Bienvenu !
                
                Pour finaliser votre inscription il vous suffit de cliquer sur le lien ci-dessous (ou bien de le copier dans votre navigateur).
                
                http://localhost/Projet5/public/index.php?p=user.createdAccount.'.$validationKey.'.';

                    $mail->send();

                    include_once($this->viewPath. 'home/mailSent.php');
                    $this->home();
                }
                catch (Exception $e){
                    //not use AppException
                    include_once($this->viewPath. 'errors/mailNotSent.php');
                    //echo $mail->ErrorInfo;
                    $this->home();
                }
            }
        }
        else {
            // login or password error
            include_once($this->viewPath . 'errors/createAccount.php');
            $this->home();
        }
    }

    public function createdAccount() {
        $get = \explode('.', $_GET['p']);
        $key = $get[2];
        echo $key;
    }
}