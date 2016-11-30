<?php

use Illuminate\Database\Seeder;

use Faker\Factory as Faker;
use \App\Projects;

class ProjectsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $faker = Faker::create();
      foreach(range(1,40) as $x)
      {
          Project::create(
          array(
              'user_id' => 1,
              'title' => $faker->address,
              'cat_id' => rand(1,24),
              'type_id' => rand(1,23),
              'description' => $faker->pragraph,
              'image' => $faker->firstName,
          ));
      }
    }
}
