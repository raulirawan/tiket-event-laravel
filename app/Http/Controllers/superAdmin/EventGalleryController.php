<?php

namespace App\Http\Controllers\superAdmin;
use App\Events;
use App\EventGallery;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\EventGalleryRequest;

class EventGalleryController extends Controller
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
            $query  = EventGallery::with(['event'])    
                            ->get();

            return DataTables::of($query)
                ->addColumn('action', function($item)   {
                    return '
                       <div class="text-center">

                        <form action="' . route('event-gallery.destroy', $item->id) .'" method="POST" style="display:inline;">
                        '. method_field('delete') . csrf_field() .' 
                        <button type="submit" class="btn-sm btn-danger btnDelete" data-id="'. $item->id .'"><i class="fas fa-trash-alt"></i></button>

                        </form> 
                        </div>
                    
                    ';
                    

                })
                 ->editColumn('photos', function($item){
                    return $item->photos ? '<img src="'. Storage::url($item->photos) .'" style="max-height:70px"/>' : '';
                })
                ->rawColumns(['action','photos'])
                ->make();

              
                
        }


        return view('pages.superadmin.event-gallery.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        $events = Events::all();
        //untuk menampilkan dynamic option
        return view('pages.superadmin.event-gallery.create',compact('events'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EventGalleryRequest $request)
    {
       $data = $request->all();

       $data['photos'] = $request->file('photos')->store('assets/event','public');
    
       $result = EventGallery::create($data);

       if($result){
           Alert::success('Berhasil', 'Data Berhasil di Simpan !');
       }
       else{
           Alert::error('Gagal', 'Data Gagal di Simpan !');
       }

       return redirect()->route('event-gallery.index');
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
    
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EventGalleryRequest $request, $id)
    {
        
      


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = EventGallery::findOrFail($id);

        $item->delete();

        return redirect()->route('event-gallery.index');
    }
}
