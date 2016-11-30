<?php

use Illuminate\Database\Seeder;

class DonationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      //Seeding data on Donation table

      \App\Donations::create(
        array(
          'donor_id' => '3',
          'receiver_id' => '4'
        )
      );
      \App\Donations::create(
        array(
          'donor_id' => '2',
          'receiver_id' => '4'
        )
      );
      \App\Donations::create(
        array(
          'donor_id' => '1',
          'receiver_id' => '4'
        )
      );
    }
}
