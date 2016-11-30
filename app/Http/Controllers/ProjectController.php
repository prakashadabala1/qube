<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use \App\Projects;
class ProjectController extends Controller
{
  public function postProject(Request $request)
  {
    $validator = \Validator::make(
    array(
      'user_id' => $request->id,
      'title' => $request->title,
      'cat_id' => $request->cat_id,
      'type_id' => $request->type_id,
      'description' => $request->description,
      'image' => $request->image,
    ),
    array(
      'user_id' => 'required|exists:users,id',
      'title' => 'required|min:2',
      'cat_id' => 'required|exists:categories,id',
      'type_id' => 'required|exists:types,id',
      'description' => 'required|min:16',
      'image' => 'required|image',
    )
  );

  if($validator->fails()){
    return response()->json($validator->message());
  }
  $file_name = rand(10000,1000000000).timestamp();

  if($requst->hasFile('image')){
    $file = $request->file('image');
    $file->move('images/projects/'.$file_name.'.jpg');
  }

  $project= new Project();
  $project->user_id = $request->id;
  $project->title = $request->title;
  $project->cat_i = $request->cat_id;
  $project->type_id = $request->type_id;
  $project->description = $request->description;
  $project->image = 'images/projects/'.$file_name.'.jpg';

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
