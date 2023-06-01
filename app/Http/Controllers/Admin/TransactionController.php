<?php

namespace App\Http\Controllers\Admin;

use App\Transaction;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\Facades\DataTables;

class TransactionController extends Controller
{
    public function index()
    {
        if (request()->ajax()) {
            $query  = Transaction::query()->with(['user', 'event'])
                ->whereHas('event', function ($event) {
                    $event->where('user_id', Auth::user()->id);
                })->latest();

            return DataTables::of($query)
                ->addColumn('action', function ($item) {
                    return '
                       <div class="text-center">
                        <a href=" ' . route('transaction.admin.edit', $item->id) . ' " class="btn-sm btn-primary"><i class="fas fa-pencil-alt"></i></a>

                        <form action="' . route('transaction.admin.destroy', $item->id) . '" method="POST" style="display:inline;">
                        ' . method_field('delete') . csrf_field() . '
                        <button type="submit" class="btn-sm btn-danger btnDelete" data-id="' . $item->id . '"><i class="fas fa-trash-alt"></i></button>

                        </form>

                        </div>



                    ';
                })

                ->editColumn('total_price', function ($item) {
                    return 'Rp ' . number_format($item->total_price) . ',00';
                })
                ->editColumn('status', function ($item) {
                    if ($item->status == 'PENDING') {
                        return '<span class="badge badge-warning">' . "PENDING" . '</span>';
                    } else if ($item->status == 'FAILED') {
                        return '<span class="badge badge-danger">' . "FAILED" . '</span>';
                    } else if ($item->status == 'SUCCESS') {
                        return '<span class="badge badge-success">' . "SUCCESS" . '</span>';
                    }
                })
                ->rawColumns(['action', 'status'])
                ->make();
        }
        return view('pages.admin.transaction.index');
    }

    public function edit($id)
    {
        $item = Transaction::with(['user', 'event'])->findOrFail($id);

        return view('pages.admin.transaction.edit', compact('item'));
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();

        $transaction = Transaction::findOrFail($id);

        $result = $transaction->update($data);

        if ($result != null) {
            Alert::success('Berhasil', 'Data Berhasil Pengunjung Berhasil Di Tambahkan !');
        } else {
            Alert::error('Gagal', 'Data Gagal di Tambahkan !');
        }

        return redirect()->route('transaction.admin.index');
    }

    public function destroy($id)
    {
        $item = Transaction::findOrFail($id);

        $item->event_user()->delete();

        $item->delete();

        return redirect()->route('transaction.admin.index');
    }
}
