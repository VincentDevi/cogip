<?php

namespace App\models;

use Rakit\Validation\Validator;

/**
 * Validate inputs values provided by the user.
 *
 * E.g. :   $validate = new ValidateUserInput();
 *          print_r($validate->validate($rawInputs, $crudMethod, $table));
 */
class ValidateUserInput extends ValidationTable
{
    /**
     * Validate provided inputs according to the crud method and the table provided.
     * Return the provided Array if is valid.
     * Return False if is not valid.
     *
     * @param $rawInputs - Array of raw input. Typically, $_POST
     * @param $crudMethod - create|read|update|delete
     * @param $table - table to query
     * @return null|array
     */
    public function validate($rawInputs, $table){
        $validationTable = $this->getValidationTable($table);

        if ($validationTable) {
            return $this->validateData($rawInputs, $validationTable);
        }

        return NULL;
    }

    /**
     * Get the table with validation rules.
     *
     * @param $crudMethod
     * @param $table
     * @return string
     */
    private function getValidationTable($table) {
        $validationTable = $this->getTableMethodName($table);

        if (method_exists($this, $validationTable)) {
            return $this->$validationTable();
        }

        return NULL;
    }

    /**
     * Validate the provided data's with according rules table.
     *
     * @param $rawInputs
     * @param $table
     * @return null
     */
    private function validateData($rawInputs, $table) {
        $validator = new Validator();
        $validation = $validator->validate($rawInputs, $table);

        return !$validation->fails() ? $rawInputs : NULL;
    }
}