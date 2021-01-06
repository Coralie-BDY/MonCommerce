<?php

namespace App\DataFixtures;

use App\Entity\Article;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
class ArticleFixture extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create( 'fr_FR');
        for ($i = 0; $i < 100; $i++)
        {
            $article = new Article();
            $article
                ->setTitre($faker->words(3, true))
                ->setDescription($faker->sentence(3, true))
                ->setPrix($faker->numberBetween(1, 1000))
                ->setPoids($faker->numberBetween(1, 1000))
                ->setQuantite($faker->numberBetween(1, 1000))
                ->setTaille($faker->numberBetween(1, 1000))
                ->setAuteur($faker->name)
                ->setCategorie($faker->company)
                ->setOrigine($faker->country)
                ->setVendu(false);
            $manager->persist($article);
        }
          $manager->flush();
    }
}
