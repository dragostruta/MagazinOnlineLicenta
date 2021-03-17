<?php

namespace App\DataFixtures;

use App\Entity\News;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use DateTimeInterface;

class NewsFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
//        for($i=1; $i<11; $i++){
//            $date = new \DateTime('@'.strtotime('now'));
//
//            $n = new News();
//            $n->setTitle('title: '.$i);
//            $n->setDescription('description: '.$i);
//            $n->setImage('image: '.$i);
//            $n->setDate($date);
//
//            $manager->persist($n);
//        }

        $manager->flush();
    }
}
