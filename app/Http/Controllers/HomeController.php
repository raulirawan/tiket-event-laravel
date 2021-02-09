<?php

namespace App\Http\Controllers;

use App\Events;
use App\Category;
use App\EventUser;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware(['auth','verified']);
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $categories = Category::take(6)->get();

        $events = Events::with(['galleries'])->take(9)->latest()->get();
        return view('pages.home', compact('categories', 'events'));
    }

    public function checkTicket(Request $request)
    {
        $keyword = $request->get('keyword');

        // $ticket = EventUser::all();

        $ticket = EventUser::where("code",$keyword)->first();

       
        return view('pages.ticket.check-ticket', compact('ticket'));
    }
}
