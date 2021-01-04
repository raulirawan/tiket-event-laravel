<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Events;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{
    public function index()
    {
        $events = Events::with(['galleries'])->latest()->get();
        return view('pages.event', compact('events'));
    }

    public function detail($id)
    {
        $event = Events::with( ['galleries','user'])->where('slug', $id)->firstOrFail();
        return view('pages.event-detail', compact('event'));
    }

    public function addTicket($id)
    {

        Cart::with(['product','user'])
            ->where('user_id', Auth::user()->id)
            ->delete();

        $data = [
            'event_id' => $id,
            'user_id' => Auth::user()->id,
        ];

        Cart::create($data);

        return redirect()->route('cart');

    }
}
