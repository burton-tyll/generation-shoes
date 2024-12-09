<?php

namespace App\DataFixtures;

use App\Entity\EntityName;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\Persistence\ObjectManager;

class EntityNameFixture extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $data = json_decode(file_get_contents(__DIR__ . '/Data/entities.json'), true);

        foreach ($data as $key => $value) {
            $entityName = new EntityName();

            $entityName->setName($value['name']);

            $manager->persist($entityName);
        }
        $manager->flush();
    }
}
