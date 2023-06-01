<?php

namespace App\Http\Controllers;

use App\Events;
use App\Category;
use App\EventUser;
use App\Mail\TestEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
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

        global $ticket;
        // $ticket = EventUser::all();
        $ticket = EventUser::where("code", $keyword)->first();

        if ($ticket) {
            return view('pages.ticket.check-ticket', compact('ticket'));
        }

        //kalau keyword keisi

        if ($keyword != null) {
            Alert::error('Gagal', 'Data Tiket Tidak Di Temukan');
        }
        return view('pages.ticket.check-ticket', compact('ticket'));
    }

    public function loadMore(Request $request)
    {
        if ($request->ajax()) {
            if ($request->id) {
                $events = Events::with(['galleries'])->where('id', '<', $request->id)->orderBy('id','DESC')->limit(6)->get();
            } else {
                $events = Events::with(['galleries'])->orderBy('id','DESC')->limit(6)->get();
            }
        }

        return view('pages.get-event', compact('events'));
    }


    public function tesEmail()
    {
        // $data = [
        //     'title' => "Ini Title",
        //     'body' => "Ini body",
        // ];
        // Mail::to("raulirawan34@gmail.com")->send(new TestEmail($data));
        // return "email terkirim";
        return view('email.test-email');

    }
}
