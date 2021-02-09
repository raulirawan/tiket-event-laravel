<?php

namespace App\Http\Controllers;

use App\Events;
use Illuminate\Http\Request;
use App\Mail\TransactionSuccess;
use App\Transaction;
use Illuminate\Support\Facades\Mail;
use Midtrans\Config;
use Illuminate\Support\Str;

use Midtrans\Notification;
use App\EventUser;
use Illuminate\Support\Facades\Auth;

class MidtransController extends Controller
{
    public function notificationHandler(Request $request)
    {
        //set konfigurasi midtrans
        Config::$serverKey = config('services.midtrans.serverKey');
        Config::$isProduction = config('services.midtrans.isProduction');
        Config::$isSanitized = config('services.midtrans.isSanitized');
        Config::$is3ds = config('services.midtrans.is3ds');

        //buat instance midtrans
        $notification = new Notification();

        //assign ke variable untuk memudahkan coding
        $order = explode('-', $notification->order_id);


        $status = $notification->transaction_status;
        $type = $notification->payment_type;
        $fraud = $notification->fraud_status;
        $order_id = $order[1];


        $transaction = Transaction::findOrFail($order_id);

        // handler notification status midtrans

        if ($status == 'capture') {
            if ($type == 'credit_card') {
                if ($fraud == 'challenge') {
                    $transaction->status = 'CHALLENGE';
                } else {
                    $transaction->status = 'SUCCESS';

                    $EventUser = EventUser::create([
                        'event_id'                  => $transaction->event_id,
                        'user_id'                   => $transaction->user->id,
                        'transaction_id'            => $transaction->id,
                        'code'                      => Str::random(10),
                        'status_checkin'            => 0,
                    ]);

                    $minStock = Events::findOrFail($EventUser->event_id);

                    $minStock->event_stock -= 1;
                    $minStock->save();
                }
            }
        } else if ($status == 'settlement') {
            $transaction->status = 'SUCCESS';

            $EventUser = EventUser::create([
                'event_id'                  => $transaction->event_id,
                'user_id'                   => $transaction->user->id,
                'transaction_id'            => $transaction->id,
                'code'                      => Str::random(10),
                'status_checkin'            => 0,
            ]);

            // kurangin stock event
            $minStock = Events::findOrFail($EventUser->event_id);

            $minStock->event_stock -= 1;
            $minStock->save();
        } else if ($status == 'pending') {
            $transaction->status = 'PENDING';
        } else if ($status == 'deny') {
            $transaction->status = 'FAILED';
        } else if ($status == 'expired') {
            $transaction->status = 'EXPIRED';
        } else if ($status == 'cancel') {
            $transaction->status = 'FAILED';
        }

        //simpan transaction

        $transaction->save();

        //cari transaksi berdasarkan id
        $EventUser = EventUser::where('transaction_id', $order_id)->firstOrFail();

        //kirim email
        if ($transaction) {
            if ($status == 'capture' && $fraud == 'accept') {
                //pengurangan stock tiket event

                Mail::to($EventUser->user)->send(
                    new TransactionSuccess($EventUser)
                );
            } else if ($status == 'settlement') {

                Mail::to($EventUser->user)->send(
                    new TransactionSuccess($EventUser)
                );
            } else if ($status == 'success') {

                Mail::to($EventUser->user)->send(
                    new TransactionSuccess($EventUser)
                );
            } else if ($status == 'capture' && $fraud == 'challenge') {
                return response()->json([
                    'meta' => [
                        'code' => 200,
                        'message' => 'Midtrans Payment Challenge'
                    ]
                ]);
            } else {
                return response()->json([
                    'meta' => [
                        'code' => 200,
                        'message' => 'Midtrans Payment Not Settlement'
                    ]
                ]);
            }

            return response()->json([
                'meta' => [
                    'code' => 200,
                    'message' => 'Midtrans Notification Success'
                ]
            ]);
        }
    }

    public function finishRedirect(Request $request)
    {
        return view('pages.success');
    }

    public function unfinishRedirect(Request $request)
    {
        return view('pages.unfinish');
    }

    public function errorRedirect(Request $request)
    {
        return view('pages.error');
    }
}
