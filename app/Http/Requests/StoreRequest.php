<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
        //return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //
            'name'          =>'required',
            'description'   =>'required|min:10',
            'phone'         =>'required',
            'mobile_phone'  =>'required',
            'logo'          =>'image | mimes:jpeg,jpg,png'
        ];
    }

    public function messages()
    {
        return [
            'required'  =>'Este campo é obrigatório', // 'required'=>'Este campo :attribute é obrigatório',
            'min'       =>'Campo deve ter no mínimo :min caracteres',
            'image'     =>'Arquivo LOGO não é uma imagem válida!!!'
        ];
    }
}
