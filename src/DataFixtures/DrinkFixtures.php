<?php

namespace App\DataFixtures;

use App\Entity\Drink;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class DrinkFixtures extends Fixture
{
    private const DRINKS = [
        'Я люблю безалкогольные напитки',
        'Шампанское',
        'Белое вино',
        'Красное вино',
        'Виски',
        'Водка',
    ];

    public function load(ObjectManager $manager): void
    {
        foreach (self::DRINKS as $drinkName) {
            $drink = (new Drink())
                ->setName($drinkName)
            ;
            $manager->persist($drink);
        }

        $manager->flush();
    }
}
