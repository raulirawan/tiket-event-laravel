@extends('layouts.admin')

@section('title','Dashboard SuperAdmin')
    

@section('content')

<main>
    <div class="container-fluid">
        <h1 class="mt-4">Halaman Detail User</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item">User</li>
            <li class="breadcrumb-item active">Detail</li>
        </ol>
    
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table mr-1"></i>
                Detail Data User
            </div>
            <div class="card-body">
               <div class="table-responsive">
                   <table class="table table-bordered">
                      <tbody>
                          <tr>
                              <th>Nama</th>
                              <td>{{ $item->name }}</td>
                          </tr>
                           <tr>
                              <th>Email</th>
                              <td>{{ $item->email }}</td>
                          </tr>
                           <tr style="word-wrap:break-all; width:30000px; max-width:20px;">
                              <th>Alamat</th>
                              <td>{{ $item->address ?? 'TIDAK ADA'}}</td>
                          </tr>
                           <tr>
                              <th>Provinsi</th>
                              <td>{{ $item->province->name ?? 'TIDAK ADA'}} </td>
                          </tr>
                           <tr>
                              <th>Kota</th>
                              <td>{{ $item->regency->name ?? 'TIDAK ADA'}}</td>
                          </tr>
                           <tr>
                              <th>Kecamatan</th>
                              <td>{{ $item->district->name ?? 'TIDAK ADA'}}</td>
                          </tr>
                          <tr>
                              <th>Kelurahan</th>
                              <td>{{ $item->village->name ?? 'TIDAK ADA'}}</td>
                          </tr>
                          <tr>
                              <th>Kode Pos</th>
                              <td>{{ $item->zip_code ?? 'TIDAK ADA'}}</td>
                          </tr>
                          <tr>
                              <th>Profesi</th>
                              <td>{{ $item->position ?? 'TIDAK ADA'}}</td>
                          </tr>
                           <tr>
                              <th>Nomor Hanphone</th>
                              <td>{{ $item->mobile_number ?? 'TIDAK ADA'}}</td>
                          </tr>
                      </tbody>
                   </table>
               </div>
            </div>
        </div>
    </div>
</main>
    
@endsection
