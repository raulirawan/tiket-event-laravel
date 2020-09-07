@extends('layouts.admin')

@section('title','Create Data Event')
    

@section('content')

<main>
    <div class="container-fluid">
        <h1 class="mt-4">Halaman Create Event</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item">Event</li>
            <li class="breadcrumb-item active">Create</li>
        </ol>
    
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table mr-1"></i>
                Form Tambah Data Event
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
                       <form action="{{ route('event.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                           <div class="row">
                               <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Nama Event</label>
                                        <input type="text" name="name" class="form-control" value="{{ old('name') }}" placeholder="Masukan Nama Event">
                                     </div>
                                
                               </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Pemilik Event</label>
                                        <select name="user_id" class="form-control">
                                            <option value="" selected>-- Pilih Pemilik Event --</option>
                                            @foreach ($users as $user) 
                                                <option value="{{ $user->id }}">{{ $user->name }}</option>   
                                            @endforeach
                                        </select>
                                     </div>
                               </div>
                           </div>
                           <div class="row">
                                 <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Kategori Event</label>
                                        <select name="category_id" class="form-control">
                                            <option value="" selected>-- Kategori Event --</option>
                                            @foreach ($categories as $category) 
                                                <option value="{{ $category->id }}">{{ $category->name }}</option>   
                                            @endforeach
                                        </select>
                                     </div>
                               </div>
                               <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Harga Event</label>
                                        <input type="number" name="price" class="form-control" value="{{ old('price') }}" placeholder="Masukan Harga Event">
                                     </div>
                                
                               </div>
                               <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Deskripsi Event</label>
                                        <textarea name="description" id="editor">{{ old('desciption') }}</textarea>
                                    </div>
                               </div>
                               <div class="col-md-12">
                                   <div class="form-group">
                                       <label>Tanggal dan Waktu</label>
                                    <input type="text" id="date_time" name="date_time" class="form-control" value="{{ old('date_time') }}" readonly autocomplete="off">
                                   </div>
                               </div>
                               <div class="col-md-12">
                                   <div class="form-group">
                                       <label>Lokasi</label>
                                    <input type="text" name="location" class="form-control" value="{{ old('location') }}">
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

<script src="https://cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
<script>
    CKEDITOR.replace( 'editor' );
</script>

  <script>
        
        $(document).ready(function(){
            jQuery.datetimepicker.setLocale('id')
            $('#date_time').datetimepicker({
                timepicker: true,
                datepicker: true,
                format: 'Y-m-d H:i',
                weeks: true,
                minDate: true,
                minTime: true,
                lazyInit: true,
                fixed: true,
                lang: 'id',
                allowTimes: ['08:00','08:30','09:00','09:30','10:00','10:30','11:30','12:00','12:30',
                '13:00','13:30','14:00'],
                
                i18n: {
                    month: ['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September',
                           'Oktober','November','Desember'],
                    
                    dayOfWeek: ['Minggu','Senin','Selasa','Rabu','Kamis','Jumat','Sabtu'],
                }
            });  

        });

       


    </script>    
@endpush
