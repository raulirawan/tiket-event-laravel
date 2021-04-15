<?php

namespace App\Http\Controllers;

use App\User;
use App\Models\Province;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class ProfileController extends Controller
{
    public function index()
    {
        $provinces = Province::all();
        $item = User::where('id', Auth::user()->id,)->first();


        return view('pages.profile', compact('provinces', 'item'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:30',
            'address' => 'required|string',
            'province_id' => 'required',
            'regency_id' => 'required',
            'district_id' => 'required',
            'village_id' => 'required',
            'zip_code' => 'required|integer|min:5',
            'mobile_number' => 'required|max:14',
            'position' => 'required',
            'profile_photo' => 'mimes:jpeg,png',
        ]);

        $data = $request->all();

        if ($request->hasFile('profile_photo')) {

            $photos = $request->file('profile_photo');
            $data['profile_photo'] = $photos->store('assets/event', 'public');


            // $user = Auth::user();
            // $user->profile_photo = '123121';
            // $user->save();
        }
        // $data['profile_photo'] = $request->file('profile_photo')->store('assets/profile', 'public');

        // $profile_photo = $request->file('profile_photo');
        // $profile = Image::make($profile_photo)->resize(150,150);
        // $data['profile_photo'] = Storage::put('profile_photo', $profile);

        $item = User::findOrFail(Auth::user()->id);

        $result = $item->update($data);

        if ($result) {
            Alert::success('Berhasil', 'Data Berhasil di Update !');
        } else {
            Alert::error('Gagal', 'Data Gagal di Update !');
        }

        return redirect()->route('profile.index');
    }


    public function changePassword()
    {
        return view('pages.change-password');
    }

    public function changePasswordUpdate(Request $request)
    {
        $this->validate($request, [
            'oldPassword' => 'required',
            'password' => 'required|confirmed',

        ]);
        if (!(Hash::check($request->get('oldPassword'), Auth::user()->password))) {

            alert()->error('Error', 'Password lama anda salah');
            return redirect()->route('change.password');
        }

        if (strcmp($request->get('oldPassword'), $request->get('password')) == 0) {

            alert()->error('Gagal', 'Password baru anda tidak boleh sama dengan Password Lama');
            return redirect()->route('change.password');
        }



        $user = Auth::user();
        $user->password = bcrypt($request->get('password'));
        $user->save();
        alert()->success('success', 'Your Passowrd Has Been Changed!');
        return redirect()->route('change.password');
    }
}
