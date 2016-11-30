<?php

use Illuminate\Database\Seeder;

use Faker\Factory as Faker;
use \App\Projects;
use \App\Type;
use \App\Category;

class ProjectTableSeeder extends Seeder
{
  /**
  * Run the database seeds.
  *
  * @return void
  */
  public function run()
  {
    $faker = Faker::create();
    foreach(range(1,25) as $x)
    {
      Category::create(
      array(
        'id' => $x,
        'name' => $faker->firstName,
      )
    );
    Type::create(
    array(
      'id' => $x,
      'name' => $faker->firstName,
    )
  );
  Projects::create(
  array(
    'user_id' => rand(1,24),
    'location' => $faker->address,
    'title' => $faker->firstName,
    'category_id' => $x,
    'type_id' => $x,
    'description' => $faker->paragraph,
    'image' => $faker->imageUrl($width=200,$height=200)
  ));
}
}
}
