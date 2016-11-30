<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use \App\Bids;

class BidsTableSeeder extends Seeder
{
    public function run()
    {
      $faker = Faker::create();

      foreach(range(0,100) as $x)
      {
        Bids::create(
        array(
            'user_id' => rand(1,24),
            'project_id' => rand(1,24),
            'description' => $faker->sentence,
            'price' => rand(20000,20000),
        ));
      }
    }
}
