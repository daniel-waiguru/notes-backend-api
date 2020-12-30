<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    // User Register
    public function register(Request $request) {
        $validator  =  Validator::make($request->all(), [
            "name"  =>  "required",
            "email"  =>  "required|email",
            "password"  =>  "required"
        ]);

        if($validator->fails()) {
            return response()->json(["error" => true, "validation_errors" => $validator->errors()]);
        }

        $inputs = $request->all();
        $inputs["password"] = Hash::make($request->password);

        $user = User::create($inputs);

        if(!is_null($user)) {
            return response()->json(["error" => false, "message" => "Success! registration completed", "data" => $user]);
        }
        else {
            return response()->json(["error" => true, "message" => "Registration failed!"]);
        }       
    }

    public function login(Request $request) {
        $validator = Validator::make($request->all(), [
            "email" =>  "required|email",
            "password" =>  "required",
        ]);

        if($validator->fails()) {
            return response()->json(["validation_errors" => $validator->errors()]);
        }

        $user = User::where("email", $request->email)->first();

        if(is_null($user)) {
            return response()->json(["status" => "failed", "message" => "Failed! email not found"]);
        }
        $token = $user->createToken('token')->plainTextToken;
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
            $user = Auth::user();
            return response()->json(["status" => "success", "login" => true, "token" => $token, "data" => $user]);
        }
        else {
            return response()->json(["status" => "failed", "success" => false, "message" => "Whoops! invalid password"]);
        }
    }

    public function logout(Request $request)
    {
        $token = $request->user()->token();
        $token->revoke();
        return response()->json([
            'message' => 'You have been successfully logged out'
        ]);
    }
}
