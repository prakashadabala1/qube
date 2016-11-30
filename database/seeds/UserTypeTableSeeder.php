<?php

use Illuminate\Database\Seeder;

class UserTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $roles = array('Administrator' ,'User');
      foreach($roles as $role){

        \DB::table('user_type')->insert(array(
          'title' => $role,
        ));
      }
    }
}
