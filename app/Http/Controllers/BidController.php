<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use \App\Bids;

class BidController extends Controller
{
  public function bid(Request $request)
  {
    $validator = \Validator::make(
    array(
      'user_id' => $request->user_id,
      'project_id' => $request->project_id,
      'description' => $request->description,
      'price' => $request->price,
    ),
    array(
      'user_id' => 'required|exists:users,id',
      'project_id' => 'required|exists:projects,id',
      'description' => 'required',
      'price' => 'required|numeric',
    ));

    if($validator->fails())
    {
      return response()->json($validator->messages());
    }

    $bid = new Bids();
    $bid->user_id = $request->user_id;
    $bid->project_id = $request->project_id;
    $bid->description = $request->description;
    $bid->price = $request->price;
    $bid->save();

    return response()->json("bid registered" ,200);
  }

  public function getBidsByProject(Request $request)
  {
    $bids = Bids::where('project_id',$request->project_id)->get();
    return response()->json($bids);
  }

  public function getBidsByUser(Request $request)
  {
    $bids = Bids::where('user_id',$request->user_id)->get();
    return response()->json($bids);
  }

  public function getBid(Request $request)
  {
    $bid = Bids::where('id',$request->id)->get();
    return response()->json($bid);
  }
}
