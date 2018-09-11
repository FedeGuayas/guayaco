<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class InscripcionFormRequest extends Request
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
            'persona_id'=>'required|unique:inscripciones',
            'user_id'=>'required',
            'categoria_id'=>'required',
            'circuito_id'=>'required',
            'edad'=>'required',
            'costo'=>'required',
            'num_corredor'=>'uniqued:inscripciones',
            
            'comp_nombres' => 'required',
            'comp_apellidos' => 'required',
            'comp_documento' => 'required',
            'comp_telefono' => 'required',
            'comp_direccion' => 'required',
            'comp_email' => 'required|email',

        ];
    }
}
