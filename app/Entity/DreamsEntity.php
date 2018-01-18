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

        $datas = $this->prepare(
            "SELECT idDreams, dateDreams, hourDreams FROM $table
            WHERE idUserDreams = '{$idUser}'
            ORDER BY dreams.dateDreams DESC"
        );

        if(!empty($datas)) {
            $datas = $this->_dateTimeFr($datas);
        }

        return $datas;
    }

    public function readDream($idDream) {
        $idUser = $_SESSION['idUser'];
        $table = $this->_table;
        $datas = $this->prepare(
            "SELECT idDreams, idUserDreams, dateDreams, hourDreams, dreamDreams, previousEventsDreams, elaborationDreams FROM $table
            WHERE idDreams = '{$idDream}'"
        );
        $dreamFr = $this->_dateTimeFr($datas);
        return $dreamFr;
    }

    public function listDreams($idUser) {
        $table = $this->_table;
        return $this->prepare(
            "SELECT idDreams FROM $table 
              WHERE idUserDreams = '{$idUser}'"
        );
    }


    private function _dateTimeFr($datas) {

        for($i = 0 ; $i < count($datas); $i++) {

            $date = new \DateTime($datas[$i]->dateDreams);
            $dateFr = new \IntlDateFormatter('fr_FR', \IntlDateFormatter::FULL, \IntlDateFormatter::NONE);
            $datas[$i]->dateDreamsFr = $dateFr->format($date);

            $time = $datas[$i]->hourDreams;
            $hour = $time[0] . $time[1];
            $min = $time[3] . $time[4];

            if(($hour === "00") || ($hour === '01')) {
                $time = $time[0] . $time[1] . ' heure ' . $time[3] . $time[4] . ' minutes ';
            }
            else {
                $time = $time[0] . $time[1] . ' heures ' . $time[3] . $time[4]. ' minutes ';
            }

            if(($min === '00') || ($min === '01')) {
                $time = str_replace('minutes', 'minute', $time);
            }

            $datas[$i]->hourDreamsFr = $time;
        }


        return $datas;
    }

    public function updatedDream($idDream, $dream, $date, $hour, $elaboration, $previousEvents) {

        $idUser = $_SESSION['idUser'];
        $table = $this->_table;
        return $this->update(
            ("UPDATE $table 
            SET dreamDreams = :dream, dateDreams = :dateUpdated, hourDreams = :hourUpdated, elaborationDreams =:elaboration, previousEventsDreams = :previousEvents
            WHERE idDreams = '{$idDream}' AND  idUserDreams = '{$idUser}'
            "),
            (array(
                'dream' => $dream,
                'dateUpdated' => $date,
                'hourUpdated' => $hour,
                'elaboration' => $elaboration,
                'previousEvents' => $previousEvents
            ))
        );
    }

    public function deleteDream($idDream) {
        $table = $this->_table;
        echo $idDream. 'icicicic';
        $idUser = $_SESSION['idUser'];
        return $this->delete("DELETE FROM $table WHERE idDreams = '{$idDream}' AND idUserDreams = '{$idUser}'");
    }


    //ELASTIC A SUPPRIMER
    public function lastDream($idUser) {
        $table = $this->_table;
        return $this->prepare("SELECT * FROM $table WHERE idUserDreams = '{$idUser}' ORDER BY idDreams DESC LIMIT 1");
    }

}