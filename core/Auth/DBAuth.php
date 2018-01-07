<?php


namespace Core\Auth;


use Core\Table\Table;

class DBAuth extends Table
{
    private $_db;

    public function __construct($db)
    {
        $this->setDb($db);

    }

    public function login(string $login, string $password) {

    }


    public function getDb()
    {
        return $this->_db;
    }


    public function setDb($db)
    {
        $this->_db = $db;
    }


}