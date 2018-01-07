<?php


namespace App\Entity;
use Core\Entity\Entity;


class DreamsEntity extends Entity
{
    protected $table = 'dreams';

    public function queryTest() {
        return $this->query("SELECT * FROM test");
    }
}