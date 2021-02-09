@extends('layouts.app')

@section('title','Cart Page')
    
@section('content')
  <div class="page-content page-cart">
      <section class="section-breadcrumbs">
        <div class="container">
          <div class="row" data-aos="fade-down" data-aos-duration="1000">
            <div class="col-6">
              <nav>
                <ol class="breadcrumb">
                  <li class="breadcrumb-item">
                    <a href="/index.html">Home</a>
                  </li>

                  <li class="breadcrumb-item active">Cart</li>
                </ol>
              </nav>
            </div>
          </div>
        </div>
      </section>
      
        @php
          $cartCount = \App\Cart::where('user_id', Auth::user()->id)->count();
        @endphp

        @if($cartCount > 0)
      <section class="section-order-tiket">
        <div class="container">
          <div
            class="row"
            data-aos="fade-right"
            data-aos-duration="1000"
            data-aos-delay="200"
          >
            <div class="col-lg-8 col-12">
              <h2
                data-aos="fade-right"
                data-aos-duration="1000"
                data-aos-delay="100"
              >
                Ticket Order Summary
              </h2>
              <table class="table table-borderless table-responsive table-cart">
                <thead>
                  <tr>
                    <td>Event</td>
                    <td>Name Event</td>
                    <td>Price</td>
                    <td>Action</td>
                  </tr>
                </thead>
                <tbody>
                  
                  @foreach ($carts as $cart)
                      <tr>
                        <td style="width: 20%">
                          <img src="{{ Storage::url($cart->event->galleries->first()->photos) }}" alt="" class="cart-image" />
                        </td>
                        <td style="width: 35%">
                          <div class="event-title">{{ $cart->event->name }}</div>
                          <div class="event-subtitle">By, {{ $cart->event->user->name }}</div>
                        </td>
                        <td style="width: 35%">
                          @if($cart->event->event_type == 'PREMIUM')
                          <div class="event-title">Rp{{ number_format($cart->event->price) }}</div>
                          @else
                          <div class="event-title">FREE</div>
                          @endif
                          <div class="event-subtitle">IDR</div>
                        </td>
                        <td style="width: 35%">
                           <form action="{{ route('cart-delete', $cart->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                          <button type="submit" class="btn btn-remove px-4">Remove</button>
                          </form>
                        </td>
                      </tr>
                  @endforeach
                 
                </tbody>
              </table>
            </div>

            
            <div class="col-lg-4 col-12">
              <div class="card">
                <div class="card-body">
                  <h2 class="mb-4 text-center">Payment Info</h2>
                  <div
                    class="payment-information d-flex justify-content-between"
                  >
                    <div class="side-left text-muted">Your Name</div>
                    <div class="side-right">{{ $cart->user->name }}</div>
                  </div>
                  <div
                    class="payment-information d-flex justify-content-between"
                  >
                    <div class="side-left text-muted">Your Email</div>
                    <div class="side-right">{{ $cart->user->email }}</div>
                  </div>
      
                  <div class="border-bottom mb-4"></div>
                  
                  @if($cart->event->event_type == 'PREMIUM')
                   <div
                    class="payment-information d-flex justify-content-between"
                  >
                    <div class="side-left text-muted">Total Price</div>
                    <div class="side-right">Rp{{ number_format($cart->event->price) }}</div>
                  </div>
                  @else
                  <div
                    class="payment-information d-flex justify-content-between"
                  >
                    <div class="side-left text-muted">Total Price</div>
                    <div class="side-right">FREE</div>
                  </div>
                 
                  @endif

                  <form action="{{ route('checkout') }}" method="POST" enctype="multipart/form-data">
                     @csrf
                    <button type="submit" class="btn btn-checkout btn-block mt-4">Checkout Now</button>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
        @else
        <div class="text-center" data-aos="fade-up">Data Keranjang Kosong, Silahkan Melakukan Pembelian Tiket</div>
        @endif
    </div>
@endsection
