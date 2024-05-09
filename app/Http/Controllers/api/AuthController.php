<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function login(Request $req){
        $rules = [
            'email' => 'required',
            'password' => 'required',
        ];

        $validator = Validator::make($req->all(), $rules);
        if($validator->fails()) {
            return response()->json([
                'status'=> false,
                'message' => ' Login gagal',
                'data' => $validator->errors(),
            ],401); 
        }
        if(!Auth::attempt($req->only(['email','password']))){
            return response()->json([
                'status'=> false,
                'message' => ' Password tidak sesuai',
            ],401); 
        }

        $data_user = User::where('email', $req->email)->first();
        // dd($data_user->createToken('auth_token')->plainTextToken);
        return response()->json([
            'status'=> true,
            'message' => ' Login berhasil',
            'login_token' => $data_user->createToken('auth_token')->plainTextToken,
            'login_data' => $data_user
        ],401); 
    }

    public function logout(){
        Auth::logout();
        return response()->json([
            'status'=> true,
            'message' => ' berhasil logout',
        ],200);  
    }

    public function verify(){
        return response()->json([
            'status'=> false,
            'message' => ' anda belum login',
        ],401);  
    }
}