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
    protected function getTableMethodName($table) {
        return 'get'.ucfirst($table).'Table';
    }

    /**
     * Return rules table for create invoice.
     *
     * @return string[]
     */
    protected function getInvoiceTable() {
        return [
            'reference' => 'required|regex:/^[a-zA-Z0-9][ A-Za-z0-9_-]*$/',
            'company_id' => 'required|numeric',
            'due_date' => 'required|date',// default : Y-m-d
            'type' => 'required|numeric',
            'id' => 'numeric'
        ];
    }

    /**
     * Return rules table for create company.
     *
     * @return string[]
     */
    protected function getCompanyTable() {
        return [
            'name' => 'required|regex:/^[a-zA-Z0-9][ A-Za-z0-9_-]*$/',
            'country' => 'required|regex:/^[a-zA-Z0-9][ A-Za-z0-9_-]*$/',
            // todo : enhance tva regex.
            'vat' => 'required|numeric',
            'phone' => 'required|regex:/^\d{2}(?: ?\d+)*$/',//https://stackoverflow.com/questions/6028553/regex-allowing-spaces-for-a-phone-number-regex
        ];
    }

    /**
     * Return rules table for create contact.
     *
     * @return string[]
     */
    protected function getContactTable() {
        return [
            'name' => 'required|regex:/^[a-zA-Z0-9][ A-Za-z0-9_-]*$/',
            'firstname' => 'required|regex:/^[a-zA-Z0-9][ A-Za-z0-9_-]*$/',
            'email' => 'required|email',
            'phone' => 'required|regex:/^\d{2}(?: ?\d+)*$/',
            'company_id' => 'required|numeric',
            'contact_id' => 'numeric',
        ];
    }
}