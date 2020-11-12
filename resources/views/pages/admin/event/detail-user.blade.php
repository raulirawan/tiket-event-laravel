@extends('layouts.admin-event')

@section('title','Detail Data User')
    

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
                Detail Data User
            </div>
            <div class="card-body">
               <div class="table-responsive">
                   <table class="table table-bordered">
                      <tbody>
                          <tr>
                              <th>Nama Event</th>
                              <td>{{ $EventUser->event->name }}</td>
                          </tr>
                           <tr>
                              <th>Nama Pengunjung</th>
                              <td>{{ $EventUser->user->name }}</td>
                          </tr>
                           <tr>
                              <th>Alamat Pengunjung</th>
                              <td>{{ $EventUser->user->address }}</td>
                          </tr>
                           <tr>
                              <th>Provinsi</th>
                              <td>{{ $EventUser->user->province->name }}</td>
                          </tr>
                           <tr>
                              <th>Kota</th>
                              <td>{{ $EventUser->user->regency->name }}</td>
                          </tr>
                           <tr>
                              <th>Kecamatan</th>
                              <td>{{ $EventUser->user->district->name }}</td>
                          </tr>
                           <tr>
                              <th>Kelurahan</th>
                              <td>{{ $EventUser->user->village->name }}</td>
                          </tr>
                           <tr>
                              <th>Nomor Hanphone</th>
                              <td>{{ $EventUser->user->mobile_number }}</td>
                          </tr>
                          <tr>
                              <th>Pekerjaan / Profesi</th>
                              <td>{{ $EventUser->user->position }}</td>
                          </tr>
                           <tr>
                              <th>Tiket (QR CODE)</th>
                              <td> <img src="data:image/png;base64, {!! base64_encode(QrCode::format('png')->size(150)->generate($EventUser->code)) !!} "></td>
                          </tr>

                         
                      </tbody>
                   </table>
               </div>
            </div>
        </div>
    </div>
</main>
    
@endsection
