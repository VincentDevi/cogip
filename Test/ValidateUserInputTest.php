<?php

namespace App\Test;

use App\models\ValidateUserInput;

class ValidateUserInputTest
{

    function __construct() {
        $this->testCreateCompany();
    }

    public function testCreateCompany() {
        $rawInputs = [
            'reference' => 'A-2_1022',
            'price' => 3,
            'company' => 'my super-company',
        ];
        $crudMethod = 'create';
        $table = 'company';

        $validate = new ValidateUserInput();
        dd($validate->validate($rawInputs, $crudMethod, $table));

    }
}