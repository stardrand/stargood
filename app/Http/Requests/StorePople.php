<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePople extends FormRequest
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
            'uname'=>'required|unique:pople|min:2|max:12',
            'u_age'=>'required|integer|min:1|max:200'
        ];
    }
    public function messages(){
        return [
            'uname.required'=>'姓名不能为空',
            'uname.unique'=>'姓名已存在',
            'u_age.required'=>'年龄不能为空',
            'u_age.integer'=>'年龄必须为数字',
        ];
    }

}
