<?php

namespace OrderBundle\Validators\Test;

use OrderBundle\Validators\CreditCardNumberValidator;

use PHPUnit\Framework\TestCase;

class CreditCardNumberValidatorTest extends TestCase {

  /**
  * @dataProvider valueProvider
  */
  public function testisValid($value, $expectedResult) {

    $creditCardNumberValidator = new CreditCardNumberValidator($value);

    $isValid = $creditCardNumberValidator->isValid();

    $this->assertEquals($expectedResult, $isValid);

  }

  public function valueProvider() {
    return [
      "ShouldBeValidWhenValueIsACreditCard" => [ "value" => 5431059966267613, "expectedResult" => true ],
      "ShouldBeValidWhenValueIsACreditCardString" => [ "value" => "5431059966267613", "expectedResult" => true ],
      "ShouldNotBeValidWhenValueIsNotACreditCard" => [ "value" => 123325, "expectedResult" => false ],
      "ShouldNotBeValidWhenValueIsEmptyString" => [ "value" => "", "expectedResult" => false ]
    ];
  }

}
