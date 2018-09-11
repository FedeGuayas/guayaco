<?php

namespace App\Http\Controllers;

use App\Persona;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\ImportaPersona;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\App;

class ImportarPersonasController extends Controller
{
    public function __construct()
    {

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

//        $personas=ImportaPersona::on('guayaco')
//            ->select('ci','sexo','fecha_nac','direccion','email','telefono','nombres','apellidos')
//            ->paginate(20)
//            ;
//        DB::reconnect('mysql');

        $ext = \DB::connection('guayaco');
        $personas = $ext->table('corredor')
            ->select('id','ci','sexo','fecha_nac','direccion','email','telefono','nombres','apellidos')
            ->paginate(20);





        return view('runner.personas.importar.import',["personas"=>$personas]);

    }

//    public function imp()
//    {
////        $importapersona = new ImportaPersona;
////
////        $importapersona->setConnection('guayaco');
////
//        $personas=DB::connection('guayaco')
//            ->select('ci','sexo','fecha_nac','direccion','email','telefono','nombres','apellidos')
//            ->where('id','<=','10');
//
//        // Running query with default connection.
////        $userArray = DB::table('users')->get();
////        print_r($userArray);
//
////// Makeing an object of second DB.
////        $u2 = DB::connection('guayaco');
////// Getting data with second DB object.
////        $u = $u2->table('corredor')->get();
//
//
//        return ($personas);
////        return view('runner.personas.importar.import',["personas"=>$personas]);
//    }





    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
//        return dd($request);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
//        $persona = Inscripcion::create([
//            'persona_id' => $request['persona_id'],
//            'categoria_id' => $request['categoria_id'],
//            'circuito_id' => $request['circuito_id'],
//            'user_id' => $request['user_id'],
//            'fecha_insc' => $request['fecha_insc'],
//            'edad' => $request['edad'],
//            'kit' => '1',
//            'talla' => $request['talla'],
//            'escenario' => $request['escenario'],
//            'deporte' => $request['deporte'],
//            'recomendado' => $request['recomendado'],
//            'costo' => $request['costo'],
//            'num_corredor' => $numcorredor,
////        ]);

//        $personasArray[]=['Nombres', 'Apellidos', 'Numero Corredor','Categoria','Circuito'];
//        foreach ($request as $insc) {
//            $personasArray[] = [
//                'nombres'=>$insc->id,
//                'apellidos'=>$insc->nombres,
//                'apellidos'=>$insc->apellidos,
//                'numero'=>$insc->ci,
//                'categoria'=>$insc->sexo,
//                'circuito'=>$insc->fecha_nac,
//                'circuito'=>$insc->email,
//                'circuito'=>$insc->direccion,
//                'circuito'=>$insc->telefono,
//
//
//            ];
//        }


//        return dd($request->get('personas'));
        return 'personas';


//        $persona=new Persona;
//        $persona->nombres=$request->get('nombres');
//        $persona->apellidos=$request->get('apellidos');
//        $persona->tipo_doc='Cedula';
//        $persona->num_doc=$request->get('num_doc');
//        $persona->genero=$request->get('genero');
//        $persona->fecha_nac=$request->get('fecha_nac');
//        $persona->direccion=$request->get('direccion');
//        $persona->email=$request->get('email');
//        $persona->telefono=$request->get('telefono');
//        $persona->estado='1';
//        $persona->save();
//        Session::flash('message','Persona creada correctamente');
//        return Redirect::to('runner/personas');
//
//
        
        //Insertar registros en la bd
//        DB::table('personas')->insert(
//            ['email' => 'john@example.com', 'votes' => 0]
//        );

        //Si la tabla tiene un ID auto-incremental, utilizar insertGetId para insertar un registro y recuperar el ID:
//        $id = DB::table('users')->insertGetId(
//            ['email' => 'john@example.com', 'votes' => 0]
//        );
//      Insertar multiples registros
//        DB::table('users')->insert([
//            ['email' => 'taylor@example.com', 'votes' => 0],
//            ['email' => 'dayle@example.com', 'votes' => 0]
//        ]);

//        Actualizar registros en una tabla

//        DB::table('users')
//            ->where('id', 1)
//            ->update(['votes' => 1]);

//        Incrementar o disminuir un valor de una columna

//    DB::table('users')->increment('votes');
//
//    DB::table('users')->increment('votes', 5);
//
//    DB::table('users')->decrement('votes');
//
//    DB::table('users')->decrement('votes', 5);

//        También puedes especificar columnas adicionales a actualizar:

//    DB::table('users')->increment('votes', 1, ['name' => 'John']);

//        Eliminar registros en una tabla

//    DB::table('users')->where('votes', '<', 100)->delete();

        ///Eliminar todos los registros de una tabla

//    DB::table('users')->delete();

//    Vaciar una tabla (truncate)

//    DB::table('users')->truncate();

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
