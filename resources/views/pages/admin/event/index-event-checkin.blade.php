@extends('layouts.admin-event')

@section('title','Dashboard Admin')
    

@section('content')

<main>
    <div class="container-fluid">
        <h1 class="mt-4">Halaman Check In Event {{ $event->name }}</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Dashboard</li>
        </ol>
        
        <div class="card mb-4">
            
            <div class="card-header">
                 @if($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                <form method="POST" action="{{ route('event.admin.index.event.update.check.in', $event->slug) }}" class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
                    @csrf
                    @method('PUT')
                    <div class="input-group">
                        <input class="form-control" type="text" name="code" placeholder="Input Kode Unik"/>
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="submit"><i class="fas fa-search"></i></button>
                        </div>
                    </div>
                </form>
            </div>
           
            <div class="card-body">
                
                <div class="table-responsive">
                    <table class="table table-hover scroll-horinzontal-vertical w-100" id="crudTable">
                        <thead>
                            <tr>
                                <th style="font-size: 14px">Nama Pengunjung</th>
                                <th style="font-size: 14px">Nomor Telepon</th>
                                <th style="font-size: 14px">Profesi</th>
                                <th style="font-size: 14px">Code</th>
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
                { data: 'user.name' , name:  'user.name' },
                { data: 'user.mobile_number' , name:  'user.mobile_number' },
                { data: 'user.position' , name: 'user.position' },
                { data: 'code' , name: 'code' },
                { data: 'status_checkin' , name: 'status_checkin' },
              
            ]
        });

    
    });

    </script>

    
@endpush

