<?php

namespace App\Http\Controllers;

use App\Cart;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        
        $carts = Cart::with(['event.galleries','user'])->where('user_id', Auth::user()->id)->get();

        return view('pages.cart', compact('carts'));
 
    }

    public function delete($id)
    {
        $cart = Cart::findOrFail($id);

        $cart->delete();

        return redirect()->route('cart');
    }

    public function success()
    {
        return view('pages.success');
    }
}
