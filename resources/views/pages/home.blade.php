@extends('layouts.app')

@section('title','Home')
    
@section('content')
    <div class="page-content page-home">
      <section class="section-hero">
        <div class="container">
          <div class="row">
            <div
              class="col-lg-7 col-12 align-self-center"
              data-aos="fade-right"
            >
              <h5>
                A New Way to Find
                <br />
                Your Favorite Exhibition
              </h5>
              <p>
                Various kinds of events in Jakarta, very interesting,
                <br />
                this application is very easy to use
              </p>
              <a href="{{ route('event') }}" class="btn btn-getstarted px-4">Get Started</a>
            </div>

            <div
              class="col-lg-5 col-12 align-self-center pt-4 d-none d-lg-block"
              data-aos="fade-left"
            >
              <div class="img-hero">
                <img src="{{ url('frontend/images') }}/img-hero.svg" class="img-fluid w-100" alt="" />
              </div>
            </div>
          </div>
        </div>
      </section>

      <section class="section-service">
        <div class="container">
          <h5 class="text-center" data-aos="fade-up">
            What Events Are There in Evnt
          </h5>
          <div class="row justify-content-center">
            <div
              class="col-lg-4 col-12 mb-4"
              data-aos="fade-up"
              data-aos-delay="100"
            >
              <div class="img-service text-center">
                <img src="{{ url('frontend/images') }}/icon-social.svg" />
              </div>
              <div class="title">
                <h4 class="text-center py-3">Social Event</h4>
              </div>
              <div class="description">
                <p class="text-center">
                  Lorem Ipsum is simply dummy text of the printing and
                  typesetting industry.
                </p>
              </div>
            </div>
            <div
              class="col-lg-4 col-12 mb-4"
              data-aos="fade-up"
              data-aos-delay="200"
            >
              <div class="img-service text-center">
                <img src="{{ url('frontend/images') }}/icon-ceremony.svg" />
              </div>
              <div class="title">
                <h4 class="text-center py-3">Opening Ceremony</h4>
              </div>
              <div class="description">
                <p class="text-center">
                  Lorem Ipsum is simply dummy text of the printing and
                  typesetting industry.
                </p>
              </div>
            </div>
            <div
              class="col-lg-4 col-12"
              data-aos="fade-up"
              data-aos-delay="300"
            >
              <div class="img-service text-center">
                <img src="{{ url('frontend/images') }}/icon-exhibition.svg" />
              </div>
              <div class="title">
                <h4 class="text-center py-3">Exhibitions and Fairs</h4>
              </div>
              <div class="description">
                <p class="text-center">
                  Lorem Ipsum is simply dummy text of the printing and
                  typesetting industry.
                </p>
              </div>
            </div>
          </div>
        </div>
      </section>

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
                        <div class="price-event">FREE</div>
                        @endif
                      </div>
                    </div>
                  </div>
                </div>
              </a>
            </div>
            @empty
            <div class="text-center">No Event Found</div>

            @endforelse    
          </div>
        <div class="row justify-content-center">
             <a href="{{ route('event') }}" class="btn btn-seemore text-center mt-5 px-4">Load More</a>
        </div>
          </div>
      </section>
    </div>
@endsection
