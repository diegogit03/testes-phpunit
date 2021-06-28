<?php

namespace FidelityProgramBundle\Service;

use FidelityProgramBundle\Repository\PointsRepository;
use FidelityProgramBundle\Service\FidelityProgramService;
use MyFramework\LoggerInterface;
use OrderBundle\Entity\Customer;
use PHPUnit\Framework\TestCase;

class FidelityProgramServiceTest extends TestCase
{
    /**
     * @test
     */
    public function shouldSaveWhenReceivePoints()
    {
        // Mock
        $pointsRepository = $this->createMock(PointsRepository::class);
        $pointsRepository->expects($this->once())
            ->method('save');

        // Stub
        $pointsCalculator = $this->createMock(PointsCalculator::class);
        $pointsCalculator->method("calculatePointsToReceive")
            ->willReturn(100);
    
        // Spy
        $allMessages = [];
        $logger = $this->createMock(LoggerInterface::class);
        $logger->method("log")
            ->will($this->returnCallback(
                function($message) use(&$allMessages) {
                    $allMessages[] = $message;
                }
            ));

        $fidelityProgramService = new FidelityProgramService($pointsRepository, $pointsCalculator, $logger);

        // Dummy
        $customer = $this->createMock(Customer::class);
        $value = 50;

        $fidelityProgramService->addPoints($customer, $value);
        $expectedMessages = [
            "Checking points for customer",
            "Customer received points"
        ];
        $this->assertEquals($expectedMessages, $allMessages);
    }

    
    public function shouldNotSaveWhenReceiveZeroPoints()
    {
        // Mock
        $pointsRepository = $this->createMock(PointsRepository::class);
        $pointsRepository->expects($this->never())
            ->method("save");

        // Stub
        $pointsCalculator = $this->createMock(PointsCalculator::class);
        $pointsCalculator->method("calculatePointsToReceive")
            ->willReturn(0);
        
        $fidelityProgramService = new FidelityProgramService($pointsRepository, $pointsCalculator, $logger);

        // Dummy
        $customer = $this->createMock(Customer::class);
        $value = 50;

        $fidelityProgramService->addPoints($customer, $value);
    }
}
