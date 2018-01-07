<?php


namespace App\Table;


use Core\Auth\DBAuth;

//TODO quesiton heritage multiple pour Table
class UserTable extends DBAuth
{
    protected $table = 'user';

    public function login(string $login, string $password) {

        $user = $this->getDb()->prepare(
            "SELECT idUsers, passwordUsers FROM users
         WHERE users.loginUsers = '{$login}' "
        );

        if(($user) && ($user[0]->passwordUsers === sha1($password))) {
            return $user;
        } else {
            return false;
        }


    }
}