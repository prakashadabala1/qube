<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home/fuck',function(){
  $fuck =  array(
      'name' => 'Swornim',
      'gender' => 'Male',
      'profession' => 'This is fuck',
      'id' => 234,
    );
  return $fuck['name'];
});
