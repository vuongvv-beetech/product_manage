<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


class UserRequest extends FormRequest
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
            'email' => 'required|email|max:100|unique:users,email',
            'name'=>'required|max:50',
            'firstname'=>'required|max:50',
            'lastname'=>'required|max:50',
            'birthday'=>'date|before:18 years ago',
            'province'=>'required',
            'district'=>'required',
            'commune'=>'required',
            'avatar'=>'required|mimes:jpg,jpeg,png|max:3072'
        ];
    }
    /**
     * Get the notification.
     *
     * @return array
    */
    public function messages()
    {
        return [
            'email.required' => 'Email là trường bắt buộc',
            'email.email' => 'Email không đúng định dạng',
            'birthday.before'=>'Tuổi phải lớn hơn 18',
            'province.required' => 'Tỉnh là trường bắt buộc',
            'district.required' => 'Huyện là trường bắt buộc',
            'commune.required' => 'Xã là trường bắt buộc',
        ];
    }
}
