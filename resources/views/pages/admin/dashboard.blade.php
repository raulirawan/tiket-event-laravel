@extends('layouts.admin-event')

@section('title','Dashboard Admin')
    

@section('content')

<main>
    <div class="container-fluid">
        <h1 class="mt-4">Hi, Admin {{ Auth::user()->name }}</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Dashboard</li>
        </ol>
        <div class="row">
            <div class="col-xl-3 col-md-6">
                <div class="card bg-primary text-white mb-4">
                    <div class="card-body">Jumlah Event</div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <div class="small text-white stretched-link" href="#">{{ $events }}</div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card bg-warning text-white mb-4">
                    <div class="card-body">Transaksi Pending</div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <div class="small text-white stretched-link" href="#">{{ $pending }}</div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card bg-success text-white mb-4">
                    <div class="card-body">Transaksi Berhasil</div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <div class="small text-white stretched-link" href="#">{{ $success }}</div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card bg-danger text-white mb-4">
                    <div class="card-body">Transaksi Gagal</div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <div class="small text-white stretched-link" href="#">{{ $failed }}</div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card bg-dark text-white mb-4">
                    <div class="card-body">Total Pendapatan</div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <div class="small text-white stretched-link" href="#">Rp {{ number_format($revenue) }}</div>
                    </div>
                </div>
            </div>
        </div>
    
        {{-- <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table mr-1"></i>
                DataTable Example
            </div>
            <div class="card-body">
                
            </div>
        </div> --}}
    </div>
</main>
    
@endsection