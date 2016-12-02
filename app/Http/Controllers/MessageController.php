<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use \App\Messages;

class MessageController extends Controller
{
  public function send(Request $request)
  {
      $validator = \Validator::make(
      array(
        'from' => $request->from,
        'to' => $request->to,
        'message' => $request->message,
      ),
      array(
        'from' => 'required|exists:users,id',
        'to' => 'required|exists:users,id',
        'message' => 'required',
      ));

      $message = new Messages();
      $message->from = $request->from;
      $message->to = $request->to;
      $message->message = $request->message;
      $message->save();

      return response()->json("message sent",200);
  }

  public function get(Request $request)
  {
    $validator = \Validator::make(
    array(
      'from' => $request->from,
      'to' => $request->to,
    ),
    array(
      'from' => 'required|exists:users,id',
      'to' => 'required|exists:users,id',
    ));

    $messages = Messages::where('from',$request->from)->where('to',$request->to)->get();
    return response()->json($messages,200);
  }
}
