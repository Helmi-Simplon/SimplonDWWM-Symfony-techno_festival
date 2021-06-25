<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    private array $categories=[
        "Melodique" => "danger",
        "Industrielle" => "info",
        "Groovy" => "secondary",
        "Deep" => "warning",
        "Détroit" => "success",
    ];

    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);

        $manager->flush();
    }
}
