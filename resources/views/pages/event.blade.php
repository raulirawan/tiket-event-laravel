@extends('layouts.app')

@section('title','Event Page')
    
@section('content')
    <div class="page-content page-home">
      
       <section class="section-upcomingEvent">
        <div class="container">
          <h5>Upcoming Events</h5>
          <div class="row justify-content-center">
            @php $incrementEvent = 0 @endphp
            @foreach ($events as $event)

            <div
              class="col-lg-4 col-md-6 col-12 upcoming-event"
              data-aos="fade-up"
              data-aos-delay="{{ $incrementEvent += 100 }}"
            >
              <a href="{{ route('event-detail', $event->slug) }}">
                <div class="card shadow bg-white rounded">
                  <img
                    class="card-img-top"
                    src="{{ Storage::url($event->galleries->first()->photos) }}"
                    alt="Card image cap"
                  />
                  <div class="type-event px-3 pt-1">
                    <h4>{{ $event->event_type }}</h4>
                  </div>
                  <div class="card-body">
                    <div class="d-flex">
                      <div class="date pr-4 align-self-center">
                        <div class="month">{{ $event->date_time->format('M') }}</div>
                        <div class="date">{{ $event->date_time->format('d') }}</div>
                      </div>
                      <div class="desc">
                        <div class="title-event">{{ $event->name }}</div>
                        <div class="location-event">
                          {{ $event->location }}
                        </div>
                        @if($event->event_type == 'PREMIUM')
                        <div class="price-event">Rp{{ number_format($event->price) }}</div>

                        @else
                        <div class="price-event">FREE</div>
                        @endif
                      </div>
                    </div>
                  </div>
                </div>
              </a>
            </div>
            @endforeach    
          </div>
        <div class="row justify-content-center">
             <div class="btn btn-seemore text-center mt-5 px-4">Load More</div>
        </div>
          </div>
      </section>
    </div>
@endsection