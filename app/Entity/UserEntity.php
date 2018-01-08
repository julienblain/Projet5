<?php


namespace App\Entity;
use Core\Entity\Entity;

//TODO quesiton heritage multiple pour Table
class UserEntity extends Entity
{
    private $_table = 'users';

    private $_userId;
    private $_userMail;
    private $_userPassword;


    public function login(string $mail, string $password) {
        $table = $this->_table;
        $user = $this->prepare(
            "SELECT idUsers, passwordUsers, activeUsers FROM $table
         WHERE users.mailUsers = '{$mail}' "
        );

        return $user;

    }

    public function createAccount($mail, $password, $keyValidation) {
        $table = $this->_table;
        return $this->insertInto(
            ("INSERT INTO $table(mailUsers, passwordUsers, keyUsers)
              VALUES(:mail, :password, :keyValidation)"),

            (array(
                'mail' => $mail,
                'password' => $password,
                'keyValidation' => $keyValidation
            ))
        );
    }

    public function alreadyExistingAccount($mail) {
        $table = $this->_table;
        return $this->prepare("SELECT COUNT(*) AS countMail FROM $table WHERE mailUsers =  '{$mail}'");
    }

    public function verifKey($key) {
        $table = $this->_table;
        $datas =  $this->prepare(
            "SELECT idUsers, keyUsers, activeUsers FROM $table
         WHERE users.mailUsers = '{$mail}' "
        );
    }
}