<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class registerRequest extends FormRequest
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
            'name' => 'required|min:2|max:30|regex:/^[a-zA-Z[:space:]ÀÁÂÃÈÉÊÌÍÒÓÔÕÙÚĂĐĨŨƠàáâãèéêìíòóôõùúăđĩũơƯĂẠẢẤẦẨẪẬẮẰẲẴẶẸẺẼỀỀỂưăạảấầẩẫậắằẳẵặẹẻẽềềểỄỆỈỊỌỎỐỒỔỖỘỚỜỞỠỢỤỦỨỪễệỉịọỏốồổỗộớờởỡợụủứừỬỮỰỲỴÝỶỸửữựỳỵỷỹ]{2,30}$/u',
            'SĐT' => 'required|numeric|min:10|regex:/(0)[0-9]{9}/',
            'address' => 'required',
            'email' => 'required|email|unique:user',
          
            'password' => 'required',
            'password_confirmation' => 'same:password'
            //
        ];
    }
    public function messages()
    {
        return [
            'name.required'=> 'Bạn chưa nhập tên',
            'name.min'=> 'Tên phải từ 2-30 ký tự',
            'name.max'=> 'Tên phải từ 2-30 ký tự',
            'name.regex'=> 'tên name không hợp lệ',   
            'email.unique'=> 'tên email tồn tại',
            'email.email'=> 'tên email không hợp lệ',
            'email.required'=>'email phải nhập',
            'SĐT.required'=>'SĐT phải nhập',
            'SĐT.min'=>'số điện thoại 10 số vui lòng nhập lại',
            'SĐT.max'=>'số điện thoại 10 số vui lòng nhập lại',
            'SĐT.numeric'=>'số điện thoại không hợp lệ vui lòng nhập lại',
            'SĐT.regex'=>'số điện thoại không hợp lệ vui lòng nhập lại',
            'address.required'=>'Địa chỉ phải nhập',
            'password.required'=>'mật khẩu phải nhập',
            
            'password_confirmation.same'=> 'Xác nhận mật khẩu'
                        
          ];

    }

}

  

