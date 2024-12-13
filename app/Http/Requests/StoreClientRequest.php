<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class StoreClientRequest extends FormRequest
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
            'FirstName' => 'required|string|min:2|max:200',
            'LastName' => 'required|string|min:2|max:200',
            'FirmName' => 'required',
            'ClientCode' => 'required|max:4|unique:company',
            'Address' => 'required',
            'CountryID' => 'required',
            'StateID' => 'required',
            'CityID' => 'required',
            'PinCode' => 'required|max:6',
            'AadharNumber' => 'required',
            'GSTNumber' => 'required',
            'PANNumber' => 'required',
            'FirmType' => 'required',
            'MobileNo' => 'required|regex:/^[0-9]{10}$/',
            'Email' => 'required|email|max:200|unique:users',
            'password' => 'required|confirmed|min:6|max:20',
            'role_id' => 'required|exists:roles,id',
            'UserType' => 'required',
        ];
    }
}
