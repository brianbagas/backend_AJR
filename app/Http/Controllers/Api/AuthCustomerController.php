<?php

namespace App\Http\Controllers\Api;

use App\Models\Customer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthCustomerController extends Controller
{


    public function login(Request $request){
        $loginCus = $request->all();
        $validate = Validator::make($loginCus,[
            'email'=>'required|email',
            'password'=>'required'
        ]);
        if($validate->fails())
        return response([
            'message'=> $validate->errors()], 400);

            $email = $loginCus['email'];
            $password = $loginCus['password'];
    
            if(!Auth::guard('customer')->attempt([
                'email' => $email,
                'password' => $password
            ])) {
                return response([
                    'message' => 'Invalid Credentials'
                ], 401);
            }
            /** @var \App\Models\Customer $user **/
            $user = Auth::guard('customer')->user();
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
            /** @var \App\Models\Customer $user **/
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
