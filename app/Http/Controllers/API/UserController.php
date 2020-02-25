<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    public $successStatus = 200;

    //Login function 
    public function login(){
        if(Auth::attempt(['email' => request('email'), 'password' => request('password')])){ //Attempt to login
            $user = Auth::user(); 
            $success['token'] = $user->createToken('nApp')->accessToken; //Create token
            return response()->json(['success' => $success], $this->successStatus); 
        }
        else{
            return response()->json(['error'=>'Unauthorized'], 401);
        }
    }

    //Register function
    public function register(UserRequest $request) // User Request will validate the input
    {
        $input = $request->all();
        $input['password'] = bcrypt($input['password']); 
        $user = User::create($input);
        $success['token'] =  $user->createToken('nApp')->accessToken;
        $success['name'] =  $user->name;
        $success['user_type'] =  $user->user_type;

        return response()->json(['success'=>$success], $this->successStatus);
    }

    public function getDetailUser(){
        return response()->json(['success' => Auth::user()], $this->successStatus);
    }

    public function getDetailOtherUser($user_id){
        return response()->json(['success' => User::findOrFail($user_id)], $this->successStatus);
    }
    
    public function getAllUserCourse($user_id){
        return response()->json(['success' => User::findOrFail($user_id)->course], $this->successStatus);
    }

    public function logout()
    { 
        Auth::user()->OauthAcessToken()->delete();
        return response()->json(['success'=>'logout success'], $this->successStatus);
    }


}