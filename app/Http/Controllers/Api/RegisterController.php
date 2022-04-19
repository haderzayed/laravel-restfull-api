<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;


class RegisterController extends Controller
{
    public function register(Request $request ){

        $validator=Validator::make($request->all(),[
            'email'=>'required|string|unique:users',
            'name'=>'required',
            'password'=>'required',
        ]);

        if($validator->fails()){

            return response()->json($validator->errors());
        }

        $user=User::create([
            'email'=>$request->email,
            'name'=>$request->name,
            'password'=>bcrypt($request->password),
        ]);

        $token=JWTAuth::fromUser($user);

        return response()->json(compact('token'));
    }
}
