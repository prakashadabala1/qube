<?php

use Illuminate\Database\Seeder;
use \App\Notifications;
use Faker\Factory as Faker;
class NotificationTableSeeder extends Seeder
{
    /**
    * Run the database seeds.
    *
    * @return void
    */
    public function run()
    {
        $faker = Faker::create();

        foreach(range(1,50) as $x)
        {
            Notifications::create(array(
                'message' => $faker->paragraph,
            ));
        }
    }
}
