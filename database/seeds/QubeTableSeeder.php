<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use \App\Qube;

class QubeTableSeeder extends Seeder
{
    public function run()
    {
          $faker = Faker::create();

          foreach(range(1,240) as $x)
          {
            Qube::create(array(
              'user_id' => rand(1,24),
              'image' => $faker->imageUrl($height =400 , $width =400),
              'title' => $faker->sentence,
            ));
          }
    }
}
