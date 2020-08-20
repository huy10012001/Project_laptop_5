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
            
            'email' => 'unique:user',
           
          
            //
        ];
    }
    public function messages()
    {
        return [
          
                        'email.unique'=> 'tên email tồn tại',
                        
          ];

    }

}

  

