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
    $this->call(FollowsTableSeeder::class);
    $this->call(NotificationTableSeeder::class);
    $this->call(UserReviewsTableSeeder::class);
    $this->call(PostLikesTableSeeder::class);
    $this->call(QubeLikesTableSeeder::class);
  }
}
