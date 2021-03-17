<?php

namespace App\DataFixtures;

use App\Entity\Category;
use App\Entity\News;
use App\Entity\Order;
use App\Entity\OrderList;
use App\Entity\Product;
use App\Entity\ProductCategory;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ProductFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        for ($i=1;$i<11;$i++){
            $date = new \DateTime('@'.strtotime('now'));

            $user = new User();
            $user->setFirstName('fist_name'.$i);
            $user->setLastName('last_name: '.$i);
            $user->setEmail('email: '.$i);
            $user->setCountry('country: '.$i);
            $user->setCity('city: '.$i);
            $user->setRegion('region: '.$i);
            $user->setAdress('adress: '.$i);
            $user->setZipcode(mt_rand(40000, 50000));
            $user->setAge(mt_rand(18,70));
            $user->setPhone(mt_rand(700000000, 800000000));
            $user->setUsername('username: '.$i);
            $user->setPassword('password: '.$i);

            $orderList = new OrderList();
            $orderList->setQuantity(mt_rand(1, 5));
            $orderList->setPrice(mt_rand(1.00, 10000.00));
            $qunatity = $orderList->getQuantity($orderList);
            $price = $orderList->getPrice($orderList);
            $total = $qunatity*$price;
            $orderList->setTotal($total);

            $order = new Order();
            $order->setDate($date);
            $order->setOrderList($orderList);
            $order->setUser($user);

            $category = new Category();
            $category->setName('categorie ' . $i);

            $productCategory = new ProductCategory();
            $productCategory->setName('name: '.$i);
            $productCategory->setCategory($category);

            $news = new News();
            $news->setTitle('title: '.$i);
            $news->setDescription('description: '.$i);
            $news->setImage('image: '.$i);
            $news->setDate($date);

            $product = new Product();
            $product->setTitle("title: ".$i);
            $product->setBrand("brand: ",$i);
            $product->setDescription("description..");
            $product->setPrice(mt_rand(50,1000));
            $product->setImage('image: '.$i);
            $product->setNews($news);
            $product->setProductCategory($productCategory);
            $product->setOrderList($orderList);

            $manager->persist($product);
            $manager->persist($news);
            $manager->persist($productCategory);
            $manager->persist($category);
            $manager->persist($orderList);
            $manager->persist($order);
            $manager->persist($user);
        }

        $manager->flush();
    }
}
