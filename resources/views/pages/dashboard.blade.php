@extends('layouts.dashboard')

@section('title','Dashboard Pengunjung')
    

@section('content')

<main>
    <div class="container-fluid">
        <h1 class="mt-4">Hi, {{ Auth::user()->name }}</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Dashboard</li>
        </ol>  
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table mr-1"></i>
                Data Ticket 
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover scroll-horinzontal-vertical w-100" id="crudTable">
                        <thead>
                            <tr>
                                <th style="font-size: 14px">Nama Event</th>
                                <th style="font-size: 14px">Tanggal Event</th>
                                <th style="font-size: 14px">Status</th>
                         
                            </tr>
                        </thead>
                        <tbody style="font-size: 15px">

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</main>
    
@endsection

@push('down-script')

    <script>

    $(document).ready(function() {


            var datatable = $('#crudTable').DataTable({
            processing: true,
            serverSide: true,
            ordering: true,
            ajax:{
                url: '{!! url()->current() !!}',
            },

            columns: [
                { data: 'event.name' , name:  'event.name' },
                { data: 'event.date_time' , name:  'event.date_time' },
                { data: 'status_checkin' , name:  'status_checkin' },
               
            ]
        });

        $.ajaxSetup({
            headers:{
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(document).on('click', '.btnDelete', function(e){
            e.preventDefault();
            let id = $(this).attr('data-id');
            swal({
                title: "Are you sure?",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    $.ajax({
                        url: '{!! url()->current() !!}' + '/' + id,
                        type: "POST",
                        data: {"_method" : "DELETE"}
                    }).done(function() {
                        swal("Your data has been delete", {
                            icon: "success"
                        });
                        $('.table').DataTable().ajax.reload();
                    });
                } else {
                    swal("Your data is safe!");
                }
            });
        })

    });

    </script>

        
    @endpush