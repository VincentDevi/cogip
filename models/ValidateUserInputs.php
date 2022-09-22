<?php

namespace App\models;

class ValidateUserInputs extends Validation
{
    public function __construct($rawInputs) {
        parent::__construct();

        return $this->getValidatedInputs($rawInputs);
    }

    private function getValidatedInputs($inputs) {
        $output = [];

        foreach ($inputs as $inputName => $inputValue) {
            if (method_exists($this, $inputName)) {
                $validatedInput = $this->$this->$$inputName($inputValue);

                // validation need to return NULL if not valid.
                if (!$validatedInput) {
                    return FALSE;
                }

                $output[$inputName] = $validatedInput;
            }
        }

        return $output;
    }
}