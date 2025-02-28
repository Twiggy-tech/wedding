<?php

namespace App\Mutations;

use App\Entity\Drink;
use App\Entity\Guest;
use Doctrine\ORM\EntityManagerInterface;
use GraphQL\Error\Error;
use Overblog\GraphQLBundle\Definition\Argument;
use Overblog\GraphQLBundle\Definition\Resolver\MutationInterface;

readonly class DrinkMutation implements MutationInterface
{
    public  function __construct(private EntityManagerInterface $em)
    {
    }

    /**
     * @throws Error
     */
    public function select(Argument $args): array
    {
        $guestId = $args['input']['guestId'];
        $drinkIds = $args['input']['drinkIds'];

        $guest = $this->em->getRepository(Guest::class)->findOneBy(['id' => $guestId]);
        if (!$guest) {
            throw new Error("Guest $guestId not found");
        }

        $drinks = $this->em->getRepository(Drink::class)->findBy(['id' => $drinkIds]);

        $guest->setPreferredDrinks($drinks);

        $this->em->flush();

        return ['success' => true];
    }
}