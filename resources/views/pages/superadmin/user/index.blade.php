    @extends('layouts.admin')

    @section('title','Dashboard SuperAdmin')
        

    @section('content')

    <main>
        <div class="container-fluid">
            <h1 class="mt-4">Halaman User</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">Dashboard</li>
            </ol>
        
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table mr-1"></i>
                    Table User
                </div>
                <div class="card-body">
                    <a href="{{ route('user.create') }}" class="btn btn-info mb-3">
                    (+) Tambah User Baru
                    </a>
                    <div class="table-responsive">
                        <table class="table table-hover scroll-horinzontal-vertical w-100" id="crudTable">
                            <thead>
                                <tr>
                                    <th style="font-size: 14px">Nama</th>
                                    <th style="font-size: 14px">Email</th>
                                    <th style="font-size: 14px">Roles</th>
                                    <th style="font-size: 14px">Aksi</th>
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
                    { data: 'email' , name:  'email' },
                    { data: 'roles' , name:  'roles' },
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

