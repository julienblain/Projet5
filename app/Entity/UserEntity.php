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


    public function login($mail) {
        $table = $this->_table;
        $user = $this->prepare(
            "SELECT idUsers, passwordUsers FROM $table
         WHERE users.mailUsers = '{$mail}' "
        );

        return $user;

    }

    public function createdAccount($mail, $password) {
        $table = $this->_table;
        return $this->insertInto(
            ("INSERT INTO $table(mailUsers, passwordUsers)
              VALUES(:mail, :password)"),

            (array(
                'mail' => $mail,
                'password' => $password
            ))
        );
    }

    public function alreadyExistingAccount($mail) {
        $table = $this->_table;
        return $this->prepare("SELECT COUNT(*) AS countMail FROM $table WHERE mailUsers =  '{$mail}'");
    }




    public function forgetPassword($idUser, $password) {
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


    public function getIdUser($mail, $one = true) {
        $table = $this->_table;
        $userId = $this->prepare((
        "SELECT idUsers FROM $table
         WHERE mailUsers = '{$mail}' "
        ), $one);

        return $userId;
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

    public function deleteAccount() {
        $table = $this->_table;
        $idUser = $_SESSION['idUser'];
        return $this->delete(
            "DELETE FROM $table WHERE idUsers = {$idUser}"
        );
    }
}