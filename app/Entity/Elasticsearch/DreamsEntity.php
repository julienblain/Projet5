<?php
namespace App\Entity\Elasticsearch;

use Core\Database\Elasticsearch;

class DreamsEntity
{
    private $_db;
    private $_index = 'dreams';
    private $_type = 'dream';

    public function __construct()
    {
        $this->_db = new Elasticsearch();

    }

    public function indexing($dream) {
        $params = [
            'index' => $this->_index,
            'type' => $this->_type,
            'id' => $dream[0]->idDreams,
            'body' => ['fields' => [
                'idUserDreams' => $dream[0]->idUserDreams,
                'dateDreams' => $dream[0]->dateDreams,
                'hourDreams' => $dream[0]->hourDreams,
                'dreamDreams' => $dream[0]->dreamDreams,
                'previousEventsDreams' => $dream[0]->previousEventsDreams,
                'elaborationDreams' => $dream[0]->elaborationDreams
            ]]
        ];

        return $this->_db->indexing($params);
    }

    public function deleting($idDream) {
        $params = [
            'index' => $this->_index,
            'type' => $this->_type,
            'id' => $idDream
        ];

        return $this->_db->deleting($params);
    }

    public function updating($idDream, $dream, $date, $hour, $elaboration, $previousEvents) {
        $params = [
            'index' => $this->_index,
            'type' => $this->_type,
            'id' => $idDream,
            'body' => ['doc' => [
                'idUserDreams' => $_SESSION['idUser'],
                'dateDreams' => $date,
                'hourDreams' => $hour,
                'dreamDreams' => $dream,
                'previousEventsDreams' => $previousEvents,
                'elaborationDreams' => $elaboration
            ]]
        ];

        return $this->_db->updating($params);

    }

    public function search() {
        $searchedWord = htmlspecialchars($_POST['search']);
        echo $searchedWord .' mot';

        $params = [
            'index' => $this->_index,
            'type' => $this->_type,
            'body' => [
                'query' => [
                    'match' => [
                        'fields' => [
                            'dreamDreams' => $searchedWord
                        ]


                    ]
                ]
            ]
        ];

        $resultat = $this->_db->search($params);
        var_dump($resultat);
    }
}