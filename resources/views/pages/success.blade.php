@extends('layouts.success')

@section('title','Success Page')
    
@section('content')
 <div class="page-content page-success">
    <div class="container">
    <div
        class="row align-items-center row-success justify-content-center"
        data-aos="zoom-in"
    >
        <div class="col-lg-6 text-center">
        <div class="img-success">
            <img
            src="{{ url('frontend/images/img-success.svg') }}"
            class="w-100"
            alt="Image Success"
            />
            <h2 class="text-center mt-5">Yay! <br />Transaction Success!</h2>
            <div class="message text-center">
            <p>Check your ticket, in your inbox email Thanks You...</p>
            </div>

            <a href="{{ route('home') }}" class="btn btn-home-page">
            Go To Home Page</a
            >
        </div>
        </div>
    </div>
    </div>
    </div>
@endsection

 
 
