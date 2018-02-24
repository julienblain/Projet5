<?php
namespace App\Controller;

use \App;
use App\AppException;
use App\Controller\Elasticsearch\DreamsController;

//use PHPMailer\PHPMailer\PHPMailer;
//use PHPMailer\PHPMailer\Exception;

//require(ROOT. '/vendor/PHPMailer/src/Exception.php');
//require(ROOT. '/vendor/PHPMailer/src/PHPMailer.php');
//require(ROOT. '/vendor/PHPMailer/src/SMTP.php');


class UserController extends AppController {
    private $_table;
    private $_tableTmp;
    private $_subject = "Votre journal de rêve.";

    //private $_settingsMailer;

    public function __construct() {
        parent::__construct();

        //parent gives viewPath and loadModel
        $this->_table = $this->loadModel('User');
        $this->_tableTmp =$this->loadModel('Tmp');
    }


    public function control() {

        $this->recaptcha();

        if(isset($_POST['mail']) && isset($_POST['password'])) {
            $mail = htmlspecialchars($_POST['mail']);
            $mailSha1 = sha1($mail);
            $password = htmlspecialchars($_POST['password']);

            // User is the loaded UserTable, created by loadModel in the constructor
            $user = $this->_table->login($mailSha1);
            if ((!empty($user)) && ($user[0]->passwordUsers === sha1($password)) ) {
                $_SESSION['idUser'] = $user[0]->idUsers;
                $_SESSION['mailUser'] = $mail;
                $this->homeLogged();
            } else {
                // login or password error
                include_once($this->viewPath . 'notification/error/loginError.php');
                $this->home();
            }
        }
        else {
            // login or password error
            include_once($this->viewPath . 'notification/error/loginError.php');
            $this->home();
        }
    }

    public function createAccount() {

        $this->recaptcha();

        if(isset($_POST['mail']) && isset($_POST['password'])) {
            $mailUser = htmlspecialchars($_POST['mail']);
            $password = htmlspecialchars($_POST['password']);
            $passwordSha1 = sha1($password);
            $mailSha1 = sha1($mailUser);
            $validationKey = random_int(0, 10000);


            // verification if a account with its mail already existing by a count req
            $alreadyExisting = $this->_table->alreadyExistingAccount($mailSha1);
            $alreadyExistingTmp = $this->_tableTmp->alreadyExistingAccount($mailSha1);

            // this mail is already a actif account
            if(($alreadyExisting[0]->countMail) != '0') {
                include_once($this->viewPath. 'notification/error/accountExistingAlready.php');
                $this->home();
            }
            //this mail already exist but it is not actif
            elseif ((!empty($alreadyExistingTmp)) && ((intVal($alreadyExistingTmp[0]->tryValidationTmp)) <= 3)) {
                $body =
                    'Bienvenu !

                Pour finaliser votre inscription il vous suffit de cliquer sur le lien ci-dessous (ou bien de le copier dans votre navigateur).
                A bientôt !

                http://www.julienblain.com/Projet5/public/index.php?p=user.createdAccount.' . $validationKey . '.(' . $mailUser . ')';


                //$this->_phpMailer($body,  $mailUser);

                mail($mailUser, $_subject, $body);
                $this->_tableTmp->updateAccount($mailSha1, $passwordSha1, $validationKey);
                include_once($this->viewPath. 'notification/error/accountExistingAlreadyTmp.php');
                $this->home();
            }
            //this mail already exist and there was too much attempt
            elseif ((!empty($alreadyExistingTmp)) && ((intVal($alreadyExistingTmp[0]->tryValidationTmp)) > 3)) {
                include_once($this->viewPath. 'notification/error/createTooMuch.php');
                $this->home();
            }

            else {
                $body =
                    'Bienvenu !

                Pour finaliser votre inscription il vous suffit de cliquer sur le lien ci-dessous (ou bien de le copier dans votre navigateur).
                A bientôt !

                http://www.julienblain.com/Projet5/public/index.php?p=user.createdAccount.' . $validationKey . '.(' . $mailUser . ')';

                //$this->_phpMailer($body, $mailUser);
                mail($mailUser, $_subject, $body);

                $this->_tableTmp->createAccount($mailSha1, $passwordSha1, $validationKey);
                include_once($this->viewPath. 'home/notification/mailSent.php');
                $this->home();
            }
        }
        else {
            // login or password error
            include_once($this->viewPath . 'notification/error/createAccount.php');
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

        $datasTmp = $this->_tableTmp->verifCreatingAccount(sha1($mail));

        if((!empty($datasTmp)) && ($datasTmp[0]->keyTmp == $key)) {

            // create account on the active user table
            $this->_table->createdAccount($datasTmp[0]->mailTmp, $datasTmp[0]->passwordTmp);
            $idUser = $this->_table->getIdUser($datasTmp[0]->mailTmp);
            $_SESSION['idUser'] = $idUser->idUsers;
            $_SESSION['mailUser'] = $mail;

            //delete on the table not active account
            $this->_tableTmp->deleteByIdTmp($datasTmp[0]->idTmp);


            include_once($this->viewPath . 'notification/createdAccount.php');
            $this->homeLogged();
        }
        elseif ((!empty($datasTmp)) && ($datasTmp[0]->keyTmp != $key)) {
            include_once($this->viewPath. 'notification/error/errorKey.php');
            $this->home();
        }
        else {
            include_once($this->viewPath. 'notification/error/accountAlreadyActive.php');
            $this->home();
        }
    }

    public function forgetPass() {

        $this->recaptcha();

        $mailUser = htmlspecialchars($_POST['mail']);
        $account = $this->_table->alreadyExistingAccount(sha1($mailUser));

        //if account not found
        if($account[0]->countMail === '0') {
            include_once($this->viewPath. 'notification/error/accountNotFound.php');
            $this->home();
        }
        else {
            $idUser = $this->_table->getIdUser(sha1($mailUser));
            $idUser = $idUser->idUsers;
            $password = random_int(0,10000);
            $passwordSha1 = sha1($password);

            // we change the password of the account
            $this->_table->forgetPassword($idUser, $passwordSha1);

            //we send a mail with a new password
            $body = '
                Bonjour,

                Voici le nouveau mot de passe associé à votre compte. Il est vivement conseillé de le changer dès votre prochaine connexion dans votre espace utilisateur.
                Nouveau mot de pass : ' .$password.
                '
                Tcho ! :)' ;

            //$this->_phpMailer($body, $mailUser);
            mail($mailUser, $_subject, $body);
            include_once($this->viewPath. 'notification/mailSentPassword.php');
            $this->home();

        }
    }

