<?php

namespace App\models;

class ValidationTable
{
    protected function getCreateCompanyTable() {
        return [
            'reference' => 'required|regex:/^[a-zA-Z0-9][ A-Za-z0-9_-]*$/',
            'price' => 'required|numeric',
            'company' => 'required|regex:/^[a-zA-Z0-9][ A-Za-z0-9_-]*$/',
        ];
    }
}