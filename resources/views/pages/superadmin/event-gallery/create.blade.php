@extends('layouts.admin')

@section('title','Create Data Event Gallery')
    

@section('content')

<main>
    <div class="container-fluid">
        <h1 class="mt-4">Halaman Create Event Gallery</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item">Event Gallery</li>
            <li class="breadcrumb-item active">Create</li>
        </ol>
    
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table mr-1"></i>
                Form Tambah Data Event Gallery
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
                       <form action="{{ route('event-gallery.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                           <div class="row pb-3">
                               <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Nama Event</label>
                                        <select name="event_id" class="form-control">
                                            <option value="" selected>-- Pilih Nama Event --</option>
                                            @foreach ($events as $event) 
                                                <option value="{{ $event->id }}">{{ $event->name }}</option>   
                                            @endforeach
                                        </select>
                                     </div>
                                
                               </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Foto Event ( Thumbnails )</label>
                                        <input type="file" name="photos" class="form-control">
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

@endpush
