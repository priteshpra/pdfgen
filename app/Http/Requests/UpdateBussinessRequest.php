<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Gate;

class UpdateBussinessRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Gate::allows('user_edit');
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
