<?php

namespace App\DataFixtures;

use App\Entity\Category;
use App\Entity\Product;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Symfony\Component\String\Slugger\AsciiSlugger;
use Symfony\Component\String\Slugger\SluggerInterface;

class AppFixtures extends Fixture
{
    private $slugger;

    /**
     * Class constructor.
     */
    public function __construct(SluggerInterface $slugger)
    {
        $this->slugger = $slugger;
    }

    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');
        $faker->addProvider(new \Bluemmb\Faker\PicsumPhotosProvider($faker));


        for ($p = 0; $p < 3; $p++) {
            $category = new Category();
            $category->setName(ucfirst($faker->company()));
            $category->setSlug(strtolower($category->getName()));
            $manager->persist($category);
        }

        $manager->flush();

        $categories = $manager->getRepository(Category::class)->findAll();

        for ($p = 0; $p < 10; $p++) {
            $product = new Product();
            $product->setName(ucfirst($faker->word()) . ' ' . ucfirst($faker->word()));
            $product->setSlug(strtolower($this->slugger->slug($product->getName())));
            $product->setPrice(mt_rand(500, 12000));
            $product->setCategory($categories[mt_rand(0, count($categories) - 1)]);
            $product->setDescription($faker->paragraph());
            $product->setPicture($faker->imageUrl(400, 400, true));
            $manager->persist($product);
        }

        $manager->flush();
    }
}
