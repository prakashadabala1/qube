<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $faker         = Faker::create();
        $blood_group   = ['A+', 'A-', 'B+', 'B-', 'O+', 'O-', 'AB+', 'AB-']; // Blood Groups
          $gender_data = ['Male', 'Female']; //Gender Data
          //Admin Data
          \App\User::create([
            'first_name' => $faker->firstNameMale,
            'last_name' => $faker->lastName,
            'email' => $faker->email,
            'username' => $faker->userName,
            'password' => \Hash::make('secret'),
            'phone' => '9810' . rand(100000, 999999), // For Creating nepali Cellphone number
            'address' => $faker->address,
            'gender' => 'Male',
            'blood_group' => $blood_group[rand(0, 7)],
            'user_type_id' => '1', //User type 1 indicates the role of admin
            'remember_token' => '',
          ]);

          /*
            Generating 15 User Data using Faker.
          */
          foreach (range(1, 15) as $x) {
              \App\User::create([
                'first_name' => $faker->firstName($gender = $gender_data[rand(0, 1)]),
                'last_name' => $faker->lastName,
                'email' => $faker->email,
                'username' => $faker->userName,
                'password' => \Hash::make('secret'),
                'phone' => '9813' . rand(100000, 999999), //Since I didn't found any Faker Library for nepali phone I used rand function to generate some
                'address' => $faker->address,
                'gender' => $gender_data[rand(0, 1)],
                'blood_group' => $blood_group[rand(0, 7)],
                'user_type_id' => '2', //User type 2 indicates the role of user.
                'remember_token' => '',
              ]);
          }
    }
}
