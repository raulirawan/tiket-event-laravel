@extends('layouts.admin-event')

@section('title','Dashboard Admin')
    

@section('content')

<main>
    <div class="container-fluid">
        <h1 class="mt-4">Halaman Event</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item">
                <a href="{{ route('dashboard.admin') }}">Dashboard</a>
            </li>
            <li class="breadcrumb-item active">
               Event
            </li>
        </ol>
    
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table mr-1"></i>
                Table Event
            </div>
            <div class="card-body">
                <a href="{{ route('event.admin.create') }}" class="btn btn-info mb-3">
                (+) Tambah Event Baru
                </a>
                <div class="table-responsive">
                    <table class="table table-hover scroll-horinzontal-vertical w-100" id="crudTable">
                        <thead>
                            <tr>
                                <th style="font-size: 14px">Nama Event</th>
                                <th style="font-size: 14px">Pemilik Event</th>
                                <th style="font-size: 14px">Kategori Event</th>
                                <th style="font-size: 14px">Harga Event</th>
                                <th style="font-size: 14px">Tanggal Event</th>
                                <th style="font-size: 14px">Tipe Event</th>
                                <th style="font-size: 14px">Stock</th>
                                <th style="font-size: 14px">Action</th>
                                <th style="font-size: 14px">Check In Out</th>
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
                { data: 'name' , name:  'name' },
                { data: 'user.name' , name:  'user.name' },
                { data: 'category.name' , name:  'category.name' },
                { data: 'price' , name:  'price' },
                { data: 'date_time' , name: 'date_time' },
                { data: 'event_type' , name: 'event_type' },
                { data: 'event_stock' , name: 'event_stock' },
               

                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searcable: false,
                    width: '15%',
                },

                {
                    data: 'check',
                    name: 'check',
                    orderable: false,
                    searcable: false,
                    width: '10%',
                }
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

