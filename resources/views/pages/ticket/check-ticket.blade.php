@extends('layouts.app')

@section('title','Check Ticket Page')


@section('content')
    
<div class="page-content page-cart">
    <section class="section-breadcrumbs">
      <div class="container">
        <div class="row">
          <div class="col-6">
            <nav>
                <li class="breadcrumb-item active">Check Ticket</li>
              </ol>
            </nav>
           <div class="row mt-3 button-search">
               <div class="col-12">
                <form action="{{ route('check.ticket') }}" class="form-inline mb-3" method="GET">
                    <input name="keyword" class="form-control mr-sm-2" type="text" placeholder="Input Kode Ticket" aria-label="Search">
                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                  </form>
               </div>
              
           </div>
           
          </div>
        </div>
        @if ($ticket != null)
        <table class="table table-responsive">
          <thead>
            <tr>
              <th scope="col">Nama Peserta</th>
              <th scope="col">Nama Event</th>
              <th scope="col">Code Tiket</th>
              <th scope="col">Status Transaksi</th>
              <th scope="col">Tanggal Transaksi</th>
            </tr>
          </thead>
        
          <tbody>
            <td>{{ $ticket->user->name ?? ''}} </td>
            <td>{{ $ticket->event->name ?? ''}}</td>
            <td>{{ $ticket->code ?? ''}}</td>
            <td>{{ $ticket->transaction->status ?? ''}}</td>
            <td>{{ $ticket->transaction->created_at ?? ''}}</td>
          
          </tbody>
        
        </table>
        @else

        @endif
          
      </div>
    </section>
  </div>

  
@endsection