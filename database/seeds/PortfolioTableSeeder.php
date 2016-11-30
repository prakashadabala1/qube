<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use \App\Portfolio;

class PortfolioTableSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        foreach(range(1,24) as $x )
        {
          Portfolio::create(
          array(
              'user_id' => rand(1,24),
              'name' => $faker->name,
              'image' => $faker->imageUrl($height =400,$width=400),
          ));
        }
    }
}
