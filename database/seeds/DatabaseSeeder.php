<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
  public function run()
  {
    $this->call(UsersTableSeeder::class);
    $this->call(ProjectTableSeeder::class);
    $this->call(PostsTableSeeder::class);
    $this->call(CommentsTableSeeder::class);
    $this->call(BidsTableSeeder::class);
    $this->call(PortfolioTableSeeder::class);
    $this->call(MessagesTableSeeder::class);
    $this->call(QubeTableSeeder::class);
  }
}
