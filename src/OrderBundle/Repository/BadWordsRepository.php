<?php

namespace OrderBundle\Repository;

use OrderBundle\Repository\BadWordsRepositoryInterface;
use MyFramework\DataBase\ORM;

class BadWordsRepository extends ORM implements BadWordsRepositoryInterface
{
    public function findAllAsArray()
    {
        return parent::findAll();
    }
}