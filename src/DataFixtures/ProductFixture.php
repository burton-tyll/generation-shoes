<?php

namespace App\DataFixtures;

use App\Entity\Product;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class ProductFixture extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $data = json_decode(file_get_contents(__DIR__ . '/Data/products.json'), true);

        foreach ($data as $key => $value) {
            $faker = Factory::create('fr_FR');
            $product = new Product();

            $product->setReference($faker->bothify('PRD-??###-####'));
            $product->setName($value['name']);
            $product->setDescription($value['description']);
            $product->setPrice($value['price']);
            $product->setReduction($value['reduction']);
            $product->setDiscountPrice($value['discount_price']);
            $product->setCreatedAt(new \DateTime($value['created_at']));

            $manager->persist($product);
        }

        $manager->flush();
    }
}
