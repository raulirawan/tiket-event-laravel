@extends('layouts.app')

@section('title','Detail Event Page')
    
@section('content')
    
    <div class="page-content page-details">
      <section class="section-breadcrumbs">
        <div class="container">
          <div class="row" data-aos="fade-down" data-aos-duration="1000">
            <div class="col-12">
              <nav>
                <ol class="breadcrumb">
                  <li class="breadcrumb-item">
                    <a href="{{ route('home') }}">Home</a>
                  </li>

                  <li class="breadcrumb-item active">Event Details</li>
                </ol>
              </nav>
            </div>
          </div>
        </div>
      </section>

      <section class="event-gallery" id="gallery">
        <div class="container">
          <div class="row">
            <div class="col-lg-8" data-aos="zoom-in">
              <transition name="slide-fade" mode="out-in">
                <img
                  :src="photos[activePhoto].url"
                  :key="photos[activePhoto].id"
                  class="w-100 main-image"
                  alt=""
                />
              </transition>
            </div>
            <div class="col-lg-2">
              <div class="row">
                <div
                  class="col-3 col-lg-12 mt-2 mt-lg-0"
                  v-for="(photo, index) in photos"
                  :key="photo.id"
                  data-aos="zoom-in"
                  data-aos-delay="100"
                >
                  <a href="#" @click="changeActive(index)">
                    <img
                      :src="photo.url"
                      class="w-100 thumbnail-image"
                      :class="{ active: index == activePhoto }"
                      alt=""
                    />
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>

      <section class="section-information mt-3">
        <div class="container">
          <div class="row" data-aos="fade-up" data-aos-delay="200">
            <div class="col-lg-8">
              <div class="title-event">
                <h2>{{ $event->name }}</h2>
              </div>
              <div class="owner-event">By, {{ $event->user->name }}</div>
              <div class="price">Rp{{ number_format($event->price) }}</div>
              <div class="description">
                {!! $event->description !!}
              </div>
            </div>

            <div class="col-lg-4 align-self-center event-information">
              <div class="card">
                <div class="card-body">
                  <h4 class="text-center mb-4">Event Information</h4>
                  <div class="border-top"></div>
                  <div class="item-information d-flex justify-content-between">
                    <div class="date">Date</div>
                    <div class="">{{ $event->date_time->format('d M y') }}</div>
                  </div>
                  <div class="item-information d-flex justify-content-between">
                    <div class="date">Time Start</div>
                    <div class="">{{ $event->date_time->format('h:i') }} A.M</div>
                  </div>
                  <div class="item-information d-flex justify-content-between">
                    <div class="type">Event Type</div>
                    <div class="">{{ $event->event_type }}</div>
                  </div>
                  <div class="item-information d-flex justify-content-between">
                    @if($event->event_type == 'PREMIUM')
                    <div class="type">Price</div>
                    <div class="">Rp{{ number_format($event->price) }}</div>
                    @else
                    <div class=""></div>
                    @endif
                  </div>
                  @auth
                  <form action="{{ route('add-ticket', $event->id) }}" method="POST" enctype="multipart/form-data">
                      @csrf
                      @php
                        $dateTime = $event->date_time;
                        $dateNow = strtotime('now');

                        $dateEvent = strtotime($dateTime);

                      @endphp
                      @if ($event->event_stock > 0 && $dateEvent >= $dateNow)
                      <button 
                      type="submit"
                      class="btn btn-add px-4 text-white btn-block mb-3"
                        >Buy Ticket
                      </button>
                      {{-- @elseif ($dateEvent < $dateNow)
                      <button 
                      class="btn btn-danger px-4 text-white btn-block mb-3"
                        disabled>Expired
                      </button> --}}
                      @else
                      <button 
                      class="btn btn-danger px-4 text-white btn-block mb-3"
                        disabled>Sold Out Or Expired
                      </button>
                      @endif
                  </form>
                  @endauth
                  @guest
                      <a
                        href="{{ route('login') }}"
                        class="btn btn-add px-4 text-white btn-block mb-3"
                        >Login to Buy Ticket
                      </a>
                  @endguest
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
      <section class="section-location">
        <div class="container">
          <div class="row" data-aos="fade-up" data-aos-duration="2000">
            <div class="col-lg-12">
              <h2 class="mb-4 mt-2">Location Event</h2>
              <div class="embed-responsive embed-responsive-16by9">
                {!! $event->location_details !!}
              </div>
            </div>
          </div>
        </div>
      </section>
    </div>

@endsection

@push('down-script')
    <script src="{{ url('frontend/vendor/vue/vue.js') }}"></script>
    <script>
      var gallery = new Vue({
        el: "#gallery",
        mounted() {
          AOS.init();
        },
        data: {
          activePhoto: 0,
          photos: [
            @foreach($event->galleries as $gallery)
            {
              id: {{ $gallery->id }},
              url: "{{ Storage::url($gallery->photos) }}",
            },
            @endforeach
          ],
        },
        methods: {
          changeActive(id) {
            this.activePhoto = id;
          },
        },
      });
    </script>
@endpush
