<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RoleRequest extends FormRequest
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
        $id = $this->route('id');
        return [
            
            
            'name' => "unique:role,name,{$id},id|required|string|min:3|max:40",
            //
        ];
        
    }
    public function messages()
    {
        return [
//            'email.required' => 'Email is required!',
            'name.required' => 'Tên cần nhập',
            'name.unique'=>'tên role đã tồn tại',
            'name.min' => 'Tên role quá ngắn',
            'name.max' => 'Tên role quá dài',
         
        ];

    }

}
