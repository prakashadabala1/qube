<?php

use Illuminate\Http\Request;
// API Routes

Route::post('auth','Api\AuthController@authenticate');
Route::post('signup','Api\UserController@partialSignup');
Route::post('reset','Api\UserController@reset');

Route::group(['middleware' => 'jwt.auth'],function(){
  //Users ROutes
  Route::get('user/me','Api\AuthController@getAuthenticatedUser');
  Route::get('user','Api\UserController@getUser');
  Route::get('users/near','Api\UserController@getNearUsers');
  Route::post('user/update','Api\UserController@completeAccount');

  //Projects ROutes
  Route::post('project/add','ProjectController@postProject');
  Route::post('projects','ProjectController@getProjects');
  Route::post('project','ProjectController@getProject');

  //Blog Posts

  Route::get('posts','PostController@getPosts');
  Route::get('post','PostController@getPost');
  Route::post('post/do','PostController@post');
  Route::get('comments','CommentController@getComments');
  Route::post('comment','CommentController@comment');
});
