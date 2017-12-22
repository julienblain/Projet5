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