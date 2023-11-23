<?php

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CategoryFixtures extends Fixture
{
    private const NB_CATEGORIES = 4;
    public function load(ObjectManager $manager): void
    {

        for ($i = 0; $i < self::NB_CATEGORIES; $i++) {
            $category = new Category();
            $category->setName("Category $i");
            $manager->persist($category);
        }


        $manager->flush();
    }
}
