<?php


namespace Core\Auth;


class DBAuth
{
    private $_db;

    public function __construct($db)
    {
        $this->setDb($db);

    }


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
    /**
     *
     */
    public function getDb()
    {
        return $this->_db;
    }

    /**
     *
     */
    public function setDb($db)
    {
        $this->_db = $db;
    }


}