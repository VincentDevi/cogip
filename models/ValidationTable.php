<?php

namespace App\models;

class ValidationTable
{
    /**
     * Return the name of the method according to the provided crud method and tha table.
     * found regex here : https://ihateregex.io
     *
     * @param $crudMethod
     * @param $table
     * @return string
     */
    protected function getTableMethodName($crudMethod, $table) {
        return 'get'.ucfirst($crudMethod).ucfirst($table).'Table';
    }

    /**
     * Return rules table for create invoice.
     *
     * @return string[]
     */
    protected function getCreateInvoiceTable() {
        return [
            'reference' => 'required|regex:/^[a-zA-Z0-9][ A-Za-z0-9_-]*$/',
            'price' => 'required|numeric',
            'company' => 'required|regex:/^[a-zA-Z0-9][ A-Za-z0-9_-]*$/',
        ];
    }

    /**
     * Return rules table for create company.
     *
     * @return string[]
     */
    protected function getCreateCompanyTable() {
        return [
            'name' => 'required|regex:/^[a-zA-Z0-9][ A-Za-z0-9_-]*$/',
            'country' => 'required|regex:/^[a-zA-Z0-9][ A-Za-z0-9_-]*$/',
            // todo : enhance tva regex.
            'tva' => 'required|regex:numeric',
            'phone' => 'required|regex:/^\d{2}(?: ?\d+)*$/',//https://stackoverflow.com/questions/6028553/regex-allowing-spaces-for-a-phone-number-regex
        ];
    }

    /**
     * Return rules table for create contact.
     *
     * @return string[]
     */
    protected function getCreateContactTable() {
        return [
            'name' => 'required|regex:/^[a-zA-Z0-9][ A-Za-z0-9_-]*$/',
            'email' => 'required|email',
            'phone' => 'required|regex:/^\d{2}(?: ?\d+)*$/',
            'company' => 'required|regex:/^[a-zA-Z0-9][ A-Za-z0-9_-]*$/',
        ];
    }
}