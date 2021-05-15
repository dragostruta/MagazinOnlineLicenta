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
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{
    public function __construct(UserPasswordEncoderInterface $encoder){
        $this->encoder = $encoder;
    }
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
            $user->setPassword($this->encoder->encodePassword($user, '0000'));
            $user->setRoles('ROLE_USER');

            $orderList = new OrderList();
            $orderList->setQuantity(mt_rand(1, 5));
            $orderList->setPrice(mt_rand(1.00, 10000.00));
            $quantity = $orderList->getQuantity($orderList);
            $price = $orderList->getPrice();
            $total = $quantity * $price;
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
            $news->setImage('https://miro.medium.com/max/1200/1*mk1-6aYaf_Bes1E3Imhc0A.jpeg');
            $news->setDate($date);

            $product = new Product();
            $product->setTitle("title: ".$i);
            $product->setBrand("brand: ".$i);
            $product->setDescription("description..");
            $product->setPrice(mt_rand(50,1000));
            $product->setImage('https://miro.medium.com/max/1200/1*mk1-6aYaf_Bes1E3Imhc0A.jpeg');
            $product->setImageOne('https://miro.medium.com/max/1200/1*mk1-6aYaf_Bes1E3Imhc0A.jpeg');
            $product->setImageTwo('https://img-19.ccm2.net/8vUCl8TXZfwTt7zAOkBkuDRHiT8=/1240x/smart/b829396acc244fd484c5ddcdcb2b08f3/ccmcms-commentcamarche/20494859.jpg');
            $product->setImageThree('https://img-19.ccm2.net/8vUCl8TXZfwTt7zAOkBkuDRHiT8=/1240x/smart/b829396acc244fd484c5ddcdcb2b08f3/ccmcms-commentcamarche/20494859.jpg');
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

        $user->setFirstName('ADMIN');
        $user->setLastName('ADMIN');
        $user->setEmail('admin@admin.ro');
        $user->setCountry('TEST');
        $user->setCity('TEST');
        $user->setRegion('TEST');
        $user->setAdress('TEST');
        $user->setZipcode(00000);
        $user->setAge('99');
        $user->setPhone('000000000');
        $user->setUsername('admin');
        $user->setPassword($this->encoder->encodePassword($user, 'admin'));
        $user->setRoles('ROLE_ADMIN');

        $manager->flush();
    }
}
