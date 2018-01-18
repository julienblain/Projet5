<?php


namespace App\Entity;



use Core\Entity\Entity;

class TmpEntity extends Entity
{
    private $_table = 'tmp';

    public function alreadyExistingAccount($mail) {
        $table = $this->_table;
        return $this->prepare("SELECT * FROM $table WHERE mailTmp =  '{$mail}'");
    }

    public function updateAccount($mail, $password, $validationKey) {
        $table = $this->_table;
        return $this->update(
            ("UPDATE $table
            SET passwordTmp = :password, keyTmp = :validationKey, tryValidationTmp = tryValidationTmp + 1
            WHERE mailTmp = '{$mail}'"),
            (array(
                'password' => $password,
                'validationKey' => $validationKey
            ))
        );
    }

    public function createAccount($mail, $password, $validationKey) {

        $table = $this->_table;
        return $this->insertInto(
            ("INSERT INTO $table(mailTmp, passwordTmp, keyTmp)
                  VALUES(:mail, :password, :keyValidation)"),

            (array(
                'mail' => $mail,
                'password' => $password,
                'keyValidation' => $validationKey
            ))
        );
    }

    public function verifCreatingAccount($mail) {
        $table = $this->_table;
        $datas =  $this->prepare(
            "SELECT idTmp, keyTmp, mailTmp, passwordTmp  FROM $table
         WHERE tmp.mailTmp = '{$mail}' "
        );
        return $datas;
    }

    public function deleteByIdTmp($id) {
        $table = $this->_table;
        return $this->delete(
            "DELETE FROM $table WHERE idTmp = '{$id}'"
        );

    }

}