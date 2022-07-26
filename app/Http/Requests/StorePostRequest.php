<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class StorePostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->user()->hasPermission('posts_create');
    }



    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'title' => 'required|unique:posts|max:50|min:3',
            'body' => 'required|min:5',
            'post_category_id' => 'required',
            'activation' => 'required',
            'image' => 'required|mimes:jpg,jpeg,png'
        ];
    } //-- end of rules
}//-- end class StorePostRequest
