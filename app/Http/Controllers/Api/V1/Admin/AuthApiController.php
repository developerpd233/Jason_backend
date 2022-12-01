<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Carbon\Carbon;

class AuthApiController extends controller {

    public function signup(Request $request){
        $request->validate([
            'name' => 'required|string',
            'age' => 'required|string',
            'relationPreference' => 'required|string',
            'email' => 'required|email|',  //|unique:users,email
            'identity' => 'required|string',
            'interest' => 'required|string',
            'favDrink' => 'required|string',
            'favSong' => 'required|string',
            'hobbies' => 'required|string',
            'petPeeve' => 'required|string'
        ]);
        $current_datetime = Carbon::now();
        

        $user = User::where('email', $request->email)->first();

        if ($user) {

            $otp = rand(0, 9999);

            $user->otpEmailCode = $otp;
            $user->otpEmailSentAt = $current_datetime;
            $user->save();

            \Mail::to($request->email)->send(new \App\Mail\signup($user));

            $res = [
                "status" => "verify",
                "message" => "You have already signup. Please verify your Email via OTP."
            ];

            return response($res, 200);
        }else{
            $user = new User();
            $user->name = $request->name;
            $user->age = $request->age;
            $user->relationPreference = $request->relationPreference;
            $user->email = $request->email;
            $user->identity = $request->identity;
            $user->interest = $request->interest;
            $user->favDrink = $request->favDrink;
            $user->favSong = $request->favSong;
            $user->hobbies = $request->hobbies;
            $user->petPeeve = $request->petPeeve;
            $user->qrCodeId = 1;
            
            $user->save();
            
            $token = $user->createToken('apiToken')->plainTextToken;

            $res = [
                'msg' => 'User Data Stored',
                'newUser' => $user,
                'token' => $token
            ]; 

            return response($res, 200);
        }
    }

    public function otpverify(Request $request){
        $request->validate([
            'otpCode' => 'required|numeric'
        ]);

        
        $user = User::where('otpEmailCode', $request->otpCode)->first();
        if ($user) {

            $current_datetime = Carbon::now();
            $time_difference = $current_datetime->diffInMinutes($user->otpEmailSentAt);
            
            if ($time_difference <= 10) {
                
                $token = $user->createtoken('apitoken')->plainTextToken;

                $res = [
                    'status' => 'success',
                    'msg' => 'User email successfully verified by OTP.',
                    'token' => $token,
                    'user' => $user

                ];
                return response($res, 200);
            
            }else{
                $res = [
                    'status' => 'failed',
                    'errorMessage' => 'Invalid OTP'
                ];
                return response($res, 404);
            }
    


        }else{
             $res = [
                    'status' => 'failed',
                    'errorMessage' => 'OTP is Unauthorized, please try again'
                ];
                return response($res, 404);
        }

    }


}




?>