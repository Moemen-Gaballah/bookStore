<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class ApiAuthController extends Controller
{
    public function register (Request $request) {
	 	$this->validate($request, [
            'name' => 'required|string|min:3|max:191',
            'email' => 'required|string|email|max:191|unique:users,email',
            'password' => 'required|min:8|confirmed',
            'password_confirmation' => 'required|min:8'
        ]);


	    // $validator = Validator::make($request->all(), [
	    //     'name' => 'required|string|max:255',
	    //     'email' => 'required|string|email|max:255|unique:users',
	    //     'password' => 'required|string|min:6|confirmed',
	    // ]);
	    // if ($validator->fails())
	    // {
	    //     return response(['errors'=>$validator->errors()->all()], 422);
	    // }
	    $request['password']=Hash::make($request['password']);
	    $request['remember_token'] = Str::random(10);
	    $user = User::create($request->toArray());
	    $token = $user->createToken('Laravel Password Grant Client')->accessToken;
	    $response = ['token' => $token];
	    return response($response, 200);
	} // End method register

	public function login (Request $request) {
		$this->validate($request, [
            'email' => 'required|string|email|max:191',
            'password' => 'required',
        ]);


	    // $validator = Validator::make($request->all(), [
	    //     'email' => 'required|string|email|max:255',
	    //     'password' => 'required|string|min:6',
	    // ]);
	    // if ($validator->fails())
	    // {
	    //     return response(['errors'=>$validator->errors()->all()], 422);
	    // }
	    $user = User::where('email', $request->email)->first();
	    if ($user) {
	        if (Hash::check($request->password, $user->password)) {
	            $token = $user->createToken('Laravel Password Grant Client')->accessToken;
	            $response = ['token' => $token];
	            return response($response, 200);
	        } else {
	            $response = ["message" => "Password mismatch"];
	            return response($response, 422);
	        }
	    } else {
	        $response = ["message" =>'User does not exist'];
	        return response($response, 422);
	    }
	} // end method login 

	public function logout (Request $request) {
	    $token = $request->user()->token();
	    $token->revoke();
	    $response = ['message' => 'You have been successfully logged out!'];
	    return response($response, 200);
	} // end method logout
}
