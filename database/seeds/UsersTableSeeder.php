<?php

use Illuminate\Database\Seeder;
use \App\User;
use Faker\Factory as Faker;

class UsersTableSeeder extends Seeder
{
  public function run()
  {
    $faker = Faker::create();
    $gender = array('Male','Female');
    foreach(range(0,25) as $x)
    {
      $user = new User;
      $user->name = $faker->name;
      $user->email = $faker->unique()->safeEmail;
      $user->password = bcrypt('secret');
      $user->gender = $gender[rand(0,1)];
      $user->image = $faker->imageUrl($height=500 ,$width=500);
      $user->profession = "Programmer";
      $user->firm_name = $faker->company;
      $user->address = $faker->streetAddress;
      $user->city = $faker->city;
      $user->country = $faker->country;
      $user->state = $faker->state;
      $user->website = $faker->url;
      $user->phone = '9813'.rand(111111,999999);
      $user->lat = $faker->latitude($min = -90, $max = 90);
      $user->long = $faker->longitude($min = -180, $max = 180);
      $user->verified = false;
      $user->save();
    }
  }
}
