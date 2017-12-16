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

    public function getPdo() {
        if ($this->_pdo === null) {
            try {
                $pdo = new \PDO('mysql:host=' . $this->_dbHost . ';
                    dbname=' . $this->_dbName . ';
                    charset=utf8',
                    $this->_dbUser,
                    $this->_dbPassword,
                    array(\PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION)
                );
            }
            catch (\Exception $e){
                die('Erreur de connexion à la base de donnée');
            }

            $this->_pdo = $pdo;
        }

        return $this->_pdo;
    }

    public function query($statement, $one = false) {
        $req = $this->getPdo()->query($statement);
        $req->setFetchMode(\PDO::FETCH_OBJ); //return object

        if($one) {
            $datas = $req->fetch();
        }
        else {
            $datas = $req->fetchAll();
        }

        $req->closeCursor();
        return $datas;
    }


    public function prepare($statement, $one = false) {
        $req = $this->getPdo()->prepare($statement);
        $req->execute();
        $req->setFetchMode(\PDO::FETCH_OBJ); //retrun object

        if($one) {
            $datas = $req->fetch();
        }
        else {
            $datas = $req->fetchAll();
        }

        $req->closeCursor();
        return $datas;
    }

    public function delete($statement) {
        $req = $this->getPdo()->prepare($statement);
        $req->execute();
        $req->closeCursor();
        return true;
    }

    public function updateOne($statement) {
        $req = $this->getPdo()->prepare($statement);
        $req->execute();
        $req->closeCursor();
    }

    public function update($statement, $array) {
        $req = $this->getPdo()->prepare($statement);
        $req->execute($array);
        $req->closeCursor();
    }

    public function insertInto($statement, $array) {
        $req = $this->getPdo()->prepare($statement);
        $req->execute($array);
        $req->closeCursor();
    }

}