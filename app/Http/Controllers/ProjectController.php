<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use \App\Projects;
use Intervention\Image\Facades\Image as Image;
use Carbon\Carbon;

class ProjectController extends Controller
{
  public function postProject(Request $request)
  {
    $validator = \Validator::make(
    array(
      'user_id' => $request->user_id,
      'title' => $request->title,
      'cat_id' => $request->cat_id,
      'type_id' => $request->type_id,
      'description' => $request->description,
      'image' => $request->image,
      'location' => $request->location,
    ),
    array(
      'user_id' => 'required|exists:users,id',
      'title' => 'required|min:2',
      'cat_id' => 'required|exists:categories,id',
      'type_id' => 'required|exists:types,id',
      'description' => 'required|min:16',
      'location' => 'required|min:2',
      'image' => 'required|image',
    )
  );

  if($validator->fails()){
    return response()->json($validator->messages());
  }
  $file_name = rand(10000,1000000000).Carbon::now()->toDayDateTimeString();

  if($request->hasFile('image')){
    $file = $request->file('image');
    $img = Image::make($file->getRealPath())->resize(400,400);
    $img->save()->save(public_path('images/projects/'.$file_name.'.jpg'));
  }

  $project= new Projects();
  $project->user_id = $request->id;
  $project->title = $request->title;
  $project->category_id = $request->cat_id;
  $project->type_id = $request->type_id;
  $project->description = $request->description;
  $project->image = 'images/projects/'.$file_name.'.jpg';
  $project->location = $request->location;
  $project->save();
  return response()->json("project saved");
}

  public function getProjects(Request $request)
  {
    $projects =  Projects::where('user_id',$request->user_id)->get();

    if(empty($projects)){
      return response()->json(['projects not found'],404);
    }
    return response()->json($projects);
  }

  public function getProject(Request $request)
  {
    $project = Projects::where('id',$request->id)->first();
    if(empty($project)){
      return response()->json(['project not found'],404);
    }

    return response()->json($project);
  }
}
