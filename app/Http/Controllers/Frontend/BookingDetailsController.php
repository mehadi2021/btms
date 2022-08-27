<?php

namespace App\Http\Controllers\Frontend;
use App\Models\User;
use App\Models\Booking;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BookingDetailsController extends Controller
{
    public function bookingdetails(){
        $details = Booking::with('seat')
        ->where('user_id',auth()->user()->id)->orderBy('id', 'DESC')
        ->where('created_at','>=',Carbon::today())
        ->where('status','pending')
        ->get();
        // dd($details);
        // dd(auth()->user());
        return view('frontend.pages.bookingdetails',compact('details'));
    }

    public function viewinfo($id){
        $details = Booking::with('seat')
        ->where('user_id',$id)->orderBy('id', 'DESC')
        ->where('created_at','>=',Carbon::today())
        ->get();
        return view('frontend.pages.viewinfo',compact('details'));

    }


    }