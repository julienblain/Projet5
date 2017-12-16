<?php


namespace App\Table;
use Core\Table\Table;


class DreamsTable extends Table
{
    protected $table = 'dreams';

    public function queryTest() {
        return $this->query("SELECT * FROM test");
    }
}