<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('first_name',255);
            $table->string('last_name',255);
            $table->string('email',255)->unique();
            $table->string('username',255)->unique();
            $table->string('password',255);
            $table->bigInteger('phone');
            $table->longText('address');
            $table->enum('gender',array('Male','Female'));
            $table->enum('blood_group',array('A+','A-','B+','B-','O+','O-','AB+','AB-'));
            $table->integer('user_type_id')->references('id')->on('user_type');
            $table->rememberToken();
            $table->timestamp('deleted_at');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('users');
    }
}
