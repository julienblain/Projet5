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


    public function login(string $mail) {
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

    public function verifCreatingAccount($mail) {
        $table = $this->_table;
        $datas =  $this->prepare(
            "SELECT idUsers, keyUsers, activeUsers FROM $table
         WHERE users.mailUsers = '{$mail}' "
        );
        return $datas;
    }

    public function accountActif($idUser) {
        $table = $this->_table;
        return $this->updateOne(
            "UPDATE $table SET activeUsers = 1 WHERE idUsers = '{$idUser}'"
        );
    }

    public function accountExist($mailUser) {
        $table = $this->_table;
        return $this->prepare(
            "SELECT idUsers, keyUsers, activeUsers FROM $table 
                        WHERE users.mailUsers = '{$mailUser}'"
        );
    }

    public function forgetPassword($idUser, $mailUser, $password) {
        $table = $this->_table;
        return $this->update(
            ("UPDATE $table
            SET mailUsers = :mailUser, passwordUsers = :password
            WHERE idUsers = '{$idUser}'"),

            (array(
                'mailUser' => $mailUser,
                'password' => $password
            ))
        );
    }

    public function forgetActivate($idUser, $keyValidation) {
        $table = $this->_table;
        return $this->update(
            ("UPDATE $table
            SET keyUsers = :keyValidation
            WHERE idUsers = '{$idUser}'"),

            (array(
                'keyValidation' => $keyValidation
            ))
        );
    }

    public function getPassword($idUser, $one = true) {
        $table = $this->_table;
        $user = $this->prepare((
            "SELECT passwordUsers FROM $table
         WHERE idUsers = '{$idUser}' "
        ), $one);

        return $user;

    }

    public function updatedMail($idUser, $mail) {
        $table = $this->_table;
        return $this->update(
            ("UPDATE $table
            SET mailUsers = :mailUser
            WHERE idUsers = '{$idUser}'"),

            (array(
                'mailUser' => $mail
            ))
        );
    }

    public function updatePassword($idUser, $password) {
        $table = $this->_table;
        return $this->update(
            ("UPDATE $table
            SET passwordUsers = :password
            WHERE idUsers = '{$idUser}'"),

            (array(
                'password' => $password
            ))
        );
    }
}