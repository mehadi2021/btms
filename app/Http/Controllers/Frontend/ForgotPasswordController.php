<?php

namespace App\Http\Controllers\Frontend;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Booking;
use Illuminate\Http\Request;

class ForgotPasswordController extends Controller
{

      public function forgotPass()
    {
        $categories=Booking::all();

       return view('frontend.pages.password.forgotPassword',compact('categories'));
   }


  public function postEmail(Request $request)
   {
     $request->validate([
         'email' => 'required|email|exists:users',
     ]);

     $token = Str::random(64);

       DB::table('password_resets')->insert(
           ['email' => $request->email, 'token' => $token, 'created_at' => Carbon::now()]
       );

       Mail::send('frontend.pages.password.verify', ['token' => $token], function($message) use($request){
           $message->to($request->email);
           $message->subject('Reset Password Notification');
       });

       return back()->with('success', 'We have e-mailed your password reset link!');
   }
}