@extends('layouts.admin-event')

@section('title','Dashboard Admin')
    

@section('content')

<main>
    <div class="container-fluid">
        <h1 class="mt-4">Halaman Tiket Event {{ $event->name }}</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Dashboard</li>
        </ol>
    
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table mr-1"></i>
                Table Pengunjung Event {{ $event->name }}
            </div>
            <div class="card-body">
                <a href="{{ route('event.admin.create.user', $event->slug ) }}" class="btn btn-info mb-3">
                (+) Tambah Tiket Baru
                </a>
                <a href="{{ route('export-excel', $event->id) }}" class="btn btn-success text-right mb-3">
                    Export Excel
                    </a>
                <div class="table-responsive">
                    <table class="table table-hover scroll-horinzontal-vertical w-100" id="crudTable">
                        <thead>
                            <tr>
                                <th style="font-size: 14px">Nama Pengunjung</th>
                                <th style="font-size: 14px">Nomor Telepon</th>
                                <th style="font-size: 14px">Profesi</th>
                                <th style="font-size: 14px">Code</th>
                                <th style="font-size: 14px">Action</th>
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
                { data: 'user.name' , name:  'user.name' },
                { data: 'user.mobile_number' , name:  'user.mobile_number' },
                { data: 'user.position' , name: 'user.position' },
                { data: 'code' , name: 'code' },
               

                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searcable: false,
                    width: '15%',
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
                        url: 'http://tiket-event-laravel.test/admin/event/index' + '/' + id,
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

