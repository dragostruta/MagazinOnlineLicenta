<?php

namespace App\DataFixtures;

use App\Entity\Category;
use App\DataFixtures\CategoryFixture;
use App\Entity\ProductCategory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use function Composer\Autoload\includeFile;



class ProductCategoryFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $manager->flush();
    }
}
