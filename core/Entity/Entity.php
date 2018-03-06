<?php

namespace Core\Entity;

use Core\Database\MysqlDatabase;


class Entity
{
    protected $table;
    protected $db;

    public function __construct()
    {
        $this->db = new MysqlDatabase();
    }

    public function query($statement, $one = false)
    {
        return $this->db->query($statement, $one);
    }

    public function prepare($statement, $one = false)
    {
        return $this->db->prepare($statement, $one);
    }

    public function delete($statement)
    {
        return $this->db->delete($statement);
    }

    public function update($statement, $array)
    {
        return $this->db->update($statement, $array);
    }

    public function updateOne($statement)
    {
        return $this->db->updateOne($statement);
    }

    public function insertInto($statement, Array $array)
    {
        return $this->db->insertInto($statement, $array);
    }
}