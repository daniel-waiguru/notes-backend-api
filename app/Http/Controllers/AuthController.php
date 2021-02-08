<?php

namespace App\Http\Controllers;

use App\Mail\WelcomeMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
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
            Mail::to($user->email)->send(new WelcomeMail);
            return response()->json(["error" => false, "status" => "Success! registration completed", "data" => $user]);
        }
        else {
            return response()->json(["error" => true, "status" => "Registration failed!"]);
        }       
    }

    public function login(Request $request) {
        $validator = Validator::make($request->all(), [
            "email" =>  "required|email",
            "password" =>  "required",
        ]);

        if($validator->fails()) {
            return response()->json([
                'error' => true,
                "validation_errors" => $validator->errors()
                ]);
        }

        $user = User::where("email", $request->email)->first();

        if(is_null($user)) {
            return response()->json([
                'error' => true,
                "status" => "failed", 
                "message" => "Failed! email not found"
                ]);
        }
        $user->tokens()->delete();
        $token = $user->createToken('token')->plainTextToken;
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
            $user = Auth::user();
            return response()->json([
                'error' => false,
                "status" => "success",  
                "token" => $token,
                "data" => $user]);
        }
        else {
            return response()->json([
                'error' => true,
                "status" => "failed",  
                "message" => "Whoops! invalid password"]);
        }
    }
    public function showUser() {
        $user = Auth::user();
        if(!is_null($user)){
            return response()->json([
                'error' => false,
                'data' => $user
            ]);
        } else {
            return response()->json([
                'error' => true,
                'message' => "Un-authorized user"
            ]);
        }
    }
    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();
        return response()->json([
            'message' => 'You have been successfully logged out'
        ]);
    }
}
