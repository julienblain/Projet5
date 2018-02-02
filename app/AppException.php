<?php
namespace App;


use App\Controller\AppController;

class AppException extends \Exception
{
    public function __construct(string $message = "", int $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

    public function router() {
        echo "<p class='notification notifError'>Erreur la page demandée n'existe pas.</p>";
    }

    public function mysqlDatabase() {
        echo "<p class='notification notifError'>Erreur de connexion avec la base de données utilisateur.</p>";
        $redirect = new AppController();
        $redirect->home();
        die();
    }

    public function elasticDatabase() {
        echo "<p class='notification notifError'>Erreur de connexion avec la base de données.</p>";
        $redirect = new AppController();
        $redirect->homeLogged();
        die();
    }

    public function phpMailer() {
        echo "<p class='notification notifError'>Erreur, le mail n'a pas pu être envoyé.</p>";
    }

    public function recaptcha() {
        echo "<p class='notification notifError'>Erreur de connexion avec le recaptcha.</p>";
    }
}