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
                  <tr>
                    <td style="width: 20%">
                      <img src="{{ url('frontend/images/1.jpg') }}" alt="" class="cart-image" />
                    </td>
                    <td style="width: 35%">
                      <div class="event-title">Indonesia Food Diary</div>
                      <div class="event-subtitle">By, PT. Indo Persada</div>
                    </td>
                    <td style="width: 35%">
                      <div class="event-title">Rp200.000</div>
                      <div class="event-subtitle">IDR</div>
                    </td>
                    <td style="width: 35%">
                      <a href="#" class="btn btn-remove px-4">Remove</a>
                    </td>
                  </tr>
                  <tr>
                    <td style="width: 20%">
                      <img src="{{ url('frontend/images/3.jpg') }}" alt="" class="cart-image" />
                    </td>
                    <td style="width: 35%">
                      <div class="event-title">DWS x Younglex</div>
                      <div class="event-subtitle">By, PT. Indo Persada</div>
                    </td>
                    <td style="width: 35%">
                      <div class="event-title">Rp300.000</div>
                      <div class="event-subtitle">IDR</div>
                    </td>
                    <td style="width: 35%">
                      <a href="#" class="btn btn-remove px-4">Remove</a>
                    </td>
                  </tr>
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
                    <div class="side-right">Raul Irawan</div>
                  </div>
                  <div
                    class="payment-information d-flex justify-content-between"
                  >
                    <div class="side-left text-muted">Your Email</div>
                    <div class="side-right">raulirawan@gmail.com</div>
                  </div>
                  <div
                    class="payment-information d-flex justify-content-between"
                  >
                    <div class="side-left text-muted">Mobile Number</div>
                    <div class="side-right">087883496655</div>
                  </div>
                  <div class="border-bottom mb-4"></div>
                  <div
                    class="payment-information d-flex justify-content-between"
                  >
                    <div class="side-left text-muted">Total Price</div>
                    <div class="side-right">Rp500.000</div>
                  </div>

                  <a href="{{ route('success') }}" class="btn btn-checkout d-block mt-4"
                    >Checkout Now</a
                  >
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
    </div>
@endsection
