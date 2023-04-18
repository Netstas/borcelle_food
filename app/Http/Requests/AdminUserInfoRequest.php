<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminUserInfoRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'fullname' => 'required',
            'phone' => ['required', 'unique:user_info,phone,' . $this->user_id . ',user_id', 'numeric', 'regex:/((09|03|07|08|05)+([0-9]{8})\b)/'],
            'email' => 'email|unique:user_info,email,' . $this->user_id . ',user_id',
            'birthday' => ['required', 'regex:/^(((0[1-9]|[12]\d|3[01])\-(0[13578]|1[02])\-((19|[2-9]\d)\d{2}))|((0[1-9]|[12]\d|30)\-(0[13456789]|1[012])\-((19|[2-9]\d)\d{2}))|((0[1-9]|1\d|2[0-8])\-02\-((19|[2-9]\d)\d{2}))|(29\-02\-((1[6-9]|[2-9]\d)(0[48]|[2468][048]|[13579][26])|((16|[2468][048]|[3579][26])00))))$/'],
            'avatar' => 'mimes:png,jpg,jpeg,gif,svg|max:2048',
            'permanent_address' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'fullname.required' => 'không được để trống!',
            'phone.required' => 'không được để trống!',
            'phone.numeric' => 'trường này phải là số!',
            'phone.regex' => 'số điện thoại không đúng!',
            'phone.unique' => 'số điện thoại này đã được sử dụng',
            'email.unique' => 'email này đã được sử dụng',
            'birthday.required' => 'không được để trống',
            'birthday.regex' => 'trường này phải là ngày tháng (d-m-y)',
            'avatar.mimes' => 'định dạng ảnh gồm (png, jpg, jpeg, gif, svg)',
            'avatar.max' => 'ảnh quá lớn (không vượt quá 2048KB)',
            'email.unique' => 'email này đã tồn tại',
            'email.email' => 'email không đúng',
            'permanent_address.required' => 'vui lòng nhập địa chỉ thường trú'
        ];
    }
}