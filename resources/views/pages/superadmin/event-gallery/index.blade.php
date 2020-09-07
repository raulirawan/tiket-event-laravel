@extends('layouts.admin')

@section('title','Dashboard SuperAdmin')
    

@section('content')

<main>
    <div class="container-fluid">
        <h1 class="mt-4">Halaman Gallery</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Dashboard</li>
        </ol>
    
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table mr-1"></i>
                Table Gallery
            </div>
            <div class="card-body">
                <a href="{{ route('event-gallery.create') }}" class="btn btn-info mb-3">
                (+) Tambah Gallery Baru
                </a>
                <div class="table-responsive">
                    <table class="table table-hover scroll-horinzontal-vertical w-100" id="crudTable">
                        <thead>
                            <tr>
                                <th>Nama Event</th>
                                <th>Foto Event</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>

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
            { 
                data: 'photos' , 
                name:  'photos' ,
                orderable: false,
                searcable: false,
            },

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

