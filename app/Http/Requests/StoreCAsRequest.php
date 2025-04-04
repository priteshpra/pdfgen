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
            'FirmName' => 'required',
            'ClientCode' => 'required|max:4|unique:company',
            'Address' => 'required',
            'CountryID' => 'required',
            'StateID' => 'required',
            'CityID' => 'required',
            'PinCode' => 'required|max:6',
            'AadharNumber' => 'required|digits:12',
            'GSTNumber' => 'required|alpha_num|size:15',
            'PANNumber' => 'required|regex:/^[A-Z]{5}[0-9]{4}[A-Z]{1}$/',
            'FirmType' => 'required',
            'BusinnessCatID' => 'required',
        ];
    }
}
