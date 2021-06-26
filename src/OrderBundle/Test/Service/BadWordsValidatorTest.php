<?php

namespace OrderBundle\Service;

use OrderBundle\Repository\BadWordsRepository;
use PHPUnit\Framework\TestCase;

class BadWordsValidatorTest extends TestCase
{
    /**
     * @test
     * @dataProvider hasBadWordsDataProvider
     */
    public function hasBadWords($badWordsList, $text, $foundBadWords)
    {
        $badWordsRepository = $this->createMock(BadWordsRepository::class);

        $badWordsRepository->method('findAllAsArray')
            ->willReturn($badWordsList);

        $badWordsValidator = new BadWordsValidator($badWordsRepository);

        $hasBadWords = $badWordsValidator->hasBadWords($text);

        $this->assertEquals($foundBadWords, $hasBadWords);
    }

    public function hasBadWordsDataProvider() {
        return [
            "shouldFindWhenHasBadWords" => [
                "badWordsList" => [ "bobo", "chule", "besta" ],
                "text" => "Seu restaurante é muito bobo",
                "foundBadWors" => true
            ],
            "shouldNotFindWhenHasNoBadWords" => [
                "badWordsList" => [ "bobo", "chule", "besta" ],
                "text" => "Trocar bata por salada",
                "foundBadWords" => false
            ],
            "shouldNotFindWhenTextIsEmpty" => [
                "badWordsList" => [ "bobo", "chule", "besta" ],
                "text" => "",
                "foundBadWords" => false
            ],
            "shouldNotFindWhenBadWordsListIsEmpty" => [
                "badWordsList" => [],
                "text" => "Trocar bata por salada",
                "foundBadWords" => false
            ]
        ];
    }
}
