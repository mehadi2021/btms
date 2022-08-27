<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Booking;


class ResetPasswordController extends Controller
{
     public function getPassword($token) {

      $categories=Booking::all();
        return view('frontend.pages.password.Password', ['token' => $token],compact('categories'));
     }

     public function updatePassword(Request $request)
     {

     $request->validate([
         'email' => 'required|email|exists:users',
         'password' => 'required|string|min:2|confirmed',
         'password_confirmation' =>'required',

     ]);

     $updatePassword = DB::table('password_resets')
                         ->where(['email' => $request->email, 'token' => $request->token])
                         ->first();

     if(!$updatePassword)
         return back()->withInput()->with('error', 'Invalid token!');

       $user = User::where('email', $request->email)
                   ->update(['password' =>Hash::make($request->password)]);

       DB::table('password_resets')->where(['email'=> $request->email])->delete();
       return redirect()->route('user.login')->with('success', 'Your password has been changed!');

     }
}
