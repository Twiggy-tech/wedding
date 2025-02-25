<?php

namespace App\Resolvers;

use App\Entity\Guest;
use Doctrine\ORM\EntityManagerInterface;
use Overblog\GraphQLBundle\Definition\Argument;
use Overblog\GraphQLBundle\Definition\Resolver\QueryInterface;

readonly class GuestResolver implements QueryInterface
{
    public function __construct(private EntityManagerInterface $em)
    {

    }

    public function guest(Argument $args): ?Guest
    {
        return $this->em->getRepository(Guest::class)->findOneBy(['token' => $args['token']]);
    }
}