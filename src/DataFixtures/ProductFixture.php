<?php

namespace App\DataFixtures;

use App\Entity\Category;
use App\Entity\News;
use App\Entity\OrderList;
use App\Entity\Product;
use App\Entity\ProductCategory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ProductFixture extends Fixture
{
    public function load(ObjectManager $manager)
    {
        for ($i=1;$i<11;$i++){
            $date = new \DateTime('@'.strtotime('now'));

            $ol = new OrderList();
            $ol->setQuantity(mt_rand(1, 5));
            $ol->setPrice(mt_rand(1.00, 10000.00));
            $qunatity = $ol->getQuantity($ol);
            $price = $ol->getPrice($ol);
            $total = $qunatity*$price;
            $ol->setTotal($total);

            $c = new Category();
            $c->setName('categorie ' . $i);

            $pc = new ProductCategory();
            $pc->setName('name: '.$i);
            $pc->setCategory($c);

            $n = new News();
            $n->setTitle('title: '.$i);
            $n->setDescription('description: '.$i);
            $n->setImage('image: '.$i);
            $n->setDate($date);

            $p = new Product();
            $p->setTitle("title: ".$i);
            $p->setBrand("brand: ",$i);
            $p->setDescription("description..");
            $p->setPrice(mt_rand(50,1000));
            $p->setImage('image: '.$i);
            $p->setNews($n);
            $p->setProductCategory($pc);
            $p->setOrderList($ol);

            $manager->persist($p);
            $manager->persist($n);
            $manager->persist($pc);
            $manager->persist($c);
            $manager->persist($ol);
        }

        $manager->flush();
    }
}
