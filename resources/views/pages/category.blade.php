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

      
    </div>
@endsection
