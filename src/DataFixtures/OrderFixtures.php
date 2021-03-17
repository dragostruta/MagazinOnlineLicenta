<?php

namespace App\DataFixtures;

use App\Entity\Order;
use App\Entity\OrderList;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class OrderFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $date = new \DateTime('@'.strtotime('now'));

        for($i=1;$i<11;$i++){

            $u = new User();
            $u->setFirstName('fist_name'.$i);
            $u->setLastName('last_name: '.$i);
            $u->setEmail('email: '.$i);
            $u->setCountry('country: '.$i);
            $u->setCity('city: '.$i);
            $u->setRegion('region: '.$i);
            $u->setAdress('adress: '.$i);
            $u->setZipcode(mt_rand(40000, 50000));
            $u->setAge(mt_rand(18,70));
            $u->setPhone(mt_rand(700000000, 800000000));
            $u->setUsername('username: '.$i);
            $u->setPassword('password: '.$i);

            $ol = new OrderList();
            $ol->setQuantity(mt_rand(1, 5));
            $ol->setPrice(mt_rand(1.00, 10000.00));
            $quantity = $ol->getQuantity($ol);
            $price = $ol->getPrice($ol);
            $total = $quantity*$price;

            $ol->setTotal($total);

            $o = new Order();
            $o->setDate($date);
            $o->setOrderList($ol);
            $o->setUser($u);

            $manager->persist($o);
            $manager->persist($u);
        }

        $manager->flush();
    }
}
