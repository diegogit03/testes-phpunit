<?php

namespace OrderBundle\Validators\Test;

use OrderBundle\Validators\NumericValidator;

use PHPUnit\Framework\TestCase;

class NumericValidatorTest extends TestCase {

  /**
  * @dataProvider valueProvider
  */
  public function testisValid($value, $expectedResult) {

    $numericValidator = new NumericValidator($value);

    $isValid = $numericValidator->isValid();

    $this->assertEquals($expectedResult, $isValid);

  }

  public function valueProvider() {
    return [
      "ShouldBeValidWhenValueIsANumber" => [ "value" => 1, "expectedResult" => true ],
      "ShouldBeValidWhenValueIsAStringNumber" => [ "value" => '1', "expectedResult" => true ],
      "ShouldNotBeValidWhenValueIsAString" => [ "value" => "foo", "expectedResult" => false ],
      "ShouldNotBeValidWhenValueIsAEmptyString" => [ "value" => "", "expectedResult" => false ]
    ];
  }

}
