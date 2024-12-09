<?php

namespace App\DataFixtures;

use App\Entity\EntityName;
use App\Entity\Picture;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ProductPictureFixture extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $data = json_decode(file_get_contents(__DIR__ . '/Data/products.json'), true);

        foreach ($data as $product) {
            $picture = new Picture();

            $entityName = new EntityName();
            $entityName->setName('product');

            $manager->persist($entityName);

            $picture->setEntityName($entityName);
            $picture->setItemId($product['id']);
            $picture->setOriginal('shoe'.$product['id'].'.jpg');
            $picture->setSmall(null);
            $picture->setBig(null);

            $manager->persist($picture);
        }
        $manager->flush();
    }
}
