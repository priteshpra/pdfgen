<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Gate;

class UpdateUserRequest extends FormRequest
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
            'FirstName' => 'required|string|min:2|max:200',
            'Email' => [
                'required',
                'Email',
                'max:200',
                Rule::unique('users')->ignore($this->user),
            ],
            'password' => 'nullable|min:6|max:20',
            'role_id' => 'required|exists:roles,id',
            'LastName' => 'required|string|min:2|max:200',
            'MobileNo' => 'required|regex:/^[0-9]{10}$/',
            'Address' => 'required',
        ];
    }
}
