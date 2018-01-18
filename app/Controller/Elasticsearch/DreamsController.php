<?php
/**
 * Created by IntelliJ IDEA.
 * User: root
 * Date: 18/01/18
 * Time: 17:02
 */
namespace App\Controller\Elasticsearch;

use App\Entity\Elasticsearch\DreamsEntity;

class DreamsController
{
    private $_index;

    public function __construct()
    {
        $index = '\App\Entity\Elasticsearch\DreamsEntity';
        $this->_index = new $index();
    }

    public function indexing($dream) {

       $this->_index->indexing($dream);
    }

    public function deleting($id) {
        $this->_index->deleting($id);
    }
}