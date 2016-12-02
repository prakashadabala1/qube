<?php

use Illuminate\Http\Request;
// API Routes

Route::post('auth','Api\AuthController@authenticate');
Route::post('signup','Api\UserController@partialSignup');
Route::post('reset','Api\UserController@reset');

Route::group(['middleware' => 'jwt.auth'],function(){
  //Users ROutes
  Route::post('user/me','Api\AuthController@postAuthenticatedUser');
  Route::post('user','Api\UserController@postUser');
  Route::post('users/near','Api\UserController@postNearUsers');

  //Projects ROutes
  Route::post('project/add','ProjectController@postProject');
  Route::post('projects','ProjectController@postProjects');
  Route::post('project','ProjectController@postProject');

  //Blog Posts

  Route::get('posts','PostController@getPosts');
  Route::get('post','PostController@getPost');
  Route::post('post/do','PostController@post');
});
