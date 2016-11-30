<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use \App\User;
use JWTAuth;
class UserController extends Controller
{

  /*

  Get User data using user data

  */

  public function getUser(Request $request)
  {

    $this->validate($request,array(
      'id' => 'required|numeric',
    ));
    $id = $request->id;

    $user_data = User::where('id',$id)->first();
    if(!empty($user_data)){

      return response()->json($user_data);
    }else{
      return response()->json(['User cannot be found'],500);
    }

  }

  public function getUsers()
  {
    $users = User::all();
    return response()->json($users);
  }

  public function partialSignup(Request $request){
    $validator = \Validator::make(
    array(
      'email' => $request->email,
      'password' => $request->password,
      'lat' => $request->lat,
      'long' => $request->long,
    ),
    array(
      'email' => 'required|email|unique:users,email',
      'password' => 'required|min:8',
      'lat' => 'required|numeric',
      'long' => 'required|numeric'
    ));

    if($validator->fails()){
      return response()->json([$validator->messages()]);
    }

    $user = new User;
    $user->email = $request->email;
    $user->password = bcrypt($request->password);
    $user->save();

    return response()->json(compat("Account Succesfully Created!"));

  }

  public function laterSignup(Request $request){
    $validator = \Validator::make(
      array(
        'name' => $request->name,
        'gender' => $request->gender,
        'profession' => $request->profession,
        'firm_name' => $request->firm_name,
        'address' => $request->addrss,
        'city' => $request->city,
        'country' => $request->country,
        'state' => $request->state,
        'website' =>  $request->website,
      ),
      array(
        'name' => 'required|min:2',
        'gender' => 'required',
        'profession' => 'required|min:8',
        'firm_name' => 'required',
        'address' => 'required',
        'city' => 'required',
        'country' => 'required',
        'state' => 'required',
        'website' => 'required',
      ));
      $user = new User;
      $user->name = $request->name;
      $user->gender = $request->gender;
      $user->profession = $request->profession;
      $user->firm_name = $request->firm_name;
      $user->address = $request->address;
      $user->city = $request->city;
      $user->state = $request->state;
      $user->country = $request->country;
      $user->website = $request->website;
      $user->lat = $request->lat;
      $user->long = $request->long;
      $user->save();

  if($validator->fails()){
    return response()->json([$validator->messages()]);
  }

  }
  public function getNearUsers(){
    $user = JWTAuth::parseToken()->authenticate();
    $lat_user = $user->lat;
    $long_user = $user->long;
    $near_lats = array($lat_user - 4, $lat_user +4);
    $near_longs = array($long_user - 4 , $long_user + 4);
    $users = User::where('id','!=',$user->id)->get();
    $users_near = array();
    foreach($users as $u){

        if(($near_lats[0] < $u->lat || $near_lats[1] > $u->lat) && ($near_longs[0] < $u->long || $near_longs[1] > $u->long))
        {
          array_push($users_near,$u);
        }
    }
    return response()->json($users_near);
  }

  public function reset(Request $request)
  {
    $validator = \Validator::make(
    array(
      'email' => $request->email,
    ),
    array(
      'email' => 'email|required|exists:users,email',
    )
  );

    if($validator->fails())
    {
      return response()->json([$validator->messages()]);
    }

    return response()->json(['email has been sent']);
  }
}
