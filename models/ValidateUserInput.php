<?php

namespace App\models;

use Rakit\Validation\Validator;

/**
 * Validate inputs values provided by the user.
 */
class ValidateUserInput extends ValidationTable
{
    /**
     * Validate provided inputs according to the crud method and the table provided.
     *
     * @param $rawInputs - Array of raw input. Typically, $_POST
     * @param $crudMethod - create|read|update|delete
     * @param $table - table to query
     * @return null|[]
     */
    public function validate($rawInputs, $crudMethod, $table){
        $validationTable = $this->getValidationTable($crudMethod, $table);

        if (method_exists($this, $validationTable)) {

            $table = $this->$validationTable();

            return $this->validateData($rawInputs, $table);
        }

        return NULL;
    }

    /**
     * Get the
     * @param $crudMethod
     * @param $table
     * @return string
     */
    private function getValidationTable($crudMethod, $table) {
        return 'get'.ucfirst($crudMethod).ucfirst($table).'Table';
    }

    /**
     * @param $rawInputs
     * @param $table
     * @return null
     */
    private function validateData($rawInputs, $table) {

        $validator = new Validator();
        $validation = $validator->validate($rawInputs, $table);

        if($validation->fails()) {
            return NULL;
        } else {
            return $rawInputs;
        }
    }
}