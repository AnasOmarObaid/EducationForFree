<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class StoreRoleRequest extends FormRequest
{

    protected $stopOnFirstFailure = false;
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->user()->hasPermission('roles_create');
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'name' => Str::slug($this->name, '_'),
        ]);
    }
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {

        return [
            'name' => 'required|unique:roles|max:20|min:2',
            'description'   => 'required|max:250|min:2',
            'permissions' => 'required|array'
        ];
    }
}
