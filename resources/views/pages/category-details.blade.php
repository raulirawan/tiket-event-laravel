@extends('layouts.app')

@section('title','Category Page')
    
@section('content')
    <div class="page-content page-home">
      
    

       <section class="section-category">
        <div class="container">
          <h5>Browse By Categories</h5>
          <div class="row justify-content-center">
          @php $incrementCategory = 0 @endphp
           @foreach ($categories as $category)
            <div
              class="col-lg-4 col-12 category"
              data-aos="fade-up"
              data-aos-delay="{{ $incrementCategory += 100 }}"
            >
              <a href="{{ route('category-detail', $category->slug) }}">
                <div class="card pl-2">
                  <div class="card-body">
                    <div class="content d-flex">
                      <img
                        src="{{ Storage::url($category->photos) }}"
                        class="pr-3"
                        alt=""
                      />
                      <div class="desc">
                        <h4>{{ $category->name }}</h4>
                        <p class="">
                          Lorem Ipsum is simply dummy text of the printing and
                          industry.
                        </p>
                      </div>
                    </div>
                  </div>
                </div>
              </a>
            </div>
           @endforeach
          </div>
        </div>
      </section>

        <section class="section-upcomingEvent">
        <div class="container">
          <h5>Upcoming Events</h5>
          <div class="row justify-content-center">
            @php $incrementEvent = 0 @endphp
            @forelse ($events as $event)

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
                        <div class="price-event">GRATIS</div>
                        @endif
                      </div>
                    </div>
                  </div>
                </div>
              </a>
            </div>
            @empty
            <div class="col-12 text-center py-5" 
                 data-aos="fade-up"
                 data-aos-delay="100">
                 No Event Found
            </div> 
            @endforelse    
          </div>
        <div class="row justify-content-center">
             <div class="btn btn-seemore text-center mt-5 px-4">Load More</div>
        </div>
          </div>
      </section>

      
    </div>
@endsection
