<?php


namespace App\Entity;
use Core\Entity\Entity;

//TODO quesiton heritage multiple pour Table
class UserEntity extends Entity
{
    private $_table = 'users';

    private $_userId;
    private $_userLogin;
    private $_userPassword;


    public function login(string $login, string $password) {
        $table = $this->_table;
        $user = $this->prepare(
            "SELECT idUsers, passwordUsers FROM $table
         WHERE users.loginUsers = '{$login}' "
        );

        return $user;

    }
}