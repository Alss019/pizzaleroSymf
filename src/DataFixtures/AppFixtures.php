<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Ingredient;
use App\Entity\Pizza;
use App\Entity\Menu;
use App\Entity\Drink;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Faker\Factory::create('fr_FR');
        $pizzas = [];
        $ingredients = [];
        $menus = [];
        $drinks = [];

        
        for($i=0; $i<10; $i++){
            $ingredient = new Ingredient();
            
            $ingredient->setName($faker->word());
            $ingredient->setDescr($faker->text(100));
            $ingredient->setImg($faker->imageUrl(360, 360, 'animals', true, 'dogs', true));
            
            
            $manager->persist($ingredient);
            $ingredients[] = $ingredient;
        }
        for($i=0; $i<18; $i++){
            $pizza = new Pizza();
            
            $pizza->setName($faker->lastname());

            $pizza->setPrice($faker->randomFloat(1, 10, 20));
            $pizza->setDescr($faker->text(100));
            $pizza->setImg($faker->imageUrl(360, 360, 'animals', true, 'dogs', true));
            for($j=0; $j<7; $j++){
            $pizza->addIngredient($faker->randomElement($ingredients));
            }
            $manager->persist($pizza);
            $pizzas[] = $pizza;
        }
        for($i=0; $i<4; $i++){
            $drink = new Drink();
            
            $drink->setName($faker->lastname());
            $drink->setPrice($faker->randomFloat(1, 10, 20));
            $drink->setDescr($faker->text(100));
            $drink->setImg($faker->imageUrl(360, 360, 'animals', true, 'dogs', true));

            $manager->persist($drink);
            $drinks[] = $drink;
        }
        for($i=0; $i<4; $i++){
            $menu = new Menu();
            
            $menu->setName($faker->lastname());
            $menu->setDescr($faker->text(100));
            $menu->setPrice($faker->randomFloat(1, 10, 20));
            $menu->setImg($faker->imageUrl(360, 360, 'animals', true, 'dogs', true));
            for($j=0; $j<7; $j++){
            $menu->addPizza($faker->randomElement($pizzas));
            }
            $menu->addDrink($faker->randomElement($drinks));

            $manager->persist($menu);
            $menus[] = $menu;
        }
        $manager->flush();
    }
}