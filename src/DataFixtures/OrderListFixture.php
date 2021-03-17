<?php

namespace App\DataFixtures;

use App\Entity\OrderList;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class OrderListFixture extends Fixture
{

    public function load(ObjectManager $manager)
    {

//        for ($i=1;$i<11;$i++){
//
//            $ol = new OrderList();
//            $ol->setQuantity(mt_rand(1, 5));
//            $ol->setPrice(mt_rand(1.00, 10000.00));
//            $qunatity = $ol->getQuantity($ol);
//            $price = $ol->getPrice($ol);
//
//            $total = $qunatity*$price;
//
//            $ol->setTotal($total);
//
//            $manager->persist($ol);
//        }

        $manager->flush();
    }
}
