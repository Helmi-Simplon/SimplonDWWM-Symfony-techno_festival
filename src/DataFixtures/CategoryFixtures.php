<?php

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class CategoryFixtures extends Fixture
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
        
            foreach($this->categories as $name) {
                $category = new Category();
                $category->setLabel($name);
                $manager->persist($category);
            }

        $manager->flush();
    }
}
