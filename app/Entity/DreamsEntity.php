<?php


namespace App\Entity;
use Core\Entity\Entity;


class DreamsEntity extends Entity
{
    private $_table = 'dreams';

    public function createdDream($dream, $date, $hour, $elaboration, $eventsPrevious) {
        $idUser = $_SESSION['idUser'];
        $table = $this->_table;
        return $this->insertInto(
            ("INSERT INTO $table(idUserDreams, dateDreams, hourDreams, dreamDreams, previousEventsDreams, elaborationDreams)
              VALUES(:idUser, :dateDream, :hourDream, :dream, :previousEvents, :elaboration  )"),

            (array(
                'idUser' => $idUser,
                'dateDream' => $date,
                'hourDream' => $hour,
                'dream' => $dream,
                'previousEvents' => $eventsPrevious,
                'elaboration' => $elaboration
            ))
        );
    }

    public function dreamsByIdUser($idUser) {
        $table = $this->_table;

        return $this->prepare(
            "SELECT idDreams, dateDreams, hourDreams FROM $table
            WHERE idUserDreams = '{$idUser}'
            ORDER BY dreams.dateDreams DESC"
        );
    }

    public function readDream($idDream) {
        $idUser = $_SESSION['idUser'];
        $table = $this->_table;
        return $this->prepare(
            "SELECT dateDreams, hourDreams, dreamDreams, previousEventsDreams, elaborationDreams FROM $table
            WHERE idDreams = '{$idDream}'"
        );
    }

}