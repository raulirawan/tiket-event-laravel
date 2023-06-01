@extends('layouts.app')

@section('title','Event Page')
    
@section('content')
    <div class="page-content page-home">
      
       
       <section class="section-upcomingEvent">
        <div class="container">
          @csrf
          <h5 id="eventData">Upcoming Events</h5>

       
          </div>
      </section>
    </div>
@endsection

@push('down-script')

<script>

  var token = $('input[name="_token"]').val();


  load_more('', token);

  function load_more(id = "", token){
    $.ajax({
      url:'{{ route("load-more-data") }}',
      method: 'POST',
      data: {id: id, _token: token},
      success: function(data) {
        $('#loadMoreButton').remove();
        $('#eventData').append(data);
      }
    });
  }

  $('body').on('click','#loadMoreButton', function() {
    var id = $(this).data('id');

     $('#loadMoreButton').html("Loading...");
    load_more(id, token);
  });

</script>


@endpush