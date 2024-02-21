<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
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
            'image' => 'soemtimes|img',
            'name' => 'required',
            'email' => 'required|unique',
            'phone' => 'required|min:13|max:13',
            'type' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
            'password' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'image.sometimes' => 'حقل الصورة يجب أن يكون صورة إذا تم تقديمه.',
            'image.image' => 'حقل الصورة يجب أن يحتوي على صورة صالحة.',
            'name.required' => 'حقل الاسم مطلوب.',
            'email.required' => 'حقل البريد الإلكتروني مطلوب.',
            'email.unique' => 'قيمة البريد الإلكتروني مستخدمة بالفعل.',
            'phone.required' => 'حقل الهاتف مطلوب.',
            'phone.min' => 'يجب أن يكون حقل الهاتف على الأقل 13 رقم.',
            'phone.max' => 'يجب أن يكون حقل الهاتف على الأكثر 13 رقم.',
            'type.required' => 'حقل النوع مطلوب.',
            'latitude.required' => 'حقل خط العرض مطلوب.',
            'longitude.required' => 'حقل خط الطول مطلوب.',
            'password.required' => 'حقل كلمة المرور مطلوب.',
        ];
    }
}
