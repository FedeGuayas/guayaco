<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use Illuminate\Support\Facades\Session;
use App\Persona;

use Illuminate\Support\Facades\Redirect;

use App\Http\Requests\PersonaFormRequest;
use App\Http\Requests\PersonaUpdateRequest;

use DB;

use Illuminate\Support\Facades\Validator;






class PersonaController extends Controller
{

    public function __construct(){
        $this->middleware('auth');
        $this->middleware('administrador',['only'=>'destroy']);
    }

    /**
     * Display a listing of the resource.
     * Muestra una lista de los recursos
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request)
    {
        if ($request) {
            $query=trim($request -> get('searchText'));
           	$personas=DB::table('personas')
                -> where ('num_doc','LIKE','%'.$query.'%')
                ->orWhere('nombres','LIKE','%'.$query.'%')
                ->orWhere('apellidos','LIKE','%'.$query.'%')
                -> where ('estado','1')
        	    -> orderBy ('id','desc')
        	    -> paginate(10);
        	return view ('runner.personas.index',["personas"=>$personas,"searchText"=>$query]);
        }

    }



    /**
     * Show the form for creating a new resource.
     * Mostrar el formulario para crear un nuevo recurso 
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view ("runner.personas.create");
    }



    /**
     * Store a newly created resource in storage.
     * Para almacenar un recurso recien creado
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {

        $validator = $this->validator($request->all());

        if ($validator->fails()) {
            $this->throwValidationException(
                $request, $validator
            );
        }

         $persona=new Persona;
            $persona->nombres=strtoupper($request->get('nombres'));
            $persona->apellidos=strtoupper($request->get('apellidos'));
            $persona->tipo_doc=$request->get('tipo_doc');
            $persona->num_doc=strtoupper($request->get('num_doc'));
            $persona->genero=$request->get('genero');
            $persona->fecha_nac=$request->get('fecha_nac');
            $persona->direccion=strtoupper($request->get('direccion'));
            $persona->email=$request->get('email');
            $persona->telefono=$request->get('telefono');
            $persona->estado='1';
            $persona->save();
        Session::flash('message','Persona creada correctamente');
        return Redirect::to('runner/personas');

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
            case 'NoDoc':
                $out['num_doc'] = 'required|alpha_num |max:5 |min:3| unique:personas';
                break;
        }

        //Retornar la variable $out auxiliar
        return Validator::make($data, $out);
    }


    protected function validatorUpdate(array $data)
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
                $out['num_doc'] = 'required|digits:10';
                break;
            case 'PASAPORTE':
                $out['num_doc'] = 'required|alpha_num |max:8 |min:5';
                break;
            case 'NO-DOC':
                $out['num_doc'] = 'required|alpha_num |max:5 |min:3';
                break;
        }

        //Retornar la variable $out auxiliar
        return Validator::make($data, $out);
    }



    /**
     * Display the specified resource.
     * Visualizar el recurso especificado 
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function show($id)
    {
        $persona=Persona::findOrFail($id);
        return view ('runner.personas.show',["persona"=>$persona]);
    }

    /**
     * Show the form for editing the specified resource.
     *Mostrar el formulario para editar el recurso especificado
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $persona=Persona::findOrFail($id);
       
        return view ('runner.personas.edit',["persona"=>$persona]);
    }



    /**
     * Update the specified resource in storage.
     * Actualizar el recurso especificado en el almacenamiento 
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = $this->validatorUpdate($request->all());

        if ($validator->fails()) {
            $this->throwValidationException(
                $request, $validator
            );
        }

        $persona=Persona::findOrFail($id);

        $persona->nombres=strtoupper($request->get('nombres'));
        $persona->apellidos=strtoupper($request->get('apellidos'));
        $persona->tipo_doc=$request->get('tipo_doc');
        $persona->num_doc=$request->get('num_doc');
        $persona->genero=$request->get('genero');
        $persona->fecha_nac=$request->get('fecha_nac');
        $persona->direccion=strtoupper($request->get('direccion'));
        $persona->email=$request->get('email');
        $persona->telefono=$request->get('telefono');
        $persona->update();

        Session::flash('message','Persona editada correctamente');
        return Redirect::to('runner/personas');

    }



    /**
     * Remove the specified resource from storage.
     *Quitar el recurso especificado de almacenamiento.
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $persona=Persona::findOrFail($id);
        $persona->estado='0';
        $persona->update();
        Session::flash('message','Persona eliminada correctamente');
        return Redirect::to('runner/personas');
    }

    
   
}

