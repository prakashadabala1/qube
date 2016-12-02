<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use \App\Posts;

class PostsTableSeeder extends Seeder
{
    public function run()
    {
      $faker = Faker::create();

      foreach(range(0,100) as $x)
      {
        Posts::create(array(
          'user_id' => rand(1,24),
          'title' => $faker->name,
          'description' => $faker->paragraph,
        ));
      }
    }
}
