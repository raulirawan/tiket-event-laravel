<?php

namespace App\Http\Controllers;


use App\Cart;
use Exception;
use App\Events;
use App\EventUser;
use Midtrans\Snap;
use App\Transaction;
use Midtrans\Config;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Mail\TransactionSuccess;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\TransactionConfirmation;
use RealRashid\SweetAlert\Facades\Alert;

class CheckoutController extends Controller
{
    public function checkout(Request $request)
    {
        $code = 'EVNT-' . mt_rand(00000, 99999);

        $cart = Cart::with(['event', 'user'])
            ->where('user_id', Auth::user()->id)
            ->first();

        // dd($cart);


        if (EventUser::where('user_id', $cart->user_id)
            ->where('event_id', $cart->event_id)
            ->exists()
        ) {
            Alert::error('Gagal', 'Data Anda Sudah Terdaftar di Event Ini');
            return redirect()->route('cart');
        } else {

            $data = [
                'event_id'                  => $cart->event_id,
                'user_id'                   => Auth::user()->id,
                'total_price'               => $cart->event->price,
                'code_transaction'          => $code,
                'status'                    => 'PENDING',
                'payment_url'               => '',
            ];

            $transaction = Transaction::create($data);

            // $EventUser = EventUser::create([
            //     'event_id'                  => $cart->event_id,
            //     'user_id'                   => Auth::user()->id,
            //     'transaction_id'            => $transaction->id,
            //     'code'                      => Str::random(10),
            //     'status_checkin'            => 0,
            // ]);

            Cart::with(['event', 'user'])
                ->where('user_id', Auth::user()->id)
                ->delete();

            // dd($EventUser->transaction->user->name);

            // $minStock = Events::findOrFail($cart->event_id);

            // $minStock->event_stock -= 1;
            // $minStock->save();

            


            //ser konfigurasi midtrans
            Config::$serverKey = config('services.midtrans.serverKey');
            Config::$isProduction = config('services.midtrans.isProduction');
            Config::$isSanitized = config('services.midtrans.isSanitized');
            Config::$is3ds = config('services.midtrans.is3ds');


            //Buat Array Untuk Kirim API MIDTRANS
            $midtrans_params = [
                'transaction_details' => [
                    'order_id' => 'EVNT-' . $transaction->id,
                    'gross_amount' => (int) $transaction->total_price,
                ],

                'customer_details' => [
                    'first_name' => $transaction->user->name,
                    'email' => $transaction->user->email,
                ],

                'enable_payments' => ['gopay'],
                'vtweb' => [],
            ];

            try {
                //ambil halaman payment midtrans
                $paymentUrl = Snap::createTransaction($midtrans_params)->redirect_url;
                
                $transaction->payment_url = $paymentUrl;
                $transaction->save();

                Mail::to($transaction->user)->send(
                    new TransactionConfirmation($transaction)
                );
                //reditect halaman midtrans
                return redirect($paymentUrl);
            } catch (Exception $e) {
                echo $e->getMessage();
            }

            
        }
        //kirim email
        // Mail::to($EventUser->user)->send(
        //     new TransactionSuccess($EventUser)
        // );

        // return redirect()->route('success');
    }
}
