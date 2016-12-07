<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class FollowsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach(range(1,200) as $x)
        {
        \DB::table('follows')->insert(

            array(
                'follower' => rand(1,24),
                'followed' => rand(1,24),
                'created_at' => Carbon::today(),
                'updated_at' => Carbon::today(),
            )
    );
    }
    }
}
