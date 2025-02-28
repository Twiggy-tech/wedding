<?php

namespace App\Resolvers;

use App\Entity\Drink;
use Doctrine\ORM\EntityManagerInterface;
use Overblog\GraphQLBundle\Definition\Resolver\QueryInterface;

readonly class DrinkResolver implements QueryInterface
{
    public function __construct(private EntityManagerInterface $em)
    {

    }

    /**
     * @return array<Drink>
     */
    public function drinks(): array
    {
        return $this->em->getRepository(Drink::class)->findAll();
    }
}