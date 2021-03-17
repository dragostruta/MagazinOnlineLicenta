<?php

namespace App\DataFixtures;

use App\Entity\Category;
use App\DataFixtures\CategoryFixture;
use App\Entity\ProductCategory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use function Composer\Autoload\includeFile;



class ProductCategoryFixture extends Fixture
{
    public function load(ObjectManager $manager)
    {

//        for ($i=1;$i<11;$i++) {
//
//           $c = new Category();
//           $c->setName('categorie ' . $i);
//
//           $pc = new ProductCategory();
//           $pc -> setName('name: '.$i);
//            // $categoryRepository = $manager->getRepository(Category::class);
//            // $category = $categoryRepository->findOneBy(['id' => 102]);
//            // $category = $categoryRepository->findAll();
//            // dd($category);
//            $pc->setCategory($c);
//            $manager->persist($pc);
//            $manager->persist($c);
//        }
        $manager->flush();
    }
    public function getDependencies(): array
    {
        return array(
            CategoryFixture::class,
        );
    }
}
