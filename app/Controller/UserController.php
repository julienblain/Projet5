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
            $user = $this->_table->login($mail);
            if (($user) && ($user[0]->passwordUsers === sha1($password)) && ($user[0]->activeUsers === '1')) {
                $_SESSION['idUser'] = $user[0]->idUsers;
                $_SESSION['mailUser'] = $mail;
                $this->homeLogged();
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
            $passwordSha1 = sha1($password);
            $validationKey = random_int(0, 10000);
            $validationKeySha1 = sha1($validationKey);

            // verification if a account with its mail already existing by a count req
            $alreadyExisting = $this->_table->alreadyExistingAccount($mailUser);
            if(($alreadyExisting[0]->countMail) != '0') {
                include_once($this->viewPath. 'errors/accountExistingAlready.php');
                $this->home();
            }
            else {
                    $body =
                        'Bienvenu !
                
                Pour finaliser votre inscription il vous suffit de cliquer sur le lien ci-dessous (ou bien de le copier dans votre navigateur).
                
                http://localhost/Projet5/public/index.php?p=user.createdAccount.'.$validationKey.'.('.$mailUser.')';

                    $this->_phpMailer($body, $mailUser);
                    $this->_table->createAccount($mailUser, $passwordSha1, $validationKeySha1);
                    include_once($this->viewPath. 'home/mailSent.php');
                    $this->home();
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

        //cleaning $_Get
        $mail = strpbrk($_GET['p'], '(');
        $mail = str_replace('(', '', $mail);
        $mail = str_replace(')', '', $mail);

        $datasUser = $this->_table->verifCreatingAccount($mail);

        if(($datasUser[0]->keyUsers === sha1($key)) && ($datasUser[0]->activeUsers === '0')) {
            $idUser = $datasUser[0]->idUsers;

            $_SESSION['idUser'] = $idUser;

            // account active
            $this->_table->accountActif($idUser);

            include_once($this->viewPath . 'notification/createdAccount.php');
            $this->homeLogged();
        }
        elseif ($datasUser[0]->keyUsers != sha1($key)) {
            include_once($this->viewPath. 'errors/errorKey.php');
            $this->home();
        }
        else {
            include_once($this->viewPath. 'errors/accountAlreadyActif.php');
            $this->home();
        }
    }

    public function forgetPass() {
        $mailUser = htmlspecialchars($_POST['mail']);
        $user = $this->_table->accountExist($mailUser);

        //if account not found
        if(empty($user)) {
            include_once($this->viewPath. 'errors/accountNotFound.php');
            $this->home();
        }
        else {

            // if account is not active, we send a mail with a new key
            if($user[0]->activeUsers === '0') {
                $validationKey = random_int(0, 10000);
                $validationKeySha1 = sha1($validationKey);
                $idUser = $user[0]->idUsers;
                $password = $user[0]->passwordUsers;

                    $body =
                        'Bienvenu !
                
                Pour finaliser votre inscription il vous suffit de cliquer sur le lien ci-dessous (ou bien de le copier dans votre navigateur).
                
                
                http://localhost/Projet5/public/index.php?p=user.createdAccount.'.$validationKey.'.('.$mailUser.')';
                    $this->_phpMailer($body, $mailUser);
                    //update key
                    $this->_table->forgetActivate($idUser, $validationKeySha1);
                    include_once($this->viewPath. 'home/mailSentNotActive.php');
                    $this->home();
            }
            // the account exist and it is active, we send a mail with a new password
            else {
                $idUser = $user[0]->idUsers;
                $password = random_int(0,10000);
                $passwordSha1 = sha1($password);

                // we change the password of the account
                $this->_table->forgatePassword($idUser, $mailUser, $passwordSha1);

                //we send a mail with a new password
                $body = '
                    Bonjour, 
                    
                    Voici le nouveau mot de passe associé à votre compte. Il est vivement conseillé de le changer dès votre prochaine connexion dans votre espace utilisateur.
                    Nouveau mot de pass : ' .$password.
                    '
                    Tcho ! :)' ;

                $this->_phpMailer($body, $mailUser);
                include_once($this->viewPath. 'home/mailSentPassword.php');
                $this->home();
            }
        }
    }

    public  function updateAccount() {
        $this->render('dreams.updateAccount');
    }

    public function updatedAccountMail() {
        var_dump($_POST);
        var_dump($_SESSION);
        if($_SESSION['mailUser'] === htmlspecialchars($_POST['mail'])) {
            $this->homeLogged();
        }
        else {
            // verification if a account with its mail already existing by a count req
            $alreadyExisting = $this->_table->alreadyExistingAccount(htmlspecialchars($_POST['mail']));
            if(($alreadyExisting[0]->countMail) != '0') {
                $this->homeLogged();
            }
            else {
                $idUser = $_SESSION['idUser'];
                $password = htmlspecialchars($_POST['password']);
                $user = $this->_table->getPassword($idUser);

                if (($user) && ($user->passwordUsers === sha1($password))) {
                    //updated mail
                    $_SESSION['mailUser'] = htmlspecialchars($_POST['mail']);
                    $this->_table->updatedMail($idUser, htmlspecialchars($_POST['mail']));
                    include_once($this->viewPath. 'notification/updatedMail.php');
                    $this->homeLogged();
                }
                else {
                    include_once($this->viewPath. 'errors/badPassword.php');
                    $this->updateAccount();

                }
            }
        }
    }

    public function updatedAccountPassword() {
        var_dump($_POST);
        $idUser = $_SESSION['idUser'];
        $password = htmlspecialchars($_POST['oldPassword']);
        $user = $this->_table->getPassword($idUser);

        if (($user) && ($user->passwordUsers === sha1($password))) {
            // changing password
            $password = sha1(htmlspecialchars($_POST['newPassword']));
            $this->_table->updatePassword($idUser, $password);
            include_once($this->viewPath. 'notification/updatedPassword.php');
            $this->homeLogged();
        }
        else {
            include_once($this->viewPath. 'errors/badPassword.php');
            $this->updateAccount();
        }
    }

    private function _phpMailer($body, $mailUser) {
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
            $mail->Subject = 'Votre compte Journal des reves';

            $mail->Body = $body;
            $mail->send();
        }
        catch (Exception $e){
            //not use AppException
            include_once($this->viewPath. 'errors/mailNotSent.php');
            //echo $mail->ErrorInfo;
            $this->home();
        }
    }
}