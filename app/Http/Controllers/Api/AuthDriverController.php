<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthDriverController extends Controller
{
    public function login(Request $request){
        $loginDriv= $request->all();
        $validate = Validator::make($loginDriv,[
            'email'=>'required|email',
            'password'=>'required'
        ]);
        if($validate->fails())
        return response([
            'message'=> $validate->errors()], 400);

            $email = $loginDriv['email'];
            $password = $loginDriv['password'];
    
            if(!Auth::guard('driver')->attempt([
                'email' => $email,
                'password' => $password
            ])) {
                return response([
                    'message' => 'Invalid Credentials'
                ], 401);
            }
            /** @var \App\Models\Driver $user **/
            $user = Auth::guard('driver')->user();
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
            /** @var \App\Models\Driver $user **/
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
