<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Qube;
use Intervention\Image\Facades\Image as Image;
use Carbon\Carbon;

class QubeController extends Controller
{

    public function makeQubes(Request $request)
    {
      $validator = \Validator::make(
      array(
          'user_id' => $request->user_id,
          'image' => $request->image,
          'title' => $request->title,
      ),
      array(
          'user_id' => 'required|exists:users,id',
          'image' => 'required|image',
          'title' => 'required',
      ));

      if($validator->fails())
      {
          return $validator->messages();
      }

      $file_name = rand(10000,1000000000).Carbon::now()->toDayDateTimeString();

      if($request->hasFile('image')){
        $file = $request->file('image');
        $img = Image::make($file->getRealPath())->resize(400,400);
        $img->save()->save(public_path('images/qubes/'.$file_name.'.jpg'));
      }

      $qube = new Qube();
      $qube->user_id = $request->user_id;
      $qube->image = 'images/qubes/'.$file_name.'.jpg';
      $qube->title = $request->title;
      $project->save();

      return response()->json("qube saved",200);
    }

    public function getQubes(Request $request)
    {
      $validator = \Validator::make(
      array(
          'user_id' => $request->user_id,
      ),
      array(
          'user_id' => 'required|exists:users,id',
      ));

      if($validator->fails())
      {
          return $validator->messages();
      }

      $qubes = Qube::where('user_id',$request->user_id)->get();
      return response()->json($qubes);
    }
}
