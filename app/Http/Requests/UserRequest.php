<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string|max:30',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:8',
            'roles' => 'nullable|string|in:SUPERADMIN,ADMIN,USER',
            'address' => 'required|string',
            'province_id' => 'required',
            'regency_id' => 'required',
            'district_id' => 'required',
            'village_id' => 'required',
            'zip_code' => 'required|integer|min:5',
            'mobile_number' => 'required|max:14',
            'position' => 'required',
        ];
    }
}
