<?php

namespace App\DataFixtures;

use App\Entity\Room;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $room = new Room();
        $room->setRoomNumber(696969);

        $manager->persist($room);
        $manager->flush();
    }
}
