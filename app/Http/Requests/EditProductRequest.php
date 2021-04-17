<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|max:255',
            'sku' => 'required|unique:products,sku,'.request()
                ->id.'|min:10|max:20|regex:/^[a-zA-Z0-9 ]+$/',
            'stock' => 'required|numeric|min:0,max:10000',
            'avatar' => 'mimes:jpg,jpeg,png|max:3072',
        ];
    }
}
