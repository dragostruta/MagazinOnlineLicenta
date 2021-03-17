<?php

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CategoryFixture extends Fixture
{
    public function load(ObjectManager $manager)
    {

//        for ($i=1;$i<11;$i++) {
//            $c = new Category();
//            $c->setName('categorie ' . $i);
//
//            $manager->persist($c);
//        }
//        $manager->flush();
    }
}
