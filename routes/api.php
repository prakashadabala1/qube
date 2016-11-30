<?php

use Illuminate\Http\Request;
// API Routes

Route::get('auth','Api\AuthController@authenticate');
Route::get('signup','Api\UserController@partialSignup');
Route::get('reset','Api\UserController@reset');

Route::group(['middleware' => 'jwt.auth'],function(){
  //Users ROutes
  Route::get('user/me','Api\AuthController@getAuthenticatedUser');
  Route::get('user','Api\UserController@getUser');
  Route::get('users','Api\UserController@getUsers');
  Route::get('users/near','Api\UserController@getNearUsers');

  //Projects ROutes
  Route::get('projects','ProjectController@getProjects');
  Route::get('project','ProjectController@getProject');

});
