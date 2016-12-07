<?php

use Illuminate\Database\Seeder;
use \App\QubeLikes;

class QubeLikesTableSeeder extends Seeder
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
            QubeLikes::create(array(
                'qube_id' => rand(1,24),
                'user_id' => rand(1,24),
            ));
        }
    }
}
