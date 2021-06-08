<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


class UserController extends Controller
{
    public function registration(Request $request)
    {
        if( auth()->user()->hasRole(1) || auth()->user()->hasRole(2) || auth()->user()->hasRole(3))
        {
            $validation = Validator::make($request->all(),[

                'name' =>'required',
                'email' =>'required|email|unique:users',
                'password'=>'required|min:6|confirmed',
        
            ]);
    
            if($validation->fails()) {
                return response()->json($validation->errors(),202);
            }
            
            $data = $request ->all();
            $data['password'] = bcrypt($data['password']);

            $user =User::create($data);

            $resArr = [];
            $resArr['token']=$user->createToken('api-application')->accessToken;
            $resArr['name']=$user->name;
            return response()->json($resArr,200);
        } 
        else  {
            return response()->json(["message"=> "you dont have permission to create a user"]);
        }
        
    }


    public function login(Request $request)
    {
        if(Auth::attempt([
            'email'=>$request->email,
            'password'=>$request->password
            ])){
        
                $user = Auth::user();
                $resArr = [];
                $resArr['token']=$user->createToken('api-application')->accessToken;
                $resArr['name']=$user->name;
                return response()->json($resArr,200);
        }else{
            return  response()->json(['error'=>'Unautherized Access'],203);
        }
    }
    
    public function logout(Request $request)
    {
    
        $token = $request->user()->token();
        $token->revoke();
        $response = ["message" => "you have successfully logout"];
        return response($response,200);
    }
}
