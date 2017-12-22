<?php


namespace App\Table;


use Core\Auth\DBAuth;

class UserTable extends DBAuth
{
    protected $table = 'user';

    public function login($login, $password) {

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