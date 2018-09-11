<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class UsuarioFormRequest extends Request
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
            'name'=>'required|max:15',
            'password'=>'required|max:100|min:6',
            'nombre'=>'required|max:100',
            'email'=>'required|email',
            'rols_id'=>'required',
            'escenario_id'=>'required',
            'avatar'=>'image'
        ];
    }
}
