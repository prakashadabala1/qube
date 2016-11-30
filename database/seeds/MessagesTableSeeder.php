<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use \App\Messages;

class MessagesTableSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        foreach(range(1,300) as $x)
        {
          Messages::create(
            array(
              'from' => rand(1,24),
              'to' => rand(1,24),
              'message' => $faker->sentence,
            ));
        }
    }
}
