<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class PersonaFormRequest extends Request
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
            'nombres'=>'required | max:50',
            'apellidos'=>'required | max:50',
            'genero'=>'required',
            'fecha_nac'=>'required',
            'email'=>'email',
            'direccion'=>'max:255',
            'telefono'=>'max:30',
            'num_doc'=>'required |digits:10 | unique:personas',
            'tipo_doc'=>'required',
        ];

    }



}
