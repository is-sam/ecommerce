<?php

namespace App\DataFixtures;

use App\Entity\Category;
use App\Entity\Product;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\String\Slugger\AsciiSlugger;
use Symfony\Component\String\Slugger\SluggerInterface;

class AppFixtures extends Fixture
{
    private const NUM_USERS = 5;
    private const NUM_CATEGORIES = 3;
    private const NUM_PRODUCTS = 10;

    private $slugger;
    private $encoder;

    /**
     * Class constructor.
     */
    public function __construct(SluggerInterface $slugger, UserPasswordEncoderInterface $encoder)
    {
        $this->slugger = $slugger;
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');
        $faker->addProvider(new \Bluemmb\Faker\PicsumPhotosProvider($faker));

        $user = new User();
        $user->setEmail("admin@mail.com");
        $user->setFullName("The Admin");
        $user->setPassword($this->encoder->encodePassword($user, "password"));
        $user->setRoles(['ROLE_ADMIN']);
        $manager->persist($user);

        for ($p = 0; $p < self::NUM_USERS; $p++) {
            $user = new User();
            $user->setEmail("user$p@mail.com");
            $user->setFullName($faker->name());
            $user->setPassword($this->encoder->encodePassword($user, "user$p"));
            $manager->persist($user);
        }

        for ($p = 0; $p < self::NUM_CATEGORIES; $p++) {
            $category = new Category();
            $category->setName(ucfirst($faker->company()));
            $category->setSlug(strtolower($category->getName()));
            $manager->persist($category);
        }

        $manager->flush();

        $categories = $manager->getRepository(Category::class)->findAll();

        for ($p = 0; $p < self::NUM_PRODUCTS; $p++) {
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
