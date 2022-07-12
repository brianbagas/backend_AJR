<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthPegawaiController extends Controller
{
    public function login(Request $request){
        $loginPeg = $request->all();
        $validate = Validator::make($loginPeg,[
            'email'=>'required|email',
            'password'=>'required'
        ]);
        if($validate->fails())
        return response([
            'message'=> $validate->errors()], 400);

            $email = $loginPeg['email'];
            $password = $loginPeg['password'];
    
            if(!Auth::guard('pegawai')->attempt([
                'email' => $email,
                'password' => $password
            ])) {
                return response([
                    'message' => 'Invalid Credentials'
                ], 401);
            }
            /** @var \App\Models\Pegawai $user **/
            $user = Auth::guard('pegawai')->user();
            $token = $user->createToken('Authentication Token')->accessToken;

        return response([
            'message' => 'Authenticated',
            'user'=> $user,
            'token'=> 'Bearer',
            'access_token' => $token
        ]);


    }

    public function logout(Request $request) {
        if($request->user()) {
            /** @var \App\Models\Pegawai $user **/
            $user = $request->user();
            
            $user->token()->revoke();

            return response([
                'message' => 'Successfully Logged Out'
            ]);
        }

        return response([
            'message' => 'Logout Failed'
        ]);
    }
}
