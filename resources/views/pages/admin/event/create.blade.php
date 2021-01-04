@extends('layouts.admin-event')

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
                       <form action="{{ route('event.admin.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                            <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                           <div class="row">
                               <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Nama Event</label>
                                        <input type="text" name="name" class="form-control" value="{{ old('name') }}" placeholder="Masukan Nama Event">
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
                                        <span class="text-muted">isikan 0 jika event anda FREE</span>
                                    </div>
                                
                               </div>
                               <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Deskripsi Event</label>
                                        <textarea name="description" id="editor">{{ old('description') }}</textarea>
                                    </div>
                               </div>
                               <div class="col-md-6">
                                   <div class="form-group">
                                       <label>Tanggal dan Waktu</label>
                                    <input type="text" id="date_time" name="date_time" class="form-control" value="{{ old('date_time') }}" readonly autocomplete="off">
                                   </div>
                               </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Tipe Event</label>
                                        <select name="event_type" class="form-control">
                                            <option value="">-- Pilih Tipe Event --</option>
                                            <option value="FREE">FREE</option>
                                            <option value="PREMIUM">PREMIUM</option>
                                        </select>
                                    </div>
                               </div>
                               <div class="col-md-6">
                                   <div class="form-group">
                                       <label>Lokasi Event</label>
                                       <select name="location" class="form-control">
                                            <option value="">-- Pilih Lokasi Event --</option>
                                            <option value="Jakarta Barat">JAKARTA BARAT</option>
                                            <option value="Jakarta Timur">JAKARTA TIMUR</option>
                                            <option value="Jakarta Utara">JAKARTA UTARA</option>
                                            <option value="Jakarta Selatan">JAKARTA SELATAN</option>
                                            <option value="Kepulauan Seribu">KEPULAUAN SERIBU</option>
                                            
                                        </select>
                                       
                                </div>
                               </div>
                               <div class="col-md-6">
                                   <div class="form-group">
                                       <label>Lokasi</label>
                                       <input type="text" name="location_details" class="form-control" value="{{ old('location_details') }}">
                                       <span class="text-muted">Contoh : Link iframe Google Maps</span>
                                   </div>
                               </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Foto Event ( Thumbnails )</label>
                                        <input type="file" name="photos[]" class="form-control" multiple="true">
                                        <div class="text-muted">Kamu Bisa Memilih Lebih dari Satu File</div>
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
