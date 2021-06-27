<?php

namespace FidelityProgramBundle\Service;

use FidelityProgramBundle\Repository\PointsRepository;
use FidelityProgramBundle\Service\FidelityProgramService;
use OrderBundle\Entity\Customer;
use PHPUnit\Framework\TestCase;

class FidelityProgramServiceTest extends TestCase
{
    /**
     * @test
     */
    public function shouldSaveWhenReceivePoints()
    {
        $pointsRepository = $this->createMock(PointsRepository::class);
        $pointsRepository->expects($this->once())
            ->method('save');

        $pointsCalculator = $this->createMock(PointsCalculator::class);
        $pointsCalculator->method("calculatePointsToReceive")
            ->willReturn(100);
        
        $fidelityProgramService = new FidelityProgramService($pointsRepository, $pointsCalculator);

        $customer = $this->createMock(Customer::class);
        $value = 50;

        $fidelityProgramService->addPoints($customer, $value);
    }

    /**
     * @test
     */
    public function shouldNotSaveWhenReceiveZeroPoints()
    {
        $pointsRepository = $this->createMock(PointsRepository::class);
        $pointsRepository->expects($this->never())
            ->method("save");

        $pointsCalculator = $this->createMock(PointsCalculator::class);
        $pointsCalculator->method("calculatePointsToReceive")
            ->willReturn(0);
        
        $fidelityProgramService = new FidelityProgramService($pointsRepository, $pointsCalculator);

        $customer = $this->createMock(Customer::class);
        $value = 50;

        $fidelityProgramService->addPoints($customer, $value);
    }
}
