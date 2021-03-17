<?php

namespace App\DataFixtures;

use App\Entity\OrderList;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class OrderListFixtures extends Fixture
{

    public function load(ObjectManager $manager)
    {

        $manager->flush();
    }
}
