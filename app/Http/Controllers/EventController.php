<?php

namespace App\Http\Controllers;

use App\Events;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index()
    {
        return view('pages.event');
    }

    public function detail($id)
    {
        $event = Events::with( ['galleries','user'])->where('slug', $id)->firstOrFail();
        return view('pages.event-detail', compact('event'));
    }
}
