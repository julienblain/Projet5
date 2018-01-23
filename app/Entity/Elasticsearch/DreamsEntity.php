<?php
namespace App\Entity\Elasticsearch;

use App\Controller\AppController;
use Core\Database\Elasticsearch;

class DreamsEntity extends AppController
{
    private $_db;
    private $_index = 'dreams';
    private $_type = 'dream';

    private $_id;
    private $_date;
    private $_hour;
    private $_content;
    private $_previousEvents;
    private $_elaboration;


    public function __construct()
    {
        $this->_db = new Elasticsearch();

    }

    private function _id() {
        $params = $_GET['p'];
        $params = \explode('.', $params);
        $this->_id = $params[2];
        return $this->_id;
    }

    private function _date() {
        !empty($_POST['dreamDate']) ? $this->_date = htmlspecialchars($_POST['dreamDate']) : $this->_date = null;
        return $this->_date;
    }

    private function _hour() {
        !empty($_POST['dreamHour']) ? $this->_hour = htmlspecialchars($_POST['dreamHour']) : $this->_hour = null;
        return $this->_hour;
    }

    private function _content() {
        !empty($_POST['dream']) ? $this->_content = htmlspecialchars($_POST['dream']) : $this->_content = null;
        return $this->_content;
    }

    private function _previousEvents() {
        !empty($_POST['previousEvents']) ? $this->_previousEvents = htmlspecialchars($_POST['previousEvents']) : $this->_previousEvents  = null;
        return $this->_previousEvents;
    }

    private function _elaboration() {
        !empty($_POST['elaboration']) ? $this->_elaboration = htmlspecialchars($_POST['elaboration']) : $this->_elaboration  = null;
        return $this->_elaboration;
    }

    public function indexing() {
        $params = [
            'index' => $this->_index,
            'type' => $this->_type,
            'body' => [
                'idUser' => $_SESSION['idUser'],
                'date' => $this->_date(),
                'hour' => $this->_hour(),
                'content' => $this->_content(),
                'previousEvents' => $this->_previousEvents(),
                'elaboration' => $this->_elaboration()
            ]
        ];

        return $this->_db->indexing($params);
    }

    public function searchList() {
        $params = [
            'index' => $this->_index,
            'type' => $this->_type,

            'body' => [
                '_source' => ['date', 'hour'],
                'query' => [
                    'term' => [
                        'idUser' => $_SESSION['idUser']
                    ]
                ]
            ]
        ];

        $params['body']['sort'] =[   //out of params principal elsif bug with elasticsearch-php
            'date' => [
                'order' =>'desc']] ;

        $dreamDatas = $this->_db->search($params);
        $dreamList = [];

        foreach ($dreamDatas['hits']['hits'] as $dreamDateTime) {
            $dream['id'] =  $dreamDateTime['_id'];
            $dream['date'] = $dreamDateTime['_source']['date'];
            $dream['hour'] = $dreamDateTime['_source']['hour'];
            $dreamList[] = (object) $dream;
            $dream = [];
        }

        return $dreamList;
    }

    public function searchByIdDream() {
        $idDream = $this->_id();
        $params = [
            'index' => $this->_index,
            'type' => $this->_type,
            'id' => $idDream
        ];

        $dream = (object) $this->_db->get($params);

        return $dream;
    }

    public function deleting() {
        $params = [
            'index' => $this->_index,
            'type' => $this->_type,
            'id' => $this->_id()
        ];

        return $this->_db->deleting($params);
    }

    public function updating() {
        $params = [
            'index' => $this->_index,
            'type' => $this->_type,
            'id' => $this->_id(),
            'body' => [
                'doc' => [
                    'fields' => [
                        'idUser' => $_SESSION['idUser'],
                        'date' => $this->_date(),
                        'hour' => $this->_hour(),
                        'content' => $this->_content(),
                        'previousEvents' => $this->_previousEvents(),
                        'elaboration' => $this->_elaboration()
                    ]
                ]
            ]
        ];

        return $this->_db->updating($params);
    }

    //a supprimer
    public function dede() {
        $params = ['index' => 'dreams'];
        $this->_db->dede($params);
    }


    public function deleteAccount() {
        $params = [
            'index' => $this->_index,
            'type' => $this->_type,
            'body' => [
                'query' => [
                    'term' => [
                        'fields.idUser' => $_SESSION['idUser']
                    ]
                ]
            ]
        ];

        return $this->_db->deleteByQuery($params);
    }

    public function searchWord() {
       $searchedWord = htmlspecialchars($_POST['search-txt']);

        $params = [
            'index' => $this->_index,
            'type' => $this->_type,
            'body' => [
                'query' => [
                    'bool' => [
                        'must' => [ //TODO a test must suivant resulta
                            'multi_match' => [
                                'query' => $searchedWord,
                                'type' => 'most_fields',
                                'analyzer' => 'french_heavy',
                                'fields' => ['content', 'elaboration', 'previousEvents'],


                            ]
                        ],

                        'filter' => [
                            'term' => [
                               'idUser' => $_SESSION['idUser']
                            ]                        ]




                    ]
                ]
            ]
        ];
        return $this->_db->search($params);
    }



    public function searchPhrase() {

    }

    public function mapping() {

            $params = [
                'index' => 'dreams',
                'body' => [
                    'settings' => [
                        'number_of_shards' => 3,
                        'number_of_replicas' =>2,
                        'analysis' => [
                            'filter' => [
                                'french_elision' => [
                                    'type' => 'elision',
                                    'article_case' => true,
                                    'articles' => ['l', 'm', 't', 'qu', 'n', 's', 'j', 'd', 'c', 'jusqu', 'quoiqu', 'lorsqu', 'puisqu' ]
                                ],
                                'french_stemmer' => [
                                    'type' => 'stemmer',
                                    'language' => 'light_french'
                                ]
                            ],
                            'analyzer' => [
                                'french_heavy' => [
                                    'tokenizer' => 'icu_tokenizer',
                                    'filter' => [
                                        'french_elision',
                                        'icu_folding',
                                        'lowercase',
                                        'french_stemmer'
                                    ]
                                ]
                            ]
                        ]

                    ],
                    'mappings' => [

                        'dream' => [
                            'properties' => [ //properties is necessary
                                'idUser' => [
                                    'type' => 'integer'
                                ],
                                'date' => [
                                    'type' => 'date'
                                ],
                                'hour' => [
                                    'type' => 'text'
                                ],
                                'content' => [
                                    'type' => 'text',
                                    'analyzer' => 'french_heavy'
                                ],
                                'elaboration' => [
                                    'type' => 'text',
                                    'analyzer' => 'french_heavy'
                                ],
                                'previousEvents' => [
                                    'type' => 'text',
                                    'analyzer' => 'french_heavy'

                                ]
                            ]
                        ]
                    ]
                ]
            ];

            $this->_db->mapping($params);
    }


}