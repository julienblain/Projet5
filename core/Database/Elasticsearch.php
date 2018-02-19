<?php

namespace Core\Database;

use App\AppException;
use Core\ConfigElasticsearch;
use \Elasticsearch\ClientBuilder;
use \Aws\Credentials\Credentials;
use \Aws\Signature\SignatureV4;
use \Wizacha\Middleware\AwsSignatureMiddleware;

class Elasticsearch
{
    private $_client;

    public function __construct()
    {

        if ($this->_client === null) {
            //settings
            $config = new ConfigElasticsearch();
            $hosts = $config->getSettings('hosts');
            $keyId = $config->getSettings('keyId');
            $keySecret = $config->getSettings('secret');

            //signature aws with wizacha/aws-signature-middleware library
            $credentials = new Credentials($keyId, $keySecret);
            $signature = new SignatureV4('es', 'eu-west-3');

            $middleware = new AwsSignatureMiddleware($credentials, $signature);
            $defaultHandler = ClientBuilder::defaultHandler();
            $awsHandler = $middleware($defaultHandler);

            $clientBuilder = ClientBuilder::create();

            $clientBuilder
                ->setHandler($awsHandler)
                ->setHosts($hosts)
            ;

            $this->_client = $clientBuilder->build();
        }
    }

    private function _req($reqType, $params)
    {
        try {
            return $this->_client->$reqType($params);

        } catch (\Exception $e) { // only \Exception or Elasticsearch exceptions can be catched
            var_dump($e->getMessage());
            $ex = new AppException();
           return  $ex->elasticDatabase();
        }
    }

    public function indexing($params)
    {

        return $this->_req('index', $params);

    }

    public function deleting($params)
    {

        return $this->_req('delete', $params);
    }

    public function updating($params)
    {
        return $this->_req('update', $params);
    }

    public function search($params)
    {
        return $this->_req('search', $params);
    }

    public function get($params)
    {

        return $this->_req('get', $params);
    }

    public function deleteByQuery($params)
    {
        return $this->_req('deleteByQuery', $params);
    }

    //delete all bdd
    public function dede($params)
    {
        return $this->_client->indices()->delete($params);
    }

    public function mapping($params)
    {
        return $this->_client->indices()->create($params);
    }

    public function count($params)
    {
        return $this->_req('count', $params);
    }
}