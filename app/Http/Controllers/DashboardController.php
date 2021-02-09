<?php

namespace App\Http\Controllers;

use App\EventUser;
use App\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\VarDumper\Cloner\Data;
use Yajra\DataTables\Facades\DataTables;

class DashboardController extends Controller
{
    public function index()
    {
        if(request()->ajax())
        {
            $query  = EventUser::with(['user','event'])
                            ->where('user_id', Auth::user()->id)->get();

            return DataTables::of($query)
                ->addColumn('action', function($item)   {
                    return '
                       <div class="text-center">
                        <a href=" '. route('event.show', $item->id) .' " class="btn-sm btn-info"><i class="fas fa-eye"></i></a>
                        
                        </div>
                    
                    ';
                    

                })
                ->editColumn('event.date_time', function($item) {
                    return ($item->event->date_time->format('d M Y H:i'));
                })
                ->editColumn('status_checkin', function($item)   {
                    if($item->status_checkin == 1){
                         return '<span class="badge badge-success">'. "Check In" .'</span>';
                    }
                    else {
                         return '<span class="badge badge-danger">'. "Check Out" .'</span>';
                    }
                    
                 })
                ->rawColumns(['action','status_checkin'])
                ->make();

        }

        return view('pages.dashboard');
    }

 
    
    public function transaction()
    {
        if(request()->ajax())
        {
            $query  = Transaction::with(['user','event'])
                            ->where('user_id', Auth::user()->id)->get();

            return DataTables::of($query)
                ->addColumn('action', function($item)   {
                    return '
                       <div class="text-center">
                        <a href=" '. route('event.show', $item->id) .' " class="btn-sm btn-info"><i class="fas fa-eye"></i></a>
                        
                        </div>
                    
                    ';
                    

                })
                
                ->editColumn('created_at', function($item) {
                    return ($item->created_at->format('d M Y H:i'));
                })
                
                ->editColumn('total_price', function($item) {
                    return 'Rp '. number_format($item->total_price) .',00';
                })
               ->editColumn('status', function($item)   {
                   if($item->status == 'PENDING'){
                        return '<span class="badge badge-warning">'. "PENDING" .'</span>';
                   }
                   else if ($item->status == 'FAILED') {
                        return '<span class="badge badge-danger">'. "FAILED" .'</span>';
                   }

                    else if ($item->status == 'SUCCESS') {
                        return '<span class="badge badge-success">'. "SUCCESS" .'</span>';
                   }

                })  
                ->rawColumns(['action','status'])
                ->make();

        }

        return view('pages.transaction');
    }
}
