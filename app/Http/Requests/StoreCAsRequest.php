<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class StoreCAsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Gate::allows('user_create');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string|min:2|max:200',
            'lname' => 'required|string|min:2|max:200',
            'address' => 'required',
            'CountryID' => 'required',
            'StateID' => 'required',
            'CityID' => 'required',
            'pincode' => 'required|max:6',
            'aadhar' => 'required',
            'gst' => 'required',
            'pan' => 'required',
            'user_type' => 'required',
            'firm_type' => 'required',
            'mobile_no' => 'required|regex:/^[0-9]{10}$/',
            'email' => 'required|email|max:200|unique:users',
            'password' => 'required|confirmed|min:6|max:20',
            'role_id' => 'required|exists:roles,id',
        ];
    }
}
