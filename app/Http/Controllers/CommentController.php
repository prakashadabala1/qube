<?php

namespace App\Http\Controllers;
use \App\Comments;
use Illuminate\Http\Request;

class CommentController extends Controller
{
  public function comment(Request $request)
  {
    $validator = \Validator::make(
    array(
      'user_id' => $request->user_id,
      'post_id' => $request->post_id,
      'comment' => $request->comment,
    ),
    array(
      'user_id' => 'required|exists:users,id',
      'post_id' => 'required|exists:posts,id',
      'comment' => 'required',
      )
  );

  if($validator->fails()){
    return response()->json($validator->messages());
  }

  $comment = new Comments();
  $comment->user_id = $request->user_id;
  $comment->post_id = $request->post_id;
  $comment->comment = $request->comment;
  $comment->save();

  return response()->json("commented",200);
  }

  public function getComments(Request $request)
  {
    $comments = Comments::where('post_id',$request->post_id)->get();

    return response()->json($comments);
  }
}
