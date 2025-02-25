<?php

namespace App\DataFixtures;

use App\Entity\Guest;
use App\Enums\GuestGenderEnum;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class GuestFixtures extends Fixture
{
    private const GUESTS = [
        [
            'firstName' => 'Наталия и Дмитрий',
            'surname' => 'Самойловы',
            'willAttendMainCeremony' => true,
            'gender' => GuestGenderEnum::Multiple->value,
        ],
        [
            'firstName' => 'Татьяна и Артем',
            'surname' => 'Самойловы',
            'willAttendMainCeremony' => true,
            'gender' => GuestGenderEnum::Multiple->value,
        ],
        [
            'firstName' => 'Мария',
            'surname' => 'Колесникова',
            'willAttendMainCeremony' => true,
            'gender' => GuestGenderEnum::Woman->value,
        ],
        [
            'firstName' => 'Евгений',
            'surname' => 'Самойлов',
            'willAttendMainCeremony' => true,
            'gender' => GuestGenderEnum::Man->value,
        ],
        [
            'firstName' => 'Олег',
            'surname' => 'Букреев',
            'willAttendMainCeremony' => true,
            'gender' => GuestGenderEnum::Man->value,
        ],
        [
            'firstName' => 'Надежда и Юрий',
            'surname' => 'Рыбины',
            'willAttendMainCeremony' => false,
            'gender' => GuestGenderEnum::Multiple->value,
        ],
        [
            'firstName' => 'Артем и Кристина',
            'surname' => 'Рыбины',
            'willAttendMainCeremony' => false,
            'gender' => GuestGenderEnum::Multiple->value,
        ],
        [
            'firstName' => 'Артем и Виктория',
            'surname' => 'Поленниковы',
            'willAttendMainCeremony' => false,
            'gender' => GuestGenderEnum::Multiple->value,
        ],
        [
            'firstName' => 'Александр',
            'surname' => 'Турыгин',
            'willAttendMainCeremony' => false,
            'gender' => GuestGenderEnum::Man->value,
        ],
        [
            'firstName' => 'Валерий',
            'surname' => 'Ромм',
            'willAttendMainCeremony' => false,
            'gender' => GuestGenderEnum::Man->value,
        ],
        [
            'firstName' => 'Елена',
            'surname' => 'Коллесникова',
            'willAttendMainCeremony' => true,
            'gender' => GuestGenderEnum::Woman->value,
        ],
        [
            'firstName' => 'Оксана и Александр',
            'surname' => 'Шарафутдиновы',
            'willAttendMainCeremony' => true,
            'gender' => GuestGenderEnum::Multiple->value,
        ],
        [
            'firstName' => 'Юрий и Лариса',
            'surname' => 'Глухих',
            'willAttendMainCeremony' => true,
            'gender' => GuestGenderEnum::Multiple->value,
        ],
        [
            'firstName' => 'Анна',
            'surname' => 'Глухих',
            'willAttendMainCeremony' => true,
            'gender' => GuestGenderEnum::Woman->value,
        ],
        [
            'firstName' => 'Гельфиса',
            'surname' => 'Жигулина',
            'willAttendMainCeremony' => true,
            'gender' => GuestGenderEnum::Woman->value,
        ],
        [
            'firstName' => 'Наталья и Евгений',
            'surname' => 'Карякины',
            'willAttendMainCeremony' => false,
            'gender' => GuestGenderEnum::Multiple->value,
        ],
        [
            'firstName' => 'Роман',
            'surname' => 'Карякин',
            'willAttendMainCeremony' => false,
            'gender' => GuestGenderEnum::Man->value,
        ],
        [
            'firstName' => 'Марина и Данил',
            'surname' => 'Малышевы',
            'willAttendMainCeremony' => false,
            'gender' => GuestGenderEnum::Multiple->value,
        ],
        [
            'firstName' => 'Екатерина',
            'surname' => 'Ушкова',
            'willAttendMainCeremony' => false,
            'gender' => GuestGenderEnum::Woman->value,
        ],
        [
            'firstName' => 'Любовь',
            'surname' => 'Донцова',
            'willAttendMainCeremony' => false,
            'gender' => GuestGenderEnum::Woman->value,
        ],
        [
            'firstName' => 'Надежда и Александр',
            'surname' => 'Яковлевы',
            'willAttendMainCeremony' => false,
            'gender' => GuestGenderEnum::Multiple->value,
        ],
        [
            'firstName' => 'Люция и Марсель',
            'surname' => 'Шарафутдиновы',
            'willAttendMainCeremony' => false,
            'gender' => GuestGenderEnum::Multiple->value,
        ],
    ];

    public function load(ObjectManager $manager): void
    {
        $guests = [];

        foreach (self::GUESTS as $guestData) {
            $guest = new Guest(
                $guestData['firstName'],
                $guestData['surname'],
                $guestData['willAttendMainCeremony'],
                $guestData['gender'],
            );
            $manager->persist($guest);

            $guests[] = $guest;
        }

        $manager->flush();

        foreach ($guests as $guest) {
            $tokenData = json_encode([
                'id' => $guest->getId(),
                'firstName' => $guest->getFirstName(),
                'surname' => $guest->getSurname(),
            ]);

            $hash = hash('sha3-256', $tokenData, true);
            $base64 = base64_encode($hash);
            $urlSafe = strtr($base64, '+/', '-_');

            $guest->setToken(substr(rtrim($urlSafe, '='), 0, 32));
        }

        $manager->flush();
    }
}
