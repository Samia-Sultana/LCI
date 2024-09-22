<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Auth;
use Validator;

class AuthController extends Controller
{
    // public function _construct(){
    //     $this->middleware('auth:api', ['except' => ['login', 'register']]);
    // }
    public function register(Request $request){
        $validator = Validator::make($request->all, [
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
        ]);
        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }
        $user = User::create(array_merge(
            $validator->validated(),
            ['password' => bcrypt($request->password)]
        ));
        return response()->json([
            'message' => 'User created successfully',
            'user' => $user
        ]);
    }
    public function login(Request $request){

    }
}
