@extends('layouts.admin')

@section('title','Edit Data Transaction')
    

@section('content')

<main>
    <div class="container-fluid">
        <h1 class="mt-4">Halaman Edit Transaction</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item">Transaction</li>
            <li class="breadcrumb-item active">Edit</li>
        </ol>
    
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table mr-1"></i>
                Form Edit Data Transaction
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
                       <form action="{{ route('transaction.update', $item->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method("PUT")
                           <div class="row pb-3">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Total Harga</label>
                                        <input type="number" name="total_price" class="form-control" value="{{ $item->total_price }}" placeholder="Masukan Total Harga">
                                     </div>
                               </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Status Transaksi</label>
                                         <select name="status" class="form-control">
                                            <option value="{{ $item->status }}">{{ $item->status }}</option>
                                            <option value="PENDING">PENDING</option>   
                                            <option value="SUCCESS">SUCCESS</option>   
                                          
                                        </select>
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
