<?php

namespace App\DataFixtures;

use App\Entity\Room;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class RoomFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for ($i = 1; $i <= 5; $i++) {
            $room = new Room();
            $room->setNumber(100 + $i);
            $room->setType('Single');
            $room->setDescription('Pokój numer ' . (100 + $i));
            $room->setPrice(150.00);
            $manager->persist($room);
        }

        $manager->flush();
    }
}
