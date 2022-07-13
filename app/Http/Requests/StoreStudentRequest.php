<?php

namespace App\Http\Requests;

use App\Actions\Fortify\PasswordValidationRules;
use Illuminate\Foundation\Http\FormRequest;

class StoreStudentRequest extends FormRequest

{
    use PasswordValidationRules;
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->user()->hasPermission('users_create');
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
            'email'   => 'required|email|unique:users|max:50|min:2',
            'password' =>  $this->passwordRules(),
            'address'   => 'nullable|max:20',
            'profile'   => 'nullable|mimes:jpg,jpeg,png',
            'permissions'   =>  'required|array|min:1',
            'activation' =>  'required',
        ];
    }
}
