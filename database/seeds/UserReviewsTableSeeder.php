<?php

use Illuminate\Database\Seeder;
use \App\UserReviews;
use Faker\Factory as Faker;

class UserReviewsTableSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        foreach(range(1,1000) as $x)
        {
            UserReviews::create(array(
                'user_id' => rand(1,24),
                'reviewer_id' => rand(1,24),
                'ratings' => rand(1,5),
                'review' => $faker->sentence,
            ));
        }
    }
}
