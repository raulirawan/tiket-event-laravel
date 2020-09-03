@extends('layouts.admin')

@section('title','Dashboard Admin')
    

@section('content')

<main>
    <div class="container-fluid">
        <h1 class="mt-4">Hi, Dashboard</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item">User</li>
            <li class="breadcrumb-item active">Create</li>
        </ol>
    
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table mr-1"></i>
                Form Tambah Data User
            </div>
            <div class="card-body">
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
                       <form action="{{ route('user.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                           <div class="row">
                               <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Nama Lengkap</label>
                                        <input type="text" name="name" class="form-control" value="{{ old('name') }}" placeholder="Masukan Lengkap">
                                     </div>
                                
                               </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input type="email" name="email" class="form-control" value="{{ old('email') }}" placeholder="Masukan Email">
                                     </div>
                               </div>
                           </div>
                           <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Password</label>
                                        <input type="password" name="password" class="form-control" placeholder="Masukan Password">
                                </div>
                            
                               </div>
                               <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Roles</label>
                                        <select name="roles" class="form-control">
                                            <option value="USER">USER</option>
                                            <option value="ADMIN">ADMIN</option>
                                        </select>
                                    </div>
                               </div>
                           </div>

                            <div class="form-group">
                                <label>Address</label>
                                <textarea name="address" cols="1" rows="5" class="form-control" value="{{ old('address') }}" placeholder="Masukan Alamat"></textarea>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Provinsi</label>
                                        <select class="form-control" name="province_id" id="provinces">
                                            <option value="" disable="true" selected="true">=== Pilih Provinsi ===</option>
                                            @foreach ($provinces as $provincy)
                                                <option value="{{$provincy->id}}">{{ $provincy->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Kota</label>
                                        <select class="form-control" name="regency_id" id="regencies">
                                            <option value="" disable="true" selected="true">=== Pilih Kota ===</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                             <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Kecamatan</label>
                                        <select class="form-control" name="district_id" id="districts">
                                            <option value="" disable="true" selected="true">=== Pilih Kecamatan ===</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Kelurahan</label>
                                        <select class="form-control" name="village_id" id="villages">
                                            <option value="" disable="true" selected="true">=== Pilih Kelurahan</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                     <div class="form-group">
                                        <label>Kode Pos</label>
                                        <input type="number" name="zip_code" class="form-control" value="{{ old('zip_code') }}" placeholder="Masukan Kode Pos">
                                     </div>
                                </div>
                                <div class="col-md-6">
                                     <div class="form-group">
                                        <label>Nomor HP</label>
                                        <input type="number" name="mobile_number" class="form-control" value="{{ old('mobile_number') }}" placeholder="Masukan Nomor Handphone">
                                     </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <label>Profesi</label>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="position" value="Wirausaha">
                                                    <label class="form-check-label">
                                                        Wirausaha
                                                    </label>    
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="position" value="Karyawan Negeri">
                                                    <label class="form-check-label">
                                                        Karyawan Negeri
                                                    </label>    
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="position" value="Karyawan Swasta">
                                                    <label class="form-check-label">
                                                        Karyawan Swasta
                                                    </label>    
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="position" value="Buruh">
                                                    <label class="form-check-label">
                                                        Buruh
                                                    </label>    
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="position" value="Pelajar">
                                                    <label class="form-check-label">
                                                       Pelajar / Mahasiswa
                                                    </label>    
                                                </div>
                                                
                                              
                                              
                                               
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                           
                            <button type="submit" class="btn btn-success btn-block">Simpan</button>
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
            $('#regencies').append('<option value="0" disable="true" selected="true">=== Pilih Kota ===</option>');

            $('#districts').empty();
            $('#districts').append('<option value="0" disable="true" selected="true">=== Pilih Kecamatan ===</option>');

            $('#villages').empty();
            $('#villages').append('<option value="0" disable="true" selected="true">=== Pilih Kelurahan</option>');

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
            $('#districts').append('<option value="0" disable="true" selected="true">=== Pilih Kecamatan ===</option>');

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
            $('#villages').append('<option value="0" disable="true" selected="true">=== Pilih Kelurahan</option>');

            $.each(data, function (index, villagesObj) {
                $('#villages').append('<option value="' + villagesObj.id + '">' + villagesObj.name + '</option>');
                console.log("|" + villagesObj.id + "|" + villagesObj.district_id + "|" + villagesObj.name);
            })
        });
    });

    

</script>
    
@endpush
