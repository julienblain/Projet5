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

    public function updating($params) {
        return $this->_client->update($params);
    }

    public function search($params) {
        return $this->_client->search($params);
    }

    //supprimer
    public function dede($params) {
        return $this->_client->indices()->delete($params);
    }

    public function mapping($params) {
        return $this->_client->indices()->create($params);
    }

    public function get($params) {
        return $this->_client->get($params);
    }
}