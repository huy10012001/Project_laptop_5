<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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
        
            
           
            'name' =>"required|string|min:3|max:40|unique:product,name|unique:category,name,{$id},id",
            //
        ];
        
    }
    public function messages()
    {
        return [
//            'email.required' => 'Email is required!',
            'name.unique'=> 'Tên sản phẩm hoặc tên danh mục đã tồn tại!',
            'name.required' => 'Tên cần nhập',
            
            'name.min' => 'Tên danh mục  quá ngắn',
        'name.max' => 'Tên danh mục quá dài',
         
        ];

    }
}
