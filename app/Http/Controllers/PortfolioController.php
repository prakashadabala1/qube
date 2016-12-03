<?php

namespace App\Http\Controllers;
use \App\Portfolio;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image as Image;
use Carbon\Carbon;

class PortfolioController extends Controller
{
  public function add(Request $request)
  {
    $validator = \Validator::make(
    array(
      'user_id' => $request->user_id,
      'name' => $request->name,
      'image' => $request->image,
    ),
    array(
      'user_id' => 'required|exists:users,id',
      'name' => 'required|min:2',
      'image' => 'required|image',
    )
  );

  if($validator->fails()){
    return response()->json($validator->messages());
  }
  $file_name = rand(10000,1000000000).time();
  $path = public_path('images/portfolios/'.$file_name.'.jpg');
  $url = url('images/portfolios/'.$file_name.'.jpg');
  if($request->hasFile('image')){
    $file = $request->file('image');
    $img = Image::make($file->getRealPath())->resize(400,400);
    $img->save($path);
  }

  $portfolio= new Portfolio();
  $portfolio->user_id = $request->user_id;
  $portfolio->name = $request->name;
  $portfolio->image = $url;
  $portfolio->save();
  return response()->json("portfolio saved");
}

public function getByUser(Request $request)
{
  $user_id = $request->user_id;
  $portfilios = Portfolio::where('user_id',$user_id)->get();
  return response()->json($portfilios);
}

public function getById(Request $request)
{
  $portfolio = Portfolio::where('id',$request->id)->get()->first();
  return response()->json($portfolio);
}
}
