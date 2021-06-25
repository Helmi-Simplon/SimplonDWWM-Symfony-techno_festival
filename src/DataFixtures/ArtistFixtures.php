<?php

namespace App\DataFixtures;

use App\Entity\Artist;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class ArtistFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');

        for($i = 0; $i < 25; $i++) {
            $artist = new Artist();
            $artist->setName('DJ' . $faker->firstName());
            $artist->setDescription($faker->paragraphs(3, true));
            $manager->persist($artist);
        }

        $manager->flush();
    }

}