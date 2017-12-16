<?php

namespace Core\Database;

class MysqlDatabase {

    private $_dbName;
    private $_dbUser;
    private $_dbPassword;
    private $_dbHost;
    private $_pdo;

    public function __construct($dbName, $dbUser, $dbPassword, $dbHost) {
        $this->_dbName = $dbName;
        $this->_dbUser = $dbUser;
        $this->_dbPassword = $dbPassword;
        $this->_dbHost = $dbHost;
    }

}