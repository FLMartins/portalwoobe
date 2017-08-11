<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use Auth;

class UserRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'=>'required|min:5',
            'email'=>'required|email'
        ];
    }

     /**
     * Get the validation messages that apply to the request.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.required'=>'O nome não pode estar em branco',
            'name.min'=>'O nome deve conter pelo menos 5 caracteres',
            'email.required'=>'O email não pode estar em branco',
            'email.email'=>'O email deve ser válido'
        ];
    }
}
