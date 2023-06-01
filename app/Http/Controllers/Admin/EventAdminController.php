<?php

namespace App\Http\Controllers\Admin;

use App\User;
use App\Events;
use App\Category;
use App\EventUser;
use App\EventGallery;
use App\Exports\EventUserExport;
use App\Models\Province;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\Http\Requests\EventRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\Facades\DataTables;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class EventAdminController extends Controller
{
    public function index()
    {
        if (request()->ajax()) {
            $query  = Events::with(['user', 'category'])
                ->where('user_id', Auth::user()->id);

            return DataTables::of($query)
                ->addColumn('action', function ($item) {
                    return '
                       <div class="text-center">
                        <a href=" ' . route('event.admin.index.event', $item->slug) . ' " class="btn-sm btn-info"><i class="fas fa-eye"></i></a>
                        <a href=" ' . route('event.admin.edit', $item->id) . ' " class="btn-sm btn-primary"><i class="fas fa-pencil-alt"></i></a>

                        <form action="' . route('event.admin.destroy', $item->id) . '" method="POST" style="display:inline;">
                        ' . method_field('delete') . csrf_field() . ' 
                        <button type="submit" class="btn-sm btn-danger btnDelete" data-id="' . $item->id . '"><i class="fas fa-trash-alt"></i></button>

                        </form> 
                        
                        </div>
                    
                    ';
                })

                ->addColumn('check', function ($item) {
                    return '
                      <div class="text-center">
                        <a href=" ' . route('event.admin.index.event.check.in', $item->slug) . ' " class="btn-sm btn-success"><i class="fas fa-sign-in-alt"></i></a>
                        <a href=" ' . route('event.admin.index.event.check.out', $item->slug) . ' " class="btn-sm btn-danger"><i class="fas fa-sign-out-alt"></i></a>


                        </div>
                    
                    ';
                })

                ->editColumn('date_time', function ($item) {
                    return ($item->date_time->format('d M Y H:i'));
                })
                ->editColumn('price', function ($item) {
                    return 'Rp' . number_format($item->price) . ',00';
                })

                ->rawColumns(['action', 'check'])
                ->make();
        }
        return view('pages.admin.event.index');
    }

    public function create()
    {
        $categories = Category::all();
        return view('pages.admin.event.create', compact('categories'));
    }

    public function store(EventRequest $request)
    {

        $this->validate($request, [
            'photos'      => 'required',
            'photos.*'      => 'required|image|mimes:jpeg,png,jpg',
        ]);

        $data = $request->all();

        $data['slug'] = Str::slug($request->name);


        if ($request->event_type == "FREE") {
            $data['price'] = 0;

            $result = Events::create($data);

            $dataPhoto['event_id'] = $result->id;
            if ($request->hasFile('photos')) {
                $photos = $request->file('photos');
                foreach ($photos as $photo) {

                    $dataPhoto['photos'] = $photo->store('assets/event', 'public');
                    $result = EventGallery::create($dataPhoto);
                }
            }


            if ($result) {
                Alert::success('Berhasil', 'Data Berhasil di Simpan !');
            } else {
                Alert::error('Gagal', 'Data Gagal di Simpan!');
            }


            return redirect()->route('event.admin.index');
        } else if ($request->event_type == "PREMIUM" && $request->price == 0) {
            Alert::error('Gagal', 'Silahkan isi Harga Event');
            return back();
        } else {
            $result = Events::create($data);

            $dataPhoto['event_id'] = $result->id;
            if ($request->hasFile('photos')) {
                $photos = $request->file('photos');
                foreach ($photos as $photo) {

                    $dataPhoto['photos'] = $photo->store('assets/event', 'public');
                    $result = EventGallery::create($dataPhoto);
                }
            }

            if ($result) {
                Alert::success('Berhasil', 'Data Berhasil di Simpan !');
            } else {
                Alert::error('Gagal', 'Data Gagal di Simpan !');
            }

            $dataPhoto['event_id'] = $result->id;

            return redirect()->route('event.admin.index');
        }
    }

    public function show($id)
    {
    }

    public function edit($id)
    {
        $categories = Category::all();
        $item = Events::with(['galleries'])->findOrFail($id);

        return view('pages.admin.event.edit', compact('categories', 'item'));
    }

    public function update(Request $request, $id)
    {

        $this->validate($request, [
            'user_id'      => 'required|exists:users,id',
            'name'         => 'required',
            'category_id'      => 'required|exists:categories,id',
            'description'   => 'required',
            'date_time'     => 'required',
            'location'     => 'required|string',
            'location_details'     => 'required|string',
        ]);

        $data = $request->all();

        $data['slug'] = Str::slug($request->name);

        $item = Events::findOrFail($id);


        if ($request->event_type == "FREE") {
            $data['price'] = 0;

            $result = $item->update($data);

            if ($result) {
                Alert::success('Berhasil', 'Data Berhasil di Simpan !');
            } else {
                Alert::error('Gagal', 'Data Gagal di Simpan!');
            }
            $dataPhoto['event_id'] = $item->id;

            return redirect()->route('event.admin.index');
        } else if ($request->event_type == "PREMIUM" && $request->price == 0) {
            Alert::error('Gagal', 'Silahkan isi Harga Event');
            return back();
        } else {
            $result = $item->update($data);

            if ($result) {
                Alert::success('Berhasil', 'Data Berhasil di Simpan !');
            } else {
                Alert::error('Gagal', 'Data Gagal di Simpan !');
            }

            $dataPhoto['event_id'] = $item->id;

            return redirect()->route('event.admin.index');
        }
    }

    public function destroy($id)
    {
        $item = Events::findOrFail($id);

        $item->galleries()->delete();
        $item->event_user()->delete();

        $item->delete();

        return redirect()->route('event.admin.index');
    }

    public function uploadGallery(Request $request)

    {
        $data = $request->all();

        $data['photos'] = $request->file('photos')->store('assets/event', 'public');

        $result = EventGallery::create($data);

        if ($result) {
            Alert::success('Berhasil', 'Data Gallery Berhasil di Tambah !');
        } else {
            Alert::error('Gagal', 'Data Gallery Gagal di Tambah !');
        }

        return redirect()->route('event.admin.edit', $request->event_id);
    }

    public function deleteGallery($id)
    {
        $item = EventGallery::findOrFail($id);
        $result = $item->delete();


        if ($result) {
            Alert::success('Berhasil', 'Data Berhasil di Hapus !');
        } else {
            Alert::error('Gagal', 'Data Gagal di Hapus !');
        }

        return redirect()->route('event.admin.edit', $item->event_id);
    }


    public function indexEvent($id)
    {
        $event = Events::with(['user'])->where('slug', $id)->firstOrFail();


        if (request()->ajax()) {
            $query  = EventUser::with(['user', 'event'])
                ->where('event_id', $event->id)->get();

            return DataTables::of($query)
                ->addColumn('action', function ($item) {
                    return '
                       <div class="text-center">
                        <a href=" ' . route('event.admin.user.detail', $item->id) . ' " class="btn-sm btn-info"><i class="fas fa-eye"></i></a>
                        <a href=" ' . route('event.admin.user.edit', $item->id) . ' " class="btn-sm btn-primary"><i class="fas fa-pencil-alt"></i></a>

                        <form action="' . route('event.admin.user.destroy', $item->id) . '" method="POST" style="display:inline;">
                        ' . method_field('delete') . csrf_field() . ' 
                        <button type="submit" class="btn-sm btn-danger btnDelete" data-id="' . $item->id . '"><i class="fas fa-trash-alt"></i></button>

                        </form> 
                        </div>
                    
                    ';
                })
                ->rawColumns(['action'])
                ->make();
        }
        return view('pages.admin.event.index-event', compact('event'));
    }

    public function createEventUser($id)
    {
        $provinces = Province::all();

        $event = Events::where('slug', $id)->firstOrFail();

        return view('pages.admin.event.create-user', compact('provinces', 'event'));
    }


    public function createEventUserStore(Request $request, $id)
    {

        $this->validate($request, [
            'name' => 'required|string|max:30',
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

        $data['password'] = bcrypt(Str::random(10));
        $data['email']    = Str::random(10) . '@gmail.com';

        $result = User::create($data);

        $user_id = $result->id;

        $event_user = new EventUser;
        $event_user->user_id = $user_id;
        $event_user->event_id = $request->event_id;
        $event_user->code = Str::random(10);
        $event_user->status_checkin = 0;
        $event_user->save();

        $minStock = Events::findOrFail($request->event_id);

        $minStock->event_stock -= 1;
        $minStock->save();

        if ($result) {

            Alert::success('Berhasil', 'Data Berhasil Pengunjung Berhasil Di Tambahkan !');
        } else {
            Alert::error('Gagal', 'Data Gagal di Tambahkan !');
        }

        return redirect()->route('event.admin.index.event', $event_user->event->slug);
    }

    public function eventUserEdit($id)
    {
        $provinces = Province::all();
        $EventUser = EventUser::with(['user', 'event'])->findOrFail($id);

        return view('pages.admin.event.edit-user', compact('provinces', 'EventUser'));
    }


    public function eventUserUpdate(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|string|max:30',
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

        $EventUser = EventUser::with(['user', 'event'])->findOrFail($id);

        $user = User::find($EventUser->user->id);

        $result = $user->update($data);

        if ($result) {
            Alert::success('Berhasil', 'Data Berhasil Pengunjung Berhasil Di Tambahkan !');
        } else {
            Alert::error('Gagal', 'Data Gagal di Tambahkan !');
        }

        return redirect()->route('event.admin.index');
    }



    public function eventUserDetail($id)
    {
        $EventUser = EventUser::with(['user', 'event'])->findOrFail($id);

        //  $qrcode = QrCode::format('png')->size(150)->generate($EventUser->code);

        return view('pages.admin.event.detail-user', compact('EventUser'));
    }


    public function destroyUser($id)
    {
        $event_user = EventUser::with(['event'])->findOrFail($id);


        $event_user->delete();

        return redirect()->route('event.admin.index.event', $event_user->event->slug);
    }



    //checkin checkout
    public function indexEventCheckIn($id)
    {
        $event = Events::with(['user'])->where('slug', $id)->firstOrFail();


        if (request()->ajax()) {
            $query  = EventUser::with(['user', 'event'])
                ->where('event_id', $event->id)->get();

            return DataTables::of($query)
                ->editColumn('status_checkin', function ($item) {
                    if ($item->status_checkin == 1) {
                        return '<span class="badge badge-success">' . "Check In" . '</span>';
                    } else {
                        return '<span class="badge badge-danger">' . "Check Out" . '</span>';
                    }
                })
                ->rawColumns(['status_checkin'])
                ->make();
        }
        return view('pages.admin.event.index-event-checkin', compact('event'));
    }

    public function updateStatusCheckIn(Request $request)
    {
        $this->validate($request, [
            'code' => 'required',
        ]);



        $CekData  = EventUser::with(['user', 'event'])
            ->where('code', $request->code)->exists();


        if ($CekData) {
            $EventUser  = EventUser::with(['user', 'event'])
                ->where('code', $request->code)->first();

            $dateTime = $EventUser->event->date_time;
            $dateNow = strtotime('now');

            $dateEvent = strtotime('+1 week', strtotime($dateTime));

            if ($dateEvent > $dateNow) {

                $data['status_checkin'] = 1;
                $EventUser->update($data);

                return redirect()->route('event.admin.index.event.check.in', $EventUser->event->slug)->with('status', 'Berhasil Check In');
            } else {
                return redirect()->back()->with('error', 'Tiket Expired');
            }
        } else {
            return redirect()->back()->with('error', 'Data Tidak Di Temukan !');
        }
    }

    public function indexEventCheckOut($id)
    {
        $event = Events::with(['user'])->where('slug', $id)->firstOrFail();


        if (request()->ajax()) {
            $query  = EventUser::with(['user', 'event'])
                ->where('event_id', $event->id)->get();

            return DataTables::of($query)
                ->editColumn('status_checkin', function ($item) {
                    if ($item->status_checkin == 1) {
                        return '<span class="badge badge-success">' . "Check In" . '</span>';
                    } else {
                        return '<span class="badge badge-danger">' . "Check Out" . '</span>';
                    }
                })
                ->rawColumns(['status_checkin'])
                ->make();
        }
        return view('pages.admin.event.index-event-checkout', compact('event'));
    }

    public function updateStatusCheckOut(Request $request)
    {
        $this->validate($request, [
            'code' => 'required',
        ]);

        $CekData  = EventUser::with(['user', 'event'])
            ->where('code', $request->code)->exists();


        if ($CekData) {
            $EventUser  = EventUser::with(['user', 'event'])
                ->where('code', $request->code)->first();

            //mengecek apakah tiket expired atau tidak
            $dateTime = $EventUser->event->date_time;
            $dateNow = strtotime('now');

            $dateEvent = strtotime('+1 week', strtotime($dateTime));

            if ($dateEvent > $dateNow) {
                $data['status_checkin'] = 0;
                $EventUser->update($data);

                return redirect()->route('event.admin.index.event.check.out', $EventUser->event->slug)->with('status', 'Berhasil Check Out');
            } else {
                return redirect()->back()->with('error', 'Tiket Expired');
            }
        } else {
            return redirect()->back()->with('error', 'Data Tidak Di Temukan !');
        }
    }

    public function exportExcel($id)
    {

        $event = Events::findOrFail($id);

        return (new EventUserExport($id))->download('Report-Data-Peserta-' . $event->name . '.xlsx');
    }
}
