<?php

namespace App\Http\Requests;


class ComprobanteFormRequest extends Request
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
            'inscripciones_id'=>'required',
            'nombres'=>'required',
            'apellidos'=>'required',
            'num_doc'=>'required',
            'telefono'=>'max:30',
            'num_cuenta'=>'required',
        ];
    }
}
