<?php

use Illuminate\Http\Request;
// API Routes

Route::post('auth','Api\AuthController@authenticate');
Route::post('signup','Api\UserController@partialSignup');
Route::post('reset','Api\UserController@reset');

Route::group(['middleware' => 'jwt.auth'],function(){
  //Users ROutes
  Route::post('user/me','Api\AuthController@getAuthenticatedUser');
  Route::post('user','Api\UserController@gettUser');
  Route::post('users/near','Api\UserController@getNearUsers');
  Route::post('user/update','Api\UserController@completeAccount');

  //Projects ROutes
  Route::post('project/add','ProjectController@postProject');
  Route::post('projects','ProjectController@getProjects');
  Route::post('project','ProjectController@getProject');

});
