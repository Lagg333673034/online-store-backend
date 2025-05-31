<?php

namespace App\Http\Controllers;

use App\Models\ModelUser;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class ControllerAuth extends Controller
{
    static public function register(Request $request){
        try{
           $data = $request->validate([
            'name' => ['required','string'],
            'email' => ['required','email'],
            'password' => ['required','min:3']
           ]);
           $user = ModelUser::create($data);
           $token = $user->createToken('auth_token')->plainTextToken;

           return [
                'user' => $user,
                'token' => $token,
           ];
        }catch(Exception $err){
            return $err->getMessage();
        }
    }

    static public function login(Request $request){
        try{
           $data = $request->validate([
            'email' => ['required','email'],
            'password' => ['required','min:3']
           ]);

           $user = ModelUser::where('email',$data['email'])->first();
           if(!$user || !Hash::check($data['password'], $user->password)){
                return response([
                    'message' => 'Not correct',
                ],401);
           }

           $token = $user->createToken('auth_token')->plainTextToken;
           return [
                'user' => $user,
                'token' => $token,
           ];
        }catch(Exception $err){
            return $err->getMessage();
        }
    }

    static public function logout(){
        //pri logout nyjen Bearer token, типо такого в headers 
        //("Bearer 9|NPu8FZ9qlAEDzG3ZJE6Y7M0aF2reL6j0SvTOTdQt17925acb")

        Auth::user()->tokens->each(function ($token, $key) {
                $token->delete();
            });


        return response([
            'status' => true,
            'message' => 'Logout token',
            'data' => [],
        ],200);
    }

    static public function checkAuth(){

        //$userData = Auth::user();
        //$id = Auth::id();
        $isAuth = Auth::check();
        return response([
            'status' => true,
            //'message' => 'User Login profile',
            //'data' => $userData,
            //'id' => $id,
            'isAuth' => $isAuth
        ],200);
    }

    public function userprofile(){
        $userData = Auth::user();
        $id = Auth::id();
        $isAuth = Auth::check();
        return response([
            'status' => true,
            'message' => 'User Login profile',
            'data' => $userData,
            'id' => $id,
            'isAuth' => $isAuth
        ],200);
    }
}
