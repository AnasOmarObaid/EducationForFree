<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdatePostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->user()->hasPermission('posts_update');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'title' => [
                'required',
                Rule::unique('posts')->ignore($this->post->id),
                'max:50',
                'min:3'
            ],
            'body' => 'required|min:5',
            'post_category_id' => 'required',
            'activation' => 'required',
            'image' => 'nullable|mimes:jpg,jpeg,png'
        ];
    } //-- end of rules
}//-- end class UpdatePostRequest
