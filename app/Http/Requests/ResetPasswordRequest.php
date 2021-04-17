<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ResetPasswordRequest extends FormRequest
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
            'password' => 'required|confirmed|min:6',
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
            'password.required' => 'Mật khẩu là trường bắt buộc',
            'password.confirmed' => 'Mật khẩu xác thực không trùng khớp',
            'password.min' => 'Mật khẩu phải chứa ít nhất 8 ký tự',
        ];
    }
}
