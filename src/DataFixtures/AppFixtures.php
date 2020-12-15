<?php

namespace App\DataFixtures;

use App\Entity\Hunter;
use App\Entity\Room;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $hunter = new Hunter();
        $room = new Room();

        $hunter->setName("tristantheb");
        $room->setRoomNumber(696969)->setCreator($hunter);

        $manager->persist($hunter);
        $manager->persist($room);

        $manager->flush();
    }
}
