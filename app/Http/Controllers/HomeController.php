<?php

namespace App\Http\Controllers;

use App\Events;
use App\Category;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
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









}
