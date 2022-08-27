<?php

namespace App\Http\Controllers\Frontend;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Booking;
use App\Models\Payment;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserPaymentController extends Controller
{
    public function userpayment($id){
        // dd($id);
        // $view = true;
        $booking = Booking::find($id);
        $payment = Payment::where('user_id',$id)->get();
        // dd($payment);
        if ($payment->isEmpty() ) {
            // $view = false;
            return view('frontend.pages.userpayment',compact('id','booking'));

        }
        else {
            return view('frontend.pages.userpayment',compact('id','booking'));
        }
    }

    public function store(Request $request,$id){

       // dd($request->all());
        // dd($id);
        Payment::create([
            'user_id'=>Auth::user()->id,
            'payment_mathod'=>$request->payment_mathod,
            'transaction_id'=>$request->transaction_id,
            'amount'=>$request->amount,

        ]);
         $booking = Booking::where('user_id',$id)->orderBy('id', 'DESC')
        ->where('created_at','>=',Carbon::today())
        ->update(['status'=>'Complete']);

        // $Bookingg->status= 'complete';
        // $Bookingg->save();



        return redirect()->route('view.info', ['id' => $id])->with('message', 'Payment Succefully!');

    }
}