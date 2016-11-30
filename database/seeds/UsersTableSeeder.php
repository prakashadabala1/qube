<?php

use Illuminate\Database\Seeder;
use \App\User;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
      $user = new User;
      $user->name = "Swornim Shrestha";
      $user->email = "srestaswrnm@gmail.com";
      $user->password = bcrypt('secret');
      $user->gender = "male";
      $user->profession = "Programmer";
      $user->firm_name = "TinyBits IT Club";
      $user->address = "Chautara Sindhuapclhowk";
      $user->city = "Chautara";
      $user->country = "Nepal";
      $user->state = "CDR";
      $user->website = "bravegurkha.github.io";
      $user->lat = '60.331231212';
      $user->long = '30.31345132';
      $user->save();

      $user = new User;
      $user->name = "Pranish Shrestha";
      $user->email = "srestarnm@gmail.com";
      $user->password = bcrypt('secret');
      $user->gender = "male";
      $user->profession = "Programmer";
      $user->firm_name = "TinyBits IT Club";
      $user->address = "Chautara Sindhuapclhowk";
      $user->city = "Chautara";
      $user->country = "Nepal";
      $user->state = "CDR";
      $user->website = "bravegurkha.github.io";
      $user->lat = '63.331231212';
      $user->long = '31.31345132';
      $user->save();

    }
}
