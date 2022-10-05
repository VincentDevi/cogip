<?php

namespace App\Test;

use App\models\ValidateUserInput;

class ValidateUserInputTest
{

    function __construct() {
        $this->testCreateInvoice();
    }

    public function testCreateInvoice() {
        $rawInputs = [
            'reference' => 'A-2_1022',
            'price' => 3,
            'company' => 'my super-company',
        ];
//        $crudMethod = 'create';
        $table = 'invoice';

        $validate = new ValidateUserInput();
        dd($validate->validate($rawInputs, $table));

    }
}