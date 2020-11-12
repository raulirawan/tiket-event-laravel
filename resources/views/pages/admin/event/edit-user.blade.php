@extends('layouts.admin-event')

@section('title','Edit Data Event')
    

@section('content')

<main>
    <div class="container-fluid">
        <h1 class="mt-4">Halaman Edit User</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item">Event</li>
            <li class="breadcrumb-item active">Edit</li>
        </ol>
    
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table mr-1"></i>
                Form Edit Data User
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
                       <form action="{{ route('event.admin.user.update', $EventUser->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method("PUT")
                           <div class="row">
                                <input type="hidden" name="event_id" value="{{ $EventUser->event->id }}">

                               <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Nama Lengkap</label>
                                        <input type="text" name="name" class="form-control" value="{{ $EventUser->user->name }}" placeholder="Masukan Nama Lengkap">
                                     </div>
                                
                               </div>
                           </div>
                            <div class="form-group">
                                <label>Address</label>
                                <textarea name="address" cols="1" rows="5" class="form-control" placeholder="Masukan Alamat">{{ $EventUser->user->address }}</textarea>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Provinsi</label>
                                        <select class="form-control" name="province_id" id="provinces">
                                           <option value="{{ $EventUser->user->province_id }}" disable="true" selected="true">=== Tidak Ganti Provinsi ===</option>
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
                                            <option value="{{ $EventUser->user->regency_id }}" disable="true" selected="true">=== Tidak Ganti Kota ===</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                             <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Kecamatan</label>
                                        <select class="form-control" name="district_id" id="districts">
                                            <option value="{{ $EventUser->user->district_id }}" disable="true" selected="true">=== Tidak Ganti Kecamatan ===</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Kelurahan</label>
                                        <select class="form-control" name="village_id" id="villages">
                                            <option value="{{ $EventUser->user->village_id }}" disable="true" selected="true">=== Tidak Ganti Kelurahan ===</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                     <div class="form-group">
                                        <label>Kode Pos</label>
                                        <input type="number" name="zip_code" class="form-control" value="{{ $EventUser->user->zip_code }}" placeholder="Masukan Kode Pos">
                                     </div>
                                </div>
                                <div class="col-md-6">
                                     <div class="form-group">
                                        <label>Nomor HP</label>
                                        <input type="number" name="mobile_number" class="form-control" value="{{ $EventUser->user->mobile_number }}" placeholder="Masukan Nomor Handphone">
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
                                                    <input class="form-check-input" type="radio" name="position" value="Wirausaha" {{ $EventUser->User->position == 'Wirausaha' ? 'checked' : ''}}>
                                                    <label class="form-check-label">
                                                        Wirausaha
                                                    </label>    
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="position" value="Karyawan Negeri" {{ $EventUser->User->position == 'Karyawan Negeri' ? 'checked' : ''}}>
                                                    <label class="form-check-label">
                                                        Karyawan Negeri
                                                    </label>    
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="position" value="Karyawan Swasta" {{ $EventUser->User->position == 'Karyawan Swasta' ? 'checked' : ''}}>
                                                    <label class="form-check-label">
                                                        Karyawan Swasta
                                                    </label>    
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="position" value="Buruh" {{ $EventUser->User->position == 'Buruh' ? 'checked' : ''}}>
                                                    <label class="form-check-label">
                                                        Buruh
                                                    </label>    
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="position" value="Pelajar" {{ $EventUser->User->position == 'Pelajar' ? 'checked' : ''}}>
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
