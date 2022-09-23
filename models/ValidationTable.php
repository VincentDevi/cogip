<?php

namespace App\models;

class ValidationTable
{
    /**
     * Return the name of the method according to the provided crud method and tha table.
     *
     * @param $crudMethod
     * @param $table
     * @return string
     */
    protected function getTableMethodName($crudMethod, $table) {
        return 'get'.ucfirst($crudMethod).ucfirst($table).'Table';
    }

    /**
     * Return rules table for create company.
     *
     * @return string[]
     */
    protected function getCreateCompanyTable() {
        return [
            'reference' => 'required|regex:/^[a-zA-Z0-9][ A-Za-z0-9_-]*$/',
            'price' => 'required|numeric',
            'company' => 'required|regex:/^[a-zA-Z0-9][ A-Za-z0-9_-]*$/',
        ];
    }
}