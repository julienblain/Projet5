<?php
namespace App;


class AppException extends \Exception
{
    public function __construct(string $message = "", int $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

    public function router() {
        echo "<p class='notification'>La page demandée n'existe pas. </p>";
    }

}