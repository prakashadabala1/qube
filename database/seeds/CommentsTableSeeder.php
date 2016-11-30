<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use \App\Comments;

class CommentsTableSeeder extends Seeder
{
    public function run()
    {
      $faker = Faker::create();

      foreach(range(1,100) as $x)
      {
        Comments::create(array(
          'user_id' => rand(1,24),
          'post_id' => rand(1,24),
          'comment' => $faker->sentence,
        ));
      }
    }
}
