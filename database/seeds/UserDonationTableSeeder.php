<?php

use Illuminate\Database\Seeder;

class UserDonationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

      \App\UserDonation::create(array(
          'donation_id' => '1',
          'user_id' => '3'
      ));

      \App\UserDonation::create(array(
          'donation_id' => '1',
          'user_id' => '4'
      ));

      \App\UserDonation::create(array(
          'donation_id' => '2',
          'user_id' => '2'
      ));

      \App\UserDonation::create(array(
          'donation_id' => '2',
          'user_id' => '4'
      ));

      \App\UserDonation::create(array(
          'donation_id' => '3',
          'user_id' => '1'
      ));

      \App\UserDonation::create(array(
          'donation_id' => '3',
          'user_id' => '4'
      ));

    }
}
