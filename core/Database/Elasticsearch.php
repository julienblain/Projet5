<?php

namespace Core\Database;


use App\AppException;
use Core\ConfigElasticsearch;
use Elasticsearch\ClientBuilder;
use \Elasticsearch\Common\Exceptions\NoNodesAvailableException;

class Elasticsearch
{
    private $_client;


    public function __construct() {

        if($this->_client === null) {
            $config = new ConfigElasticsearch();
            $hosts = $config->getSettings('hosts');
            $keyId = $config->getSettings('keyId');
            $keySecret = $config->getSettings('secret');



            $credentials = new \Aws\Credentials\Credentials($keyId, $keySecret);
            $signature = new \Aws\Signature\SignatureV4('es', 'eu-west-3');

            $middleware = new \Wizacha\Middleware\AwsSignatureMiddleware($credentials, $signature);
            $defaultHandler = \Elasticsearch\ClientBuilder::defaultHandler();
            $awsHandler = $middleware($defaultHandler);

            $clientBuilder =  \Elasticsearch\ClientBuilder::create();

            $clientBuilder
                ->setHandler($awsHandler)
                ->setHosts($hosts)
            ;
            $this->_client = $clientBuilder->build();

           /* $this->_client = ClientBuilder::create()
                ->setHosts($hosts)
                ->build();
           */
        }
    }



    private function _req($reqType, $params) {

        try {
            return $this->_client->$reqType($params);

        }
        catch(\Exception $e) { // only \Exception or Elasticsearch exceptions can be catched
            var_dump($e->getMessage());
            $ex = new AppException();
            $ex->elasticDatabase();
        }
    }

    public function indexing($params) {

        return $this->_req('index', $params);

    }

    public function deleting($params) {

        return $this->_req('delete', $params);
    }

    public function updating($params) {
        return $this->_req('update', $params);
    }

    public function search($params) {
        return $this->_req('search', $params);
    }

    public function get($params) {

        return $this->_req('get', $params);
    }

    public function deleteByQuery($params) {
        return $this->_req('deleteByQuery', $params);
    }

    //delete all bdd
    public function dede($params) {
        return $this->_client->indices()->delete($params);
    }

    public function mapping($params) {
        return $this->_client->indices()->create($params);
    }

    public function count($params) {
        return $this->_req('count', $params);
    }
}