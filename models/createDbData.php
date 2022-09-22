<?php

namespace App\models;


class createDbData extends Dbh
{
    public function createData($table, $formArray){
        $con = $this->connexion();

    }
    private function createQuery($table,$array){
        if ( $table ==="invoices"){
            $query="";
        }elseif ( $table === "contacts"){
            $query = "";
        }else{
            $query = "";
        }
        return $query;
    }

    private function validateInvoices(){

    }
    private function validateCompanies(){

    }
    private function validateContacts(){

    }
}