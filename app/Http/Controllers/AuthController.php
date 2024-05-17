<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(Request $request){
        $credential=$request->validate([
            'email'=>'required|email',
            'password'=>'required'
        ]);
        if(Auth::attempt([$credential])){
            $user=User::where('email',$request->email)->first();
            $token=$user->createToken('api-news')->plainTextToken;
            return response()->json(['token'=>$token],200);
        }else{
            return response()->json(['Credenciais invalidas'],401);
        }
    }
}
