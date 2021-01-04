<?php

namespace App\Http\Controllers;


use App\Cart;
use App\Events;
use App\EventUser;
use App\Transaction;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Mail\TransactionSuccess;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class CheckoutController extends Controller
{
    public function checkout(Request $request)
    {
        $code = 'EVNT-' . mt_rand(00000,99999);

        $cart = Cart::with(['event','user'])
                ->where('user_id', Auth::user()->id)
                ->first();

        // dd($cart);

       
        $data = [
            'event_id'                  => $cart->event_id,
            'user_id'                   => Auth::user()->id,
            'total_price'               => $cart->event->price,
            'code_transaction'          => $code,
            'status'                    => 'PENDING',
        ];

    
        
        $transaction = Transaction::create($data);

        $EventUser = EventUser::create([
        'event_id'                  => $cart->event_id,
        'user_id'                   => Auth::user()->id,
        'transaction_id'            => $transaction->id,
        'code'                      => Str::random(10),
        'status_checkin'            => 0,
        ]);
        

        
        
        // dd($EventUser->transaction->user->name);

        $minStock = Events::findOrFail($cart->event_id);

        $minStock->event_stock -= 1;
        $minStock->save();

        Cart::with(['event','user'])
                ->where('user_id', Auth::user()->id)
                ->delete();

            

        Mail::to($EventUser->user)->send(
            new TransactionSuccess($EventUser));

        return redirect()->route('success');
    }
}
