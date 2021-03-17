<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class UserFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
//       for($i = 1; $i < 11; $i++) {
//
//           $u = new User();
//           $u->setFirstName('fist_name'.$i);
//           $u->setLastName('last_name: '.$i);
//           $u->setEmail('email: '.$i);
//           $u->setCountry('country: '.$i);
//           $u->setCity('city: '.$i);
//           $u->setRegion('region: '.$i);
//           $u->setAdress('adress: '.$i);
//           $u->setZipcode(mt_rand(40000, 50000));
//           $u->setAge(mt_rand(18,70));
//           $u->setPhone(mt_rand(1, 10));
//           $u->setUsername('username: '.$i);
//           $u->setPassword('password: '.$i);
//
//           $manager->persist($u);
//       }
        $manager->flush();
    }
}