    public  function updateAccount() {
        $this->render('dreams.updateAccount');
    }

    public function updatedAccountMail() {

        if($_SESSION['mailUser'] === htmlspecialchars($_POST['mail'])) {
            $this->homeLogged();
        }
        else {
            // verification if a account with its mail already existing by a count req
            $alreadyExisting = $this->_table->alreadyExistingAccount(sha1(htmlspecialchars($_POST['mail'])));
            if(($alreadyExisting[0]->countMail) != '0') {
                include_once($this->viewPath. 'notification/error/accountAlreadyActive.php');
                $this->homeLogged();
            }
            else {
                $idUser = $_SESSION['idUser'];
                $password = htmlspecialchars($_POST['password']);
                $user = $this->_table->getPassword($idUser);

                if ((!empty($user)) && ($user->passwordUsers === sha1($password))) {
                    //updated mail
                    $_SESSION['mailUser'] = htmlspecialchars($_POST['mail']);
                    $this->_table->updatedMail($idUser, sha1(htmlspecialchars($_POST['mail'])));
                    include_once($this->viewPath. 'notification/updatedMail.php');
                    $this->homeLogged();
                }
                else {
                    include_once($this->viewPath. 'notification/error/badPassword.php');
                    $this->updateAccount();

                }
            }
        }
    }

    public function updatedAccountPassword() {
        $idUser = $_SESSION['idUser'];
        $password = htmlspecialchars($_POST['oldPassword']);
        $user = $this->_table->getPassword($idUser);

        if ((!empty($user)) && ($user->passwordUsers === sha1($password))) {
            // changing password
            $password = sha1(htmlspecialchars($_POST['newPassword']));
            $this->_table->updatePassword($idUser, $password);
            include_once($this->viewPath. 'notification/updatedPassword.php');
            $this->homeLogged();
        }
        else {
            include_once($this->viewPath. 'notification/error/badPassword.php');
            $this->updateAccount();
        }
    }

    public function deletedAccount() {
        $pass = $this->_table->getPassword($_SESSION['idUser']);
        $passPost = htmlspecialchars($_POST['password']);

        if ((!empty($pass)) && ($pass->passwordUsers === sha1($passPost))) {
            $this->_table->deleteAccount();
            $dreamsElastic = new DreamsController();
            $dreamsElastic->deleteAccount();
            $this->home();
        }
        else {
            include_once($this->viewPath. 'notification/error/badPassword.php');
            $this->updateAccount();
        }

    }

    /*private function _phpMailer2($body, $mailUser) {
        //configuration phpMailer
        if($this->_settingsMailer === null) {
            $this->_settingsMailer = require(ROOT . '/config/phpMailer.php');
        }

        //send mail
        $mail = new PHPMailer;
        try{
            $mail->CharSet = 'UTF-8';
            $mail->isSMTP();
            $mail->SMTPSecure = 'tls';
            $mail->SMTPAuth = true;
            $mail->Host = $this->_settingsMailer['Host'];
            $mail->Port = $this->_settingsMailer['Port'];
            $mail->Username = $this->_settingsMailer['Username'];
            $mail->Password = $this->_settingsMailer['Password'];
            $mail->setFrom($this->_settingsMailer['setFrom']);

            $mail->addAddress($mailUser);
            $mail->Subject = 'Votre compte Journal des rêves';

            $mail->Body = $body;

            $mail->send();
        }
        catch (Exception $e){

            $ex = new AppException();
            $ex->phpMailer();

            $this->home();
        }
    }*/
}
