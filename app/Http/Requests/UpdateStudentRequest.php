<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateStudentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->user()->hasPermission('users_update');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required|max:15|min:2',
            'email' => [
                'required',
                Rule::unique('users')->ignore($this->student),
                'max:50',
                'min:2'
            ],
            'address'   => 'nullable|max:20',
            'profile'   => 'nullable|mimes:jpg,jpeg,png',
            'permissions'   =>  'required|array|min:1',
            'activation' =>  'required',
        ];
    }
}
