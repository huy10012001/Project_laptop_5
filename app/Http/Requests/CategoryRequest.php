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
            
            'name' => 'required|string|min:3|max:40',
            'name' => "unique:category,name,{$id},id",
            //
        ];
        
    }
    public function messages()
    {
        return [
//            'email.required' => 'Email is required!',
            'name.required' => 'Tên cần nhập',
            'name.unique' => 'Tên danh mục đã tồn tại',
            'name.min' => 'Tên danh mục  quá ngắn',
        'name.max' => 'Tên danh mục quá dài',
         
        ];

    }
}
