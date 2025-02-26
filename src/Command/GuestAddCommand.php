<?php

namespace App\Command;

use App\Entity\Guest;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'app:guest-add',
    description: 'Add a short description for your command',
)]
class GuestAddCommand extends Command
{
    public function __construct(private readonly EntityManagerInterface $em)
    {
        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->addArgument('firstName', InputArgument::REQUIRED)
            ->addArgument('surname', InputArgument::REQUIRED)
            ->addArgument('willAttendMainCeremony', InputArgument::REQUIRED)
            ->addArgument('gender', InputArgument::REQUIRED)
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $firstName = $input->getArgument('firstName');
        $surname = $input->getArgument('surname');
        $willAttendMainCeremony = $input->getArgument('willAttendMainCeremony');
        $gender = $input->getArgument('gender');


        $guest = new Guest(
            $firstName,
            $surname,
            $willAttendMainCeremony,
            $gender,
        );
        $this->em->persist($guest);

        $this->em->flush();

        $tokenData = json_encode([
            'id' => $guest->getId(),
            'firstName' => $guest->getFirstName(),
            'surname' => $guest->getSurname(),
        ]);

        $hash = hash('sha3-256', $tokenData, true);
        $base64 = base64_encode($hash);
        $urlSafe = strtr($base64, '+/', '-_');

        $guest->setToken(substr(rtrim($urlSafe, '='), 0, 32));

        $this->em->flush();

        $io->success('Successfully added a guest.');

        return Command::SUCCESS;
    }
}
