<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class checkoutRequest extends FormRequest
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
            'phone' => 'required|numeric|min:10|regex:/(0)[0-9]{9}/',
            'address'=>'required'
          
          
          



        ];

    }
    public function messages()
    {
        return [
            'name.required'=> 'Bạn chưa nhập tên',
            'name.min'=> 'Tên phải từ 2-30 ký tự',
            'name.max'=> 'Tên phải từ 2-30 ký tự',
            'name.regex'=> 'tên name không hợp lệ',
            'phone.required'=>'vui lòng nhập số điện thoại',
            'phone.min'=>'số điện thoại 10 số vui lòng nhập lại',
            'phone.max'=>'số điện thoại 10 số vui lòng nhập lại',
            'phone.numeric'=>'số điện thoại không hợp lệ vui lòng nhập lại',
            'phone.regex'=>'số điện thoại không hợp lệ vui lòng nhập lại',

           
         
            'address.required'=>'vui lòng nhập địa chỉ của bạn'
        ];
    }
}
