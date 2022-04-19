<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;


class LoginController extends Controller
{

    public function login(Request $request ){

        $validator=Validator::make($request->all(),[
            'email'=>'required|string',
            'password'=>'required',
        ]);

        if($validator->fails()){

            return response()->json($validator->errors());
        }

        $credentials = request(['email', 'password']);

        if (! $token = JWTAuth::attempt($credentials)) {
            return response()->json(['error' => 'invalid email or password'], 401);
        }

        return response()->json(compact('token'));
    }
}
