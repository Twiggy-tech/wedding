<?php

namespace App\Mutations;

use App\Entity\Guest;
use Doctrine\ORM\EntityManagerInterface;
use GraphQL\Error\Error;
use Overblog\GraphQLBundle\Definition\Argument;
use Overblog\GraphQLBundle\Definition\Resolver\MutationInterface;

readonly class GuestMutation implements MutationInterface
{
    public  function __construct(private EntityManagerInterface $em)
    {
    }

    /**
     * @throws Error
     */
    public function editGuest(Argument $args): array
    {
        $id = $args['input']['id'];
        $willAttend = $args['input']['willAttend'];

        $guest = $this->em->getRepository(Guest::class)->findOneBy(['id' => $id]);
        if (!$guest) {
            throw new Error("Guest $id not found");
        }

        $guest->setWillAttend($willAttend);
        $this->em->flush();

        return ['guest' => $guest];
    }
}