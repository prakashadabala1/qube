<?php

use Illuminate\Database\Seeder;
use \App\PostLikes;

class PostLikesTableSeeder extends Seeder
{
    /**
    * Run the database seeds.
    *
    * @return void
    */
    public function run()
    {

        foreach(range(1,500) as $x)
        {
            PostLikes::create(array(
                'post_id' => rand(1,24),
                'user_id' => rand(1,24),
            ));
        }
    }
}
