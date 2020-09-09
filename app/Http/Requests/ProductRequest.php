<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
         return true;;
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
            
            //            'email' => 'required|email|unique:users',
           
           
            
           
            'name' =>"required|string|min:3|max:180|unique:category,name|unique:product,name,{$id},id",
            'price' => 'required|integer|min:1000000|max:300000000',
            'category'=> 'required',
            'image' => 'file|image|mimes:jpeg,png,jpg|max:10240,image',
            

        ];
       
    }
    public function messages()
    {
        return [
//            'email.required' => 'Email is required!',
            'name.unique'=> 'Tên sản phẩm hoặc tên danh mục đã tồn tại!',
            'name.required' => 'Tên sản phẩm cần được yêu cầu!',
            'category.required' => 'Tên thương hiệu cần được yêu cầu!',
            'name.min' => 'Tên sản phẩm phải từ 3 ký tự',
            'name.max' => 'Tên sản phẩm không vượt quá 180 ký tự',
            'price.required' => 'Bạn chưa nhập giá!',
            'price.integer' => 'Giá phải là số!',
            'price.min' => 'Giá phải từ 1 triệu tới 300 triệu!',
            'price.max' => 'Giá phải từ 1 triệu tới 300 triệu!',
            
            'image.image' => 'phải là file ảnh',
            'image.mimes' => 'phần mở rộng đuôi file là jpg, jpeg, png',
            'image.max' => ' size lớn nhất của ảnh là 10Mb'
        ];
    }
}
