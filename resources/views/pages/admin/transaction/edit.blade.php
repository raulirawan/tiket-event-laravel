@extends('layouts.admin-event')

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
                                    <li>{{ $error }}</li>];''
                                @endforeach
                            </ul>
                        </div>
                        @endif
                       <form action="{{ route('transaction.admin.update', $item->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method("PUT")
                        
                           <div class="row">
                             
                               <div class="col-md-12">
                                   <div class="form-group">
                                       <label>Status Transaksi</label>
                                        <select name="status" class="form-control">
                                            <option value="{{ $item->status }}">-- Tidak Ganti Status Transaction --</option>
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

@push('down-script')

<script src="https://cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>

<script>
     function thisFileUpload() {
      document.getElementById("file").click();
    }
</script>
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
