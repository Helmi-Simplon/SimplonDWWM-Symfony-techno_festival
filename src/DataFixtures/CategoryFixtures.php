<?php

namespace App\DataFixtures;

use App\Entity\Artist;
use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class CategoryFixtures extends Fixture
{
    private array $categories = [
        "Mélodique",
        "Industrielle",
        "Groovy",
        "Deep",
        "Détroit"
    ];

    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');
        $concert = 1;

        foreach($this->categories as $name) {
            $category = new Category();
            $category->setLabel($name);

            $manager->persist($category);

            for($i = 1; $i < rand(3,15); $i++) {
                $artist = new Artist();
                $artist->setName('DJ ' . $faker->firstName());
                $artist->setDescription($faker->paragraphs(3, true));
                $artist->setCategory($category);

                if($concert <= 9 && rand(0,7) <= 2) {
                    $artist->setConcert($concert);
                    $concert++;
                }

                $manager->persist($artist);
            }
        }

        $manager->flush();
    }

}