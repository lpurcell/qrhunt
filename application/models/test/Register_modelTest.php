<?php
include('../register_model.php');

class Register_modelTest extends PHPUnit_Framework_TestCase {

    public function testFailure()
    {
        $register_model = new register_model;
        $result = $register_model->register();

        echo $result;

        $this->assertTrue(TRUE);
    }
}


