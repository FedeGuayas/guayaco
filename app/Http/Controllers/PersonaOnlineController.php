<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Session;
use App\Persona;

use Illuminate\Support\Facades\Redirect;

class PersonaOnlineController extends Controller
{
    public function __construct(){
//        $this->middleware('guest');
    }

    public function store(Request $request)
    {

        $validator = $this->validator($request->all());

        if ($validator->fails()) {
            $this->throwValidationException(
                $request, $validator
            );
        }

        $persona=new Persona;
        $persona->nombres=$request->get('nombres');
        $persona->apellidos=$request->get('apellidos');
        $persona->tipo_doc=$request->get('tipo_doc');
        $persona->num_doc=$request->get('num_doc');
        $persona->genero=$request->get('genero');
        $persona->fecha_nac=$request->get('fecha_nac');
        $persona->direccion=$request->get('direccion');
        $persona->email=$request->get('email');
        $persona->telefono=$request->get('telefono');
        $persona->estado='1';
        $persona->save();
        Session::flash('message','Pre-inscripción guardada correctamente');
        return Redirect::to('/online');

    }

    /**
     * Get a validator for an incoming registration request.
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        //variable tipo arreglo en donde se haga el arreglo de validación final
        $out = [];
        /** Quiero que, sin importar que ingrese, los campos de nombre, email, teléfono y modo de envio sean requeridos **/
        $out['nombres'] = 'required | max:50';
        $out['apellidos'] = 'required | max:50';
        $out['genero'] = 'required';
        $out['fecha_nac'] = 'required';
        $out['email'] = 'email';
        $out['direccion'] = 'max:255';
        $out['direccion'] = 'max:255';
        $out['telefono'] = 'max:30';
        $out['tipo_doc'] = 'required';
        $out['num_doc'] = 'required';

        //Hacer validación condicional dependiendo del tipo de documento a utilizar.
        switch($data['tipo_doc']){
            case 'CEDULA':
                $out['num_doc'] = 'required|digits:10 | unique:personas';
                break;
            case 'PASAPORTE':
                $out['num_doc'] = 'required|alpha_num |max:8 |min:5| unique:personas';
                break;
            case 'NO-DOC':
                $out['num_doc'] = 'required|alpha_num |max:5 |min:3| unique:personas';
                break;
        }

        //Retornar la variable $out auxiliar
        return Validator::make($data, $out);
    }
    
    
    
    
    
}
