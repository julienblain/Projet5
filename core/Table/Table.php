<?php


namespace Core\Table;


use Core\Database\MysqlDatabase;

class Table
{
    protected $table;
    protected $db;

    //call by App->getTable();
    public function __construct(MysqlDatabase $db)
    {
        $this->db = $db;
    }

    public function query($statement, $one=false) {
        return $this->db->query($statement, $one);
    }

    public function prepare($statement, $one=false) {
        return $this->db->prepare($statement, $one);
    }

    public function delete($statement) {
        return $this->db->delete($statement);
    }

    public function update($statement, Array $array) {
        return $this->db->update($statement, $array);
    }

    public function updateOne($statement) {
        return $this->db->updateOne($statement);
    }

    public function insertInto($statement, Array $array) {
        return $this->db->insertInto($statement, $array);
    }
}