@extends('layouts.admin')

@section('title','Create Data Category')
    

@section('content')

<main>
    <div class="container-fluid">
        <h1 class="mt-4">Halaman Create Category</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item">Category</li>
            <li class="breadcrumb-item active">Create</li>
        </ol>
    
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table mr-1"></i>
                Form Tambah Data Category
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
                       <form action="{{ route('category.update', $item->id) }}" method="POST" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        
                           <div class="row">
                               <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Nama Category</label>
                                        <input type="text" name="name" class="form-control" value="{{ $item->name }}" placeholder="Masukan Nama Category">
                                     </div>
                                
                               </div>
                              
                           </div>
                          
                           
                            <button type="submit" class="btn btn-success">Simpan</button>
                       </form>
                   </div>
               </div>
            </div>
        </div>
    </div>
</main>
    
@endsection
