<?php

namespace App\DataFixtures;

use App\Entity\Ad;
use Faker\Factory;
use Cocur\Slugify\Slugify;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AppFixturesPhp extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create("FR-fr");
        $slugyfy = new Slugify();

        for ($i=0; $i <30 ; $i++) { 
            $ad=new Ad();
            $title= $faker->sentence();
            $slug=$slugyfy->slugify($title);
            $coverImage= $faker->imageUrl(1000, 350);
            $introduction = $faker->paragraph(2);
            $content = '<p>'.join('</p><p>',$faker->paragraphs(5)).'</p>';

            $ad->setTitle($title)
                ->setSlug($slug)
                ->setCoverImage($coverImage)
                ->setIntroduction($introduction)
                ->setContent($content)
                ->setPrice(mt_rand(40,200))
                ->setRooms(mt_rand(1,5));

            // $product = new Product();
            $manager->persist($ad);
        }



        $manager->flush();
    }
}
