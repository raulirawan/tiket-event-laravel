@extends('layouts.dashboard')

@section('title','Dashboard Transaction')
    

@section('content')

<main>
    <div class="container-fluid">
        <h1 class="mt-4">Halaman Change Password</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item">
                <a href="{{ route('dashboard') }}">Dashboard</a>
            </li>
            <li class="breadcrumb-item active">
               Change Password
            </li>
        </ol>
    
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table mr-1"></i>
                Form Change Password
            </div>
            <div class="card-body pb-5">
               <div class="row">
                   <div class="col-md-12">
                        @if($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif
                       <form action="{{ route('change.password.udpate') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Password Lama</label>
                                        <input type="password" name="oldPassword" class="form-control" placeholder="Masukan Password Lama">
                                     </div>
                                
                            </div>
                        </div>
                        <div class="row">
                               <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Password Baru</label>
                                        <input type="password" name="password" class="form-control" placeholder="Masukan Password Baru">
                                     </div>
                                
                               </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Konfirmasi Password Baru</label>
                                    <input type="password" name="password_confirmation" class="form-control" placeholder="Masukan Konfirmasi Password Baru">

                                </div>
                            </div>
                        </div>                       
                            <button type="submit" class="btn btn-success btn-block">Ganti Password</button>
                       </form>
                   </div>
               </div>
            </div>
        </div> 
    </div>
</main>
    
@endsection


@push('down-script')

<script type="text/javascript">
    $('#provinces').on('change', function (e) {
        console.log(e);
        var province_id = e.target.value;
        $.get('/regencies?province_id=' + province_id, function (data) {
            console.log(data);
            $('#regencies').empty();
            $('#regencies').append('<option value="" disable="true" selected="true">=== Pilih Kota ===</option>');

            $('#districts').empty();
            $('#districts').append('<option value="" disable="true" selected="true">=== Pilih Kecamatan ===</option>');

            $('#villages').empty();
            $('#villages').append('<option value="" disable="true" selected="true">=== Pilih Kelurahan</option>');

            $.each(data, function (index, regenciesObj) {
                $('#regencies').append('<option value="' + regenciesObj.id + '">' + regenciesObj.name + '</option>');
            })
        });
    });

    $('#regencies').on('change', function (e) {
        console.log(e);
        var regencies_id = e.target.value;
        $.get('/districts?regencies_id=' + regencies_id, function (data) {
            console.log(data);
            $('#districts').empty();
            $('#districts').append('<option value="" disable="true" selected="true">=== Pilih Kecamatan ===</option>');

            $.each(data, function (index, districtsObj) {
                $('#districts').append('<option value="' + districtsObj.id + '">' + districtsObj.name + '</option>');
            })
        });
    });

    $('#districts').on('change', function (e) {
        console.log(e);
        var districts_id = e.target.value;
        $.get('/village?districts_id=' + districts_id, function (data) {
            console.log(data);
            $('#villages').empty();
            $('#villages').append('<option value="" disable="true" selected="true">=== Pilih Kelurahan</option>');

            $.each(data, function (index, villagesObj) {
                $('#villages').append('<option value="' + villagesObj.id + '">' + villagesObj.name + '</option>');
                console.log("|" + villagesObj.id + "|" + villagesObj.district_id + "|" + villagesObj.name);
            })
        });
    });

    
    

</script>
    
@endpush

