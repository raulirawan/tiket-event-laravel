@extends('layouts.app')

@section('title','Event Page')
    
@section('content')
    <div class="page-content page-home">
      
      <section class="section-upcomingEvent">
        <div class="container">
          <h5>Upcoming Events</h5>
          <div class="row justify-content-center">
            <div
              class="col-lg-4 col-md-6 col-12 upcoming-event"
              data-aos="fade-up"
              data-aos-delay="100"
            >
              <a href="/details.html">
                <div class="card">
                  <img
                    class="card-img-top"
                    src="{{ url('frontend/images') }}/1.jpg"
                    alt="Card image cap"
                  />
                  <div class="type-event px-3 pt-1">
                    <h4>FREE</h4>
                  </div>
                  <div class="card-body">
                    <div class="d-flex">
                      <div class="date pr-4 align-self-center">
                        <div class="month">OKT</div>
                        <div class="date">20</div>
                      </div>
                      <div class="desc">
                        <div class="title-event">Indonesia Food Diary</div>
                        <div class="location-event">
                          Jakarta Barat, Indonesia
                        </div>
                        <div class="price-event">Rp200.000</div>
                      </div>
                    </div>
                  </div>
                </div>
              </a>
            </div>
            <div
              class="col-lg-4 col-md-6 col-12 upcoming-event"
              data-aos="fade-up"
              data-aos-delay="200"
            >
              <a href="/details.html">
                <div class="card">
                  <img
                    class="card-img-top"
                    src="{{ url('frontend/images') }}/2.jpg"
                    alt="Card image cap"
                  />
                  <div class="type-event px-3 pt-1">
                    <h4>FREE</h4>
                  </div>
                  <div class="card-body">
                    <div class="d-flex">
                      <div class="date pr-4 align-self-center">
                        <div class="month">OKT</div>
                        <div class="date">20</div>
                      </div>
                      <div class="desc">
                        <div class="title-event">DWS x Budi Doremi</div>
                        <div class="location-event">
                          Jakarta Barat, Indonesia
                        </div>
                        <div class="price-event">Rp200.000</div>
                      </div>
                    </div>
                  </div>
                </div>
              </a>
            </div>
            <div
              class="col-lg-4 col-md-6 col-12 upcoming-event"
              data-aos="fade-up"
              data-aos-delay="300"
            >
              <a href="/details.html">
                <div class="card">
                  <img
                    class="card-img-top"
                    src="{{ url('frontend/images') }}/3.jpg"
                    alt="Card image cap"
                  />
                  <div class="type-event px-3 pt-1">
                    <h4>FREE</h4>
                  </div>
                  <div class="card-body">
                    <div class="d-flex">
                      <div class="date pr-4 align-self-center">
                        <div class="month">OKT</div>
                        <div class="date">20</div>
                      </div>
                      <div class="desc">
                        <div class="title-event">Allbase Jange Reonian</div>
                        <div class="location-event">
                          Jakarta Barat, Indonesia
                        </div>
                        <div class="price-event">Rp200.000</div>
                      </div>
                    </div>
                  </div>
                </div>
              </a>
            </div>
            <div
              class="col-lg-4 col-md-6 col-12 upcoming-event"
              data-aos="fade-up"
              data-aos-delay="400"
            >
              <a href="/details.html">
                <div class="card">
                  <img
                    class="card-img-top"
                    src="{{ url('frontend/images') }}/4.jpg"
                    alt="Card image cap"
                  />
                  <div class="type-event px-3 pt-1">
                    <h4>FREE</h4>
                  </div>
                  <div class="card-body">
                    <div class="d-flex">
                      <div class="date pr-4 align-self-center">
                        <div class="month">OKT</div>
                        <div class="date">20</div>
                      </div>
                      <div class="desc">
                        <div class="title-event">Street Meal In The Dark</div>
                        <div class="location-event">
                          Jakarta Barat, Indonesia
                        </div>
                        <div class="price-event">Rp200.000</div>
                      </div>
                    </div>
                  </div>
                </div>
              </a>
            </div>
            <div
              class="col-lg-4 col-md-6 col-12 upcoming-event"
              data-aos="fade-up"
              data-aos-delay="500"
            >
              <a href="/details.html">
                <div class="card">
                  <img
                    class="card-img-top"
                    src="{{ url('frontend/images') }}/5.jpg"
                    alt="Card image cap"
                  />
                  <div class="type-event px-3 pt-1">
                    <h4>FREE</h4>
                  </div>
                  <div class="card-body">
                    <div class="d-flex">
                      <div class="date pr-4 align-self-center">
                        <div class="month">OKT</div>
                        <div class="date">20</div>
                      </div>
                      <div class="desc">
                        <div class="title-event">Seafood Diary</div>
                        <div class="location-event">
                          Jakarta Barat, Indonesia
                        </div>
                        <div class="price-event">Rp200.000</div>
                      </div>
                    </div>
                  </div>
                </div>
              </a>
            </div>
            <div
              class="col-lg-4 col-md-6 col-12 upcoming-event"
              data-aos="fade-up"
              data-aos-delay="600"
            >
              <a href="/details.html">
                <div class="card">
                  <img
                    class="card-img-top"
                    src="{{ url('frontend/images') }}/6.jpg"
                    alt="Card image cap"
                  />
                  <div class="type-event px-3 pt-1">
                    <h4>FREE</h4>
                  </div>
                  <div class="card-body">
                    <div class="d-flex">
                      <div class="date pr-4 align-self-center">
                        <div class="month">OKT</div>
                        <div class="date">20</div>
                      </div>
                      <div class="desc">
                        <div class="title-event">Musical Dramatic</div>
                        <div class="location-event">
                          Jakarta Barat, Indonesia
                        </div>
                        <div class="price-event">Rp200.000</div>
                      </div>
                    </div>
                  </div>
                </div>
              </a>
            </div>
            <div class="btn btn-seemore text-center mt-5 px-4">Load More</div>
          </div>
        </div>
      </section>
    </div>
@endsection