<?php
namespace App\Http\Controllers;
use \App\Posts;
use Illuminate\Http\Request;

class PostController extends Controller
{
  public function post(Request $request)
  {
    $validator = \Validator::make(
    array(
      'user_id' => $request->user_id,
      'title' => $request->title,
      'description' => $request->description,
    ),
    array(
      'user_id' => 'required|exists:users,id',
      'title' => 'required|min:2',
      'description' => 'required|min:16',
    )
  );

  if($validator->fails()){
    return response()->json($validator->messages());
  }

  $post = new Posts();
  $post->user_id => $request->user_id;
  $post->title => $request->title;
  $post->description => $request->description;
  $post->save();

  return response()->json('posted',200);
  }

  public function getPosts(Request $request)
  {
    $validator = \Validator::make(
    array(
      'user_id' => $request->user_id,
    ),
    array(
      'user_id' => 'required|exists:users,id',
    )
  );

  if($validator->fails()){
    return response()->json($validator->messages());
  }

  $posts = Posts::where('user_id',$request->user_id)->get();

  return response()->json($posts);
}

public function getPost(Request $request)
{
  $post = Posts::where('id',$request->id)->get()->first();

  return response()->json($post);
}
}
