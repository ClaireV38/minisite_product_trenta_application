<?php

namespace App\DataFixtures;

use App\Entity\Product;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker;

class ProductFixtures extends Fixture
{
    /**
     * nb objects to create
     * @var int
     **/
    public const NB_OBJECT = 60;

    public function getDependencies()
    {
        return [CategoryFixtures::class];
    }

    public function load(ObjectManager $manager)
    {
        $nbObjectByCategory = round(self::NB_OBJECT / count(categoryFIXTURES::CATEGORIES));

        $faker  =  Faker\Factory::create('fr_FR');
        for ($i = 1; $i <= count(categoryFIXTURES::CATEGORIES); $i++) {
            for ($j = 1; $j <= $nbObjectByCategory; $j++) {
                $product = new Product();
                $product->setTitle($faker->sentence($nbWords = 3, $variableNbWords = true));
                $product->setCategory($this->getReference('category_' . $i));
                $product->setPrice($faker->randomFloat($nbMaxDecimals = 2, $min = 0, $max = 1500));
                $product->setPicture(categoryFIXTURES::CATEGORIES[$i - 1] . rand ( 1 , 10) . '.jpg');
                $product->setAvailableSize($faker->bothify('#?,#?,#?'));
                $product->setAvailableColor($faker->sentence($nbWords = 4, $variableNbWords = true));
                $product->setDescription($faker->text($maxNbChars = 200));
                $product->setCreatedAt(new DateTime('now'));
                $product->setUpdatedAt(new DateTime('now'));
                $manager->persist($product);
                $this->addReference('product_' . (($i - 1) * $nbObjectByCategory + $j), $product);
            }
        }
        $manager->flush();
    }
}
