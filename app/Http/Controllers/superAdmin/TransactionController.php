<?php

namespace App\Http\Controllers\superAdmin;

use App\User;
use App\Events;
use App\Transaction;
use App\TransactionDetail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\TransactionRequest;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         if(request()->ajax())
        {
            $query  = Transaction::with(['user'])->latest();

            return DataTables::of($query)
                ->addColumn('action', function($item)   {
                    return '
                       <div class="text-center">
                        <a href=" '. route('transaction.edit', $item->id) .' " class="btn-sm btn-primary"><i class="fas fa-pencil-alt"></i></a>

                        <form action="' . route('transaction.destroy', $item->id) .'" method="POST" style="display:inline;">
                        '. method_field('delete') . csrf_field() .' 
                        <button type="submit" class="btn-sm btn-danger btnDelete" data-id="'. $item->id .'"><i class="fas fa-trash-alt"></i></button>

                        </form> 
                        </div>
                    
                    ';
                    

                })
                ->rawColumns(['action'])
                ->make();
                
        }

        return view('pages.superadmin.transaction.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        // $users = User::where('roles','USER')->get();
        // $events = Events::all();
        // return view('pages.superadmin.transaction.create', compact('users','events'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TransactionRequest $request)
    {
    //     $transactionDetail = TransactionDetail::with(['event','transaction'])->get();
        
    //     $transactions = Transaction::all();

    //     $valueCode = count($transactions)+1;

    //     if($valueCode < 10){
    //         $codeTransaction = 'E-'.'000'. $valueCode;
    //     } 

    //     else if ($valueCode >= 10 && $valueCode <= 99) {
    //         $codeTransaction = 'E-'.'00' . $valueCode;
    //     }

    //     else if ($valueCode >= 100 && $valueCode <= 999) {
    //         $codeTransaction = 'E-'.'0' . $valueCode;
    //     }

    //    $transaction = Transaction::create([
    //         'user_id'               => $request->user_id,
    //         'total_price'           => $transactionDetail->event->price,
    //         'code_transaction'      => $codeTransaction,
    //         'status'                => $request->status,
    //    ]);

    //    TransactionDetail::create([
    //        'transaction_id'     => $transaction->id,
    //        'event_id'           => $request->event_id,
    //        'code_transaction'   => 'ETD-' . mt_rand(00000,99999),
    //        'price'              => $transactionDetail->event->price,
    //        'status'             => $request->status,
    //    ]);




    //    $result = Transaction::create($data);

    //    if($transaction){
    //        Alert::success('Berhasil', 'Data Berhasil di Simpan !');
    //    }
    //    else{
    //        Alert::error('Gagal', 'Data Gagal di Simpan !');
    //    }

    //    return redirect()->route('transaction.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // $users = User::where('roles','USER')->get();
        // $item = Transaction::with(['user'])->findOrFail($id);

        // return view('pages.superadmin.transaction.edit', compact('item','users'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

    //     $data = [
    //         'user_id'               => $request->user_id,
    //         'total_price'           => $request->total_price,
    //         'status'                => $request->status,
    //    ];

    //     $item = Transaction::findOrFail($id);

    //     $result = $item->update($data);

    //     if($result){
    //        Alert::success('Berhasil', 'Data Berhasil di Update !');
    //     }
    //     else{
    //         Alert::error('Gagal', 'Data Gagal di Update !');
    //     }

    //     return redirect()->route('transaction.index');    


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Transaction::findOrFail($id);

        $item->delete();

        return redirect()->route('transaction.index');
    }
}
