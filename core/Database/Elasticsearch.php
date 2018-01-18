<?php

namespace Core\Database;


use Core\ConfigElasticsearch;
use Elasticsearch\ClientBuilder;

class Elasticsearch
{
    private $_client;


    public function __construct() {

        if($this->_client === null) {
            $config = new ConfigElasticsearch();
            $hosts = $config->getSettings('hosts');

            $this->_client = ClientBuilder::create()
                ->setHosts($hosts)
                ->build();
        }

    }

    public function indexing($params) {
        return $this->_client->index($params);

    }

    public function deleting($params) {
        return $this->_client->delete($params);
    }
}