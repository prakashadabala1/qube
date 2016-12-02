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

  public function partialSignup(Request $request){
    $validator = \Validator::make(
    array(
      'email' => $request->email,
      'password' => $request->password,
    ),
    array(
      'email' => 'required|email|unique:users,email',
      'password' => 'required|min:8',
    ));

    if($validator->fails()){
      return response()->json([$validator->messages()]);
    }

    $user = new User;
    $user->email = $request->email;
    $user->password = bcrypt($request->password);
    $user->name = '';
    $user->gender = '';
    $user->profession = '';
    $user->firm_name = '';
    $user->address = '';
    $user->city = '';
    $user->state = '';
    $user->country = '';
    $user->website = '';
    $user->lat = '';
    $user->long = '';
    $user->verified = false;
    $user->save();

    $user_data = User::where('email',$request->email)->first();

    if(!empty($user_data)){

      return response()->json($user_data);
    }else{
      return response()->json(['User cannot be found'],500);
    }
  }

  public function completeAccount($updateArray){
    $validator = \Validator::make(
      $updateArray,
      array(
        'id' => 'required|exists:users,id',
        'name' => 'min:2',
        'gender' => 'min:4',
        'profession' => 'min:8',
        'firm_name' => 'min:5',
        'address' => 'min:10',
        'city' => 'min:8',
        'country' => 'min:3',
        'state' => 'min:3',
        'website' => 'min:5',
        'lat' => 'numeric',
        'long' => 'numeric'
      ));

      if($validator->fails()){
        return response()->json([$validator->messages()]);
      }

      User::where('id',$request->id)
      ->update($updateArray);
      return response()->json('updated',200);
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

        if($near_lats[0] < $u->lat && $near_lats[1] > $u->lat)
        {
          if($near_longs[0] < $u->long && $near_longs[1] > $u->long)
          {

          array_push($users_near,$u);

          }
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
