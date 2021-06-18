<?php

namespace OrderBundle\Test\Entity;

use OrderBundle\Entity\Customer;

use PHPUnit\Framework\TestCase;

class CustomerTest extends TestCase {

  /**
  * @dataProvider isAllowedToOrderDataProvider
  */
  public function testIsAllowedToOrder($isActive, $isBlocked, $expectedResult) {

    $customer = new Customer(
      $isActive,
      $isBlocked,
      'Diego Henrique de Oliveira Madero',
      '+5518997771800'
    );

    $isAllowed = $customer->isAllowedToOrder();

    $this->assertEquals($expectedResult, $isAllowed);

  }

  public function isAllowedToOrderDataProvider() {
    return [
      "ShouldBeAllowedWhenIsActiveAndNotBlocked" => [
        "isActive" => true,
        "isBlocked" => false,
        "expectedResult" => true
      ],
      "ShouldNotBeAllowedWhenIsNotActiveAndBlocked" => [
        "isActive" => false,
        "isBlocked" => true,
        "expectedResult" => false
      ],
      "ShouldNotBeAllowedWhenIsActiveButBlocked" => [
        "isActive" => true,
        "isBlocked" => true,
        "expectedResult" => false
      ],
      "ShouldNotBeAllowedWhenIsNotActiveAndNotBlocked" => [
        "isActive" => false,
        "isBlocked" => false,
        "expectedResult" => false
      ],
    ];
  }

}
