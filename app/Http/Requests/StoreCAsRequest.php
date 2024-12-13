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
            'Address' => 'required',
            'ClientCode' => 'required|max:4|unique:company',
            'CountryID' => 'required',
            'StateID' => 'required',
            'CityID' => 'required',
            'PinCode' => 'required|max:6',
            'AadharNumber' => 'required',
            'GSTNumber' => 'required',
            'PANNumber' => 'required',
            'FirmType' => 'required',
            'FirmName' => 'required',
        ];
    }
}
