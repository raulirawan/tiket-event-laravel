@extends('layouts.admin')

@section('title','Dashboard SuperAdmin')
    

@section('content')

<main>
    <div class="container-fluid">
        <h1 class="mt-4">Halaman Detail Detail</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item">Detail</li>
            <li class="breadcrumb-item active">Detail</li>
        </ol>
    
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table mr-1"></i>
                Detail Data 
            </div>
            <div class="card-body">
               <div class="table-responsive">
                   <table class="table table-bordered">
                      <tbody>
                          <tr>
                              <th>Nama Event</th>
                              <td>{{ $item->name }}</td>
                          </tr>
                           <tr>
                              <th>Pemilik Event</th>
                              <td>{{ $item->user->name }}</td>
                          </tr>
                           <tr>
                              <th>Kategori Event</th>
                              <td>{{ $item->category->name }}</td>
                          </tr>
                           <tr>
                              <th>Harga Event</th>
                              <td>{{ $item->price }}</td>
                          </tr>
                           <tr>
                              <th>Deskripsi Event</th>
                              <td style="word-wrap:break-all; width:800px; ">{!! $item->description !!}</td>
                          </tr>
                           <tr>
                              <th>Tanggal dan Waktu Event</th>
                              <td>{{ $item->date_time->format('d M Y H:i') }}</td>
                          </tr>
                          <tr>
                              <th>Lokasi Event</th>
                              <td class="text-center">{!! $item->location !!}</td>
                          </tr>
                      </tbody>
                   </table>
               </div>
            </div>
        </div>
    </div>
</main>
    
@endsection
