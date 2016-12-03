<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use \App\User;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Intervention\Image\Facades\Image as Image;
use Carbon\Carbon;

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

  public function partialSignup(Request $request)
  {
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
    $user->verified = false;
    $user->save();

      try {
          if (!$token = JWTAuth::attempt($request->only('email','password'))) {
              return response()->json(['error' => 'invalid_credentials'], 401);
          }
      } catch (JWTException $e) {
          return response()->json(['error' => 'could_not_create_token'], 500);
      }

      return response()->json(compact('token'));

    }


  public function completeAccount(Request $request)
  {
      $id = JWTAuth::parseToken()->authenticate()->id;

      $updateArray = array();

      if($request->has('name'))
      {
        $updateArray['name'] = $request->name;
      }
      if($request->has('gender'))
      {
        $updateArray['gender'] = $request->gender;
      }
      if($request->has('gender'))
      {
        $updateArray['profession'] = $request->profession;
      }
      if($request->has('firm_name'))
      {
        $updateArray['firm_name'] = $request->firm_name;
      }
      if($request->has('addrss'))
      {
        $updateArray['address'] = $request->address;
      }
      if($request->has('city'))
      {
        $updateArray['city'] = $request->city;
      }
      if($request->has('country'))
      {
        $updateArray['country'] = $request->country;
      }
      if($request->has('state'))
      {
        $updateArray['state'] = $request->state;
      }
      if($request->has('website'))
      {
        $updateArray['website'] = $request->website;
      }
      if($request->has('lat'))
      {
        $updateArray['lat'] = $request->lat;
      }
      if($request->has('long'))
      {
        $updateArray['long'] = $request->long;
      }
      if($request->hasFile('image')){
        $file = $request->file('image');
        $img = Image::make($file->getRealPath())->resize(500,500);
        $img->save()->save(public_path('images/users/'.$file_name.'.jpg'));
        $updateArray['image'] = 'images/users/'.$file_name.'.jpg';
      }

      User::where('id',$id)
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
