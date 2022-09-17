<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class UpdateTopicRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->user()->hasPermission('topics_update');
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'name' => Str::slug($this->name, '-'),
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
            'name' => [
                'required',
                Rule::unique('topics')->ignore($this->topic),
                'max:50',
                'min:2'
            ],
            'playlist_category_id' => 'required',
            'activation' => 'required'
        ];
    }
}
