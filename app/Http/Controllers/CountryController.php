<?php

namespace App\Http\Controllers;

use App\Models\District;
use App\Models\Province;
use App\Models\Regency;
use App\Models\Village;

class CountryController extends Controller
{
    // public function provinces()
    // {
    //     $provinces = Province::where('name', "DKI JAKARTA")->get();
    //     dd($provinces);
    //     return view('pages.superadmin.user.create', compact('provinces'));
        
    // }

    public function regencies()
    {
        $provinces_id = request()->get('province_id');
        $regencies = Regency::where('province_id', '=', $provinces_id)->get();
        return response()->json($regencies);
    }

    public function districts()
    {
        $regencies_id = request()->get('regencies_id');
        $districts = District::where('regency_id', '=', $regencies_id)->get();
        return response()->json($districts);
    }

    public function villages()
    {
        $districts_id = request()->get('districts_id');
        $villages = Village::where('district_id', '=', $districts_id)->get();
        return response()->json($villages);
    }
}
