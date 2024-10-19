<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class BussinessCatRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Gate::allows('bussiness_create');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'CategoryName' => 'required|string|min:2|max:200',
            'MetaTitle' => 'required',
            'MetaKeywords' => 'required',
            'MetaDescription' => 'required',
        ];
    }
}
