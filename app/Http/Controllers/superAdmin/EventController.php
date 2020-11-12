<?php

namespace App\Http\Controllers\superAdmin;

use App\Category;
use App\User;
use App\Events;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Requests\EventRequest;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\Facades\DataTables;

class EventController extends Controller
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
            $query  = Events::with(['user','category']);

            return DataTables::of($query)
                ->addColumn('action', function($item)   {
                    return '
                       <div class="text-center">
                        <a href=" '. route('event.show', $item->id) .' " class="btn-sm btn-info"><i class="fas fa-eye"></i></a>
                        <a href=" '. route('event.edit', $item->id) .' " class="btn-sm btn-primary"><i class="fas fa-pencil-alt"></i></a>

                        <form action="' . route('event.destroy', $item->id) .'" method="POST" style="display:inline;">
                        '. method_field('delete') . csrf_field() .' 
                        <button type="submit" class="btn-sm btn-danger btnDelete" data-id="'. $item->id .'"><i class="fas fa-trash-alt"></i></button>

                        </form> 
                        </div>
                    
                    ';
                    

                })
                ->editColumn('date_time', function($item) {
                    return ($item->date_time->format('d M Y H:i'));
                })
                ->editColumn('price', function($item) {
                    return 'Rp'. number_format($item->price) .',00';
                })

                ->rawColumns(['action'])
                ->make();

              
                
        }

        return view('pages.superadmin.event.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        $users      = User::where('roles','ADMIN')
                                ->orWhere('roles','SUPERADMIN')
                                ->get();
        $categories = Category::all();

        //untuk menampilkan dynamic option
        return view('pages.superadmin.event.create',compact('users','categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EventRequest $request)
    {
       $data = $request->all();

       $data['slug'] = Str::slug($request->name);

       if($request->event_type == "FREE"){
           $data['price'] = 0;

           $result = Events::create($data);

            if($result){
                Alert::success('Berhasil', 'Data Berhasil di Simpan !');    
            }
            else{
                Alert::error('Gagal', 'Data Gagal di Simpan!');  
            }
            return redirect()->route('event.index');

        } else if ($request->event_type == "PREMIUM" && $request->price == 0) {
            Alert::error('Gagal', 'Silahkan isi Harga Event');
            return back();

        } else {
            $result = Events::create($data);

            if($result){
                Alert::success('Berhasil', 'Data Berhasil di Simpan !');    
            }
            else{
                Alert::error('Gagal', 'Data Gagal di Simpan !');  
            }
            return redirect()->route('event.index');    
        }

    //    if($request->event_type == "FREE"){
    //        $data['price'] = 0;
    //    } 

       

    //    $result = Events::create($data);

       
    //    if($result){
    //        Alert::success('Berhasil', 'Data Berhasil di Simpan !');
    //    }
    //    else{
    //        Alert::error('Gagal', 'Data Gagal di Simpan !');
    //    }

    //    return redirect()->route('event.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $item = Events::with(['user','category'])->findOrFail($id);

        return view('pages.superadmin.event.show', compact('item'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $users      = User::where('roles','ADMIN')
                                ->orWhere('roles','SUPERADMIN')
                                ->get();
        $categories = Category::all();
    
        $item = Events::findOrFail($id);

        return view('pages.superadmin.event.edit', compact('item','users','categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EventRequest $request, $id)
    {
        
        $data = $request->all();

        $item = Events::findOrFail($id);

        if($request->event_type == "FREE"){
           $data['price'] = 0;

           $result = $item->update($data);

            if($result){
                Alert::success('Berhasil', 'Data Berhasil di Update !');    
            }
            else{
                Alert::error('Gagal', 'Data Gagal di Update');  
            }
            return redirect()->route('event.index');

        } else if ($request->event_type == "PREMIUM" && $request->price == 0) {
            Alert::error('Gagal', 'Silahkan isi Harga Event');
            return back();

        } else {
            $result = $item->update($data);

            if($result){
                Alert::success('Berhasil', 'Data Berhasil di Update !');    
            }
            else{
                Alert::error('Gagal', 'Data Gagal di Update !');  
            }
            return redirect()->route('event.index');    
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Events::findOrFail($id);

        $item->delete();

        return redirect()->route('event.index');
    }
}
