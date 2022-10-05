<?php

namespace App\models;


class createDbData extends Dbh
{
    /**
     *
     * @param $table
     * @param $arrayOfInput
     * @return void
     */
    public function createData($table,$arrayOfInput, $id=null){
        $con = $this->connexion();
        $stmt = $con->prepare($this->selectCreateQuery($table));
        $stmt->execute($this->createArrayExecute($table,$arrayOfInput));
        $stmt = null;
    }



    private function validateInvoices(){

    }
    private function validateCompanies(){

    }
    private function validateContacts(){

    }
}