<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use Validator;
use App\Models\User;

class AuthController extends Controller
{

    public function register(Request $request){

        $rules = [
            'name'      => 'required|string',
            'phone'     => 'required|unique:users',
            'address'   => 'required|string',
            'lng'       => 'required',
            'lat'       => 'required',
            'password'  => 'required|confirmed',
            'notificationToken' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);
        if($validator->fails()){
            return response()->json(['errors' => $validator->errors()], 200);
        }

        $digits = mt_rand(1000,9999);
        $user = new User();
        $user->name = $request->name;
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->lat = $request->lat;
        $user->lng = $request->lng;
        $user->password = bcrypt($request->password);
        $user->notificationToken = $request->notificationToken;
        $user->verification_code = $digits;
        $user->save();

        return response()->json([
            'errors' => '',
            'user' => $user
        ], 201);

    }


    public function login(Request $request){
        $rules = [
            'phone' => "required",
            'password' => 'required',
            'device_name' => 'required',
        ];
        $validator = Validator::make($request->all(),$rules);
        if($validator->fails()){
            return response()->json(['errors' => $validator->errors()], 200);
        }
        $user = User::where('phone', $request->phone)->first();
        if (! $user || ! Hash::check($request->password, $user->password)) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }
        return $user->createToken($request->device_name)->plainTextToken;
    }

    public function update(Request $request){
        $rules = [
            'name' => "required|string",
            'phone' => 'required',
            'address' => 'required|string'
        ];
        $validator = Validator::make($request->all(),$rules);
        if($validator->fails()){
            return response()->json(['errors' => $validator->errors()], 200);
        }
        $user = User::find($request->userId);
        $user->name = $request->name;
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->save();

        $user = User::where('id',$user->id)->first();
        return response()->json([
            'user'   => $user,
        ], 200);
    }

    public function updatePassword(Request $request){
        $rules = [
            'password' => "required",
        ];
        $validator = Validator::make($request->all(),$rules);
        if($validator->fails()){
            return response()->json(['errors' => $validator->errors()], 200);
        }
        $user = User::find($request->userId);
        $user->password = bcrypt($request->password);
        $user->save();

        $user = User::where('id',$user->id)->first();
        return response()->json([
            'user'   => $user,
        ], 200);
    }

    public function user(Request $request){
        $userId = auth()->user()->id;
        return User::where('id',$userId)->first();
    }

    public function logout (Request $request) {
        $token = $request->user()->token();
        $token->revoke();
        $response = ['message' => 'You have been successfully logged out!'];
        return response($response, 200);
    }
}
