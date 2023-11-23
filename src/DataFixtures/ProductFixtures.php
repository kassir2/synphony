<?php

namespace App\DataFixtures;

use App\Entity\Category;
use App\Entity\Category_test;
use App\Entity\Product;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ProductFixtures extends Fixture
{
    private const NB_PRODUCTS = 20;

    public function load(ObjectManager $manager): void
    {
        $category_test = new Category();
        $category_test->setName('Art');
        $manager->persist($category_test);
        $manager->flush();

        $list_images = ["e.jpg", "pierres.jpg", "macbook_air.jpg", "sony_alpha7.webp", "gpu.png", "o.jpg", "s.png", "ta.jpg", "test.jpg", "u.jpg"];

        for ($i = 0; $i < self::NB_PRODUCTS; $i++) {
            $product = new Product();
            $product->setName("Product $i")
                ->setPrice(mt_rand(1, 999))
                ->setQuantity(mt_rand(0, 10))
                ->setPhotoName($list_images[array_rand($list_images, 1)])
                ->setDescription("Description for product $i")
                ->setCategory($category_test);

            $manager->persist($product);
        }

        $manager->flush();
    }
}