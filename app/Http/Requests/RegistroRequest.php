<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegistroRequest extends FormRequest
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
            'nombres' => 'required',
            'apellido_paterno' => 'required',
//            'cargo' => 'required',
            'ci' => 'required',
            'email' => 'required|email',
            'id_departamento' => 'required',
            'password' => 'required',
            'password_confirm' => 'required|same:password'            
        ];
    }
}
