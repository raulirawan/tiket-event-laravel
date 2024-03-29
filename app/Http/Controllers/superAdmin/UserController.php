<?php

namespace App\Http\Controllers\superAdmin;

use App\User;
use App\Models\Regency;
use App\Models\Village;
use App\Models\District;
use App\Models\Province;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
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
            $query  = User::query()->latest();

            return DataTables::of($query)
                ->addColumn('action', function($item)   {
                    return '
                       <div class="text-center">
                        <a href=" '. route('user.show', $item->id) .' " class="btn-sm btn-info"><i class="fas fa-eye"></i></a>
                        <a href=" '. route('user.edit', $item->id) .' " class="btn-sm btn-primary"><i class="fas fa-pencil-alt"></i></a>

                        <form action="' . route('user.destroy', $item->id) .'" method="POST" style="display:inline;">
                        '. method_field('delete') . csrf_field() .' 
                        <button type="submit" class="btn-sm btn-danger btnDelete" data-id="'. $item->id .'"><i class="fas fa-trash-alt"></i></button>

                        </form> 
                        </div>
                    
                    ';
                    

                })
                ->rawColumns(['action'])
                ->make();
                
        }



        return view('pages.superadmin.user.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        //untuk menampilkan dynamic option
        $provinces = Province::where('name', "DKI JAKARTA")->get();
        return view('pages.superadmin.user.create', compact('provinces'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
       $data = $request->all();

       $data['password'] = bcrypt($request->password);

       $result = User::create($data);

       if($result){
           Alert::success('Berhasil', 'Data Berhasil di Simpan !');
       }
       else{
           Alert::error('Gagal', 'Data Gagal di Simpan !');
       }

       return redirect()->route('user.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $item = User::findOrFail($id);

        return view('pages.superadmin.user.show', compact('item'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
        $provinces = Province::where('name', "DKI JAKARTA")->get();
        $item = User::findOrFail($id);

        return view('pages.superadmin.user.edit', compact('item','provinces'));
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
        $this->validate($request, [
            'name' => 'required|string|max:30',
            'email' => 'unique:users,email,'. $id,
            'roles' => 'nullable|string|in:SUPERADMIN,ADMIN,USER',
            'address' => 'required|string',
            'province_id' => 'required',
            'regency_id' => 'required',
            'district_id' => 'required',
            'village_id' => 'required',
            'zip_code' => 'required|integer|min:5',
            'mobile_number' => 'required|max:14',
            'position' => 'required',
        ]);

        $data = $request->all();

        $item = User::findOrFail($id);

        $result = $item->update($data);

        if($result){
           Alert::success('Berhasil', 'Data Berhasil di Update !');
        }
        else{
            Alert::error('Gagal', 'Data Gagal di Update !');
        }

        return redirect()->route('user.index');    


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = User::findOrFail($id);

        $item->delete();

        return redirect()->route('user.index');
    }
}
