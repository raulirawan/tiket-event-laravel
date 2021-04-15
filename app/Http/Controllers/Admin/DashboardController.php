<?php

namespace App\Http\Controllers\Admin;

use App\Events;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Transaction;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $events  =  Events::with(['user', 'category'])
            ->where('user_id', Auth::user()->id)
            ->count();

        $pending = Transaction::with(['user', 'event'])
            ->where('status', 'PENDING')
            ->whereHas('event', function ($event) {
                $event->where('user_id', Auth::user()->id);
            })->count();

        $success = Transaction::with(['user', 'event'])
            ->where('status', 'SUCCESS')
            ->whereHas('event', function ($event) {
                $event->where('user_id', Auth::user()->id);
            })->count();

        $failed = Transaction::with(['user', 'event'])
            ->where('status', 'FAILED')
            ->whereHas('event', function ($event) {
                $event->where('user_id', Auth::user()->id);
            })->count();


        $transactions = Transaction::with(['user', 'event'])
        ->where('status', 'SUCCESS')
            ->whereHas('event', function ($event) {
                $event->where('user_id', Auth::user()->id);
            });

        $revenue = $transactions->get()->reduce(function ($carry, $item) {
            return $carry + $item->total_price;
        });


        return view('pages.admin.dashboard', compact('events', 'pending', 'success', 'failed','revenue'));
    }
}
