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
            'SĐT' => 'required',
            'address' => 'required',
            'email' => 'required|unique:user',
           
          
           
            'password' => 'required',
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
            'email.unique'=> 'tên email tồn tại'
               
                        
          ];

    }

}

  

