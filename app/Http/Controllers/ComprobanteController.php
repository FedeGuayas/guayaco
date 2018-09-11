<?php

namespace App\Http\Controllers;

use App\Categoria;
use App\Circuito;
use App\Comprobante;
use App\Cuenta;
use App\Inscripcion;
use App\Persona;
use App\Talla;
use Gate;
use Session;
use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use App\Escenario;
use App\User;
use Illuminate\Support\Facades\Redirect;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade as PDF;


class ComprobanteController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('administrador', ['only' => 'destroy']);
    }

    /**
     * Muestra la lista de los comprobantes
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $escenarioSelect = ['' => 'Seleccione el escenario'] + Escenario::lists('escenario', 'id')->all();
        $usuarioSelect = ['' => 'Seleccione el usuario'] + User::lists('nombre', 'id')->all();
        if ($request) {
            $query = trim($request->get('searchText'));
            $fecha = $request->get('fecha');
            $escenario = $request->get('escenario');
            $usuario = $request->get('usuario');
            $pagos = DB::table('comprobantes as c')
                ->join('users as u', 'u.id', '=', 'c.user_id')
                ->join('escenarios as e', 'e.id', '=', 'u.escenario_id')
                ->join('inscripciones as i', 'i.id', '=', 'c.inscripcion_id')
                ->select('c.id as comp_id', 'c.nombres', 'c.apellidos', 'c.num_doc', 'i.costo', 'c.email', 'c.telefono', 'c.direccion', 'e.id', 'u.id',
                    'c.created_at as fecha', 'i.form_pago', 'i.escenario', 'u.nombre as usuario', 'i.num_corredor as numero', 'c.user_id', 'c.cuenta_id')
                ->where('c.created_at', 'LIKE', '%' . $fecha . '%')
                ->where('e.id', 'LIKE', '%' . $escenario . '%')
                ->where('c.num_doc', 'LIKE', '%' . $query . '%')
//                ->where(function ($q) use ($fecha, $escenario, $query, $usuario) {
//                    $q
//                        ->where('c.num_doc','LIKE','%'.$query.'%')
//                        ->where([
//                            ['c.created_at', 'LIKE', '%' . $fecha . '%'],
//                            ['e.id', 'LIKE', '%' . $escenario . '%'],
//                            ['c.num_doc', 'LIKE', '%' . $query . '%']
//                        ]);
//                        ->where('u.id', 'LIKE', '%' . $usuario . '%');

//                })
//                ->orWhere(function ($q) use ($usuario) {
//                    $q
//                        ->where('u.id', '=', $usuario);
//                        ->orWhere('u.id', 'LIKE', '%' . $usuario . '%');
//                })

//                ->where('u.id',$usuario)
//                ->where('u.id', '=', $usuario)
//

                ->orderBy('c.id', 'desc')
                ->paginate(5);
//                ->toSql();
//            dd($pagos);
        }

        return view('runner.comprobantes.index', compact('pagos', 'escenarioSelect', 'usuarioSelect', 'usuario', 'escenario', 'fecha', 'query'));
    }

    /**
     * Para cargar la vista que va a editar los comprovantes, en este caso hace la funcion del edit
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $comprobante = Comprobante::findOrFail($id);
        $cuenta_id = $comprobante->cuenta_id;
        $cuenta = Cuenta::find($cuenta_id);
        return view('runner.comprobantes.show', compact('comprobante', 'cuenta'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $comprobante = Comprobante::findOrFail($id);

        if (Gate::denies('update', $comprobante)) {//politica solo puede actualizar su comprobante acceso denegado
            abort(403);
        }

        $user_id = $comprobante->user_id;
        $comprobante->user()->associate($user_id);
        $inscripcion_id = $comprobante->inscripcion_id;
        $comprobante->inscripcion()->associate($inscripcion_id);
        $cuenta_id = $comprobante->cuenta_id;
        $comprobante->cuenta()->associate($cuenta_id);
        $comprobante->nombres = $request->get('comp_nombres');
        $comprobante->apellidos = $request->get('comp_apellidos');
        $comprobante->num_doc = $request->get('comp_documento');
        $comprobante->telefono = $request->get('comp_telefono');
        $comprobante->email = $request->get('comp_email');
        $comprobante->direccion = $request->get('comp_direccion');
        $comprobante->update();

        Session::flash('message', 'Comprobante editado correctamente');
        return Redirect::to('runner/pagos');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $comprobante = Comprobante::findOrFail($id);
        $comprobante->delete();

        Session::flash('message', 'Comprobante eliminado correctamente');
        return Redirect::to('runner/pagos');
    }

    public function pagoPDF($id)
    {
        $comprobante = Comprobante::findOrFail($id);
        $inscripcion_id = $comprobante->inscripcion_id;
        $inscripcion = Inscripcion::findOrFail($inscripcion_id);
        if (isset($inscripcion->talla)){
            $talla=Talla::findOrFail($inscripcion->talla);
        }else {
            $talla='';
        }

        $user_id = $comprobante->user_id;
        $user = User::findOrFail($user_id);
        $cuenta_id = $comprobante->cuenta_id;
        $cuenta = Cuenta::findOrFail($cuenta_id);
        $persona_id = $inscripcion->persona_id;
        $persona = Persona::findOrFail($persona_id);
        $circuito_id = $inscripcion->circuito_id;
        $circuito = Circuito::findOrFAil($circuito_id);
        $categoria_id = $inscripcion->categoria_id;
        $categoria = Categoria::findOrFAil($categoria_id);
        $escenario_id = $user->escenario_id;
        $escenario = Escenario::findOrFail($escenario_id);

        $pdf = PDF::loadView('runner.comprobantes.reportes.pdf', compact('comprobante', 'inscripcion', 'user', 'escenario',
            'cuenta', 'persona', 'circuito', 'categoria','talla'));
        return $pdf->download('ComprobantePago.pdf');
    }

    public function cuadre(Request $request)
    {
        $escenarioSelect = ['' => 'Seleccione el escenario'] + Escenario::lists('escenario', 'id')->all();
        $usuarioSelect = ['' => 'Seleccione el usuario'] + User::lists('nombre', 'id')->all();
        if ($request) {
            $fecha = $request->get('fecha');
            $escenario = $request->get('escenario');
            $usuario = $request->get('usuario');
            $cuadre = Inscripcion::
            join('users as u', 'u.id', '=', 'inscripciones.user_id')
                ->join('escenarios as e', 'e.id', '=', 'u.escenario_id')
                ->select('costo', 'e.id as eid', 'u.id as uid', 'inscripciones.created_at as fecha', 'u.nombre', 'e.escenario')
                ->where('inscripciones.created_at', 'LIKE', '%' . $fecha . '%')
                ->where('e.id', 'LIKE', '%' . $escenario . '%')
                ->orWhere('u.id', '=', $usuario)
                ->groupBy('u.id')
                ->get();

            $cuadreArray = array();
            foreach ($cuadre as $c) {
                $cuadreArray[] = [
                    'nombre' => $c->nombre,
                    'cantidad' => Inscripcion::where('user_id', $c->uid)->where('fecha_insc', 'LIKE', '%' . $fecha . '%')->count(),
                    'valor' => Inscripcion::where('user_id', $c->uid)->where('fecha_insc', 'LIKE', '%' . $fecha . '%')->sum('costo'),
                ];
            }
        }

        return view('runner.comprobantes.cuadre', compact('escenarioSelect', 'usuarioSelect', 'escenario', 'usuario', 'fecha', 'cuadreArray'));
    }


    public function comprobantesExcel(Request $request)
    {
        $escenarioSelect = ['' => 'Seleccione el escenario'] + Escenario::lists('escenario', 'id')->all();
        $usuarioSelect = ['' => 'Seleccione el usuario'] + User::lists('nombre', 'id')->all();
        if ($request) {
            $fecha = $request->get('fecha');
            $escenario = $request->get('escenario');
            $usuario = $request->get('usuario');
            $comprobantes = DB::table('comprobantes as c')
                ->join('users as u', 'u.id', '=', 'c.user_id')
                ->join('escenarios as e', 'e.id', '=', 'u.escenario_id')
                ->join('inscripciones as i', 'i.id', '=', 'c.inscripcion_id')
                ->select('c.id as comp_id', 'c.nombres', 'c.apellidos', 'c.num_doc', 'c.email', 'c.telefono', 'c.direccion', 'e.id', 'u.id', 'i.costo',
                    'c.created_at as fecha1', 'i.form_pago', 'i.escenario', 'u.nombre as usuario', 'i.num_corredor as numero', 'c.user_id', 'c.cuenta_id')
                ->where('c.created_at', 'LIKE', '%' . $fecha . '%')
                ->where('e.id', 'LIKE', '%' . $escenario . '%')
                ->where('u.id', 'LIKE', '%' . $usuario . '%')
                ->where('form_pago', '<>', '')
                ->get();

//            $comprobantesArray[] = ['Número', 'Nombres', 'Apellidos', 'CI', 'Correo', 'Teléfono', 'Dirección', 'Costo', 'Forma Pago', 'Escenario', 'Usuario', 'Fecha'];

            $comprobantesArray[] = ['codigopadre', 'codigo', 'nombre', 'nombrecomercial', 'RUC', 'Fecha', 'Referencia', 'Comentario',
                'CtaIngreso', 'Cantidad', 'Valor', 'Iva', 'DIRECCION', 'division', 'TipoCli', 'actividad', 'codvend', 'recaudador',
                'formadepago', 'estado', 'diasplazo', 'precio', 'telefono', 'fax', 'celular', 'e_mail', 'pais', 'provincia', 'ciudad',
                'CtaxCob', 'CtaxAnt', 'cupo', 'empresasri'
            ];

            foreach ($comprobantes as $comp) {
//                $comprobantesArray[] = [
//                    'num' => $comp->numero,
//                    'nombres' => $comp->nombres,
//                    'apellidos' => $comp->apellidos,
//                    'ci' => $comp->num_doc,
//                    'email' => $comp->email,
//                    'telefono' => $comp->telefono,
//                    'direccion' => $comp->direccion,
//                    'valor' => $comp->costo,
//                    'forma_pago' => $comp->form_pago,
//                    'escenario' => $comp->escenario,
//                    'usuario' => $comp->usuario,
//                    'fecha_i' => $comp->fecha1,
//                ];

                $ruc = $comp->num_doc;

                if ( validaRUC($ruc) === "OK") {
                    $ruc = $comp->num_doc;
                } elseif ( validaRUC($ruc) === "CF" || validaRUC($ruc) == "El formato es incorrecto") {
                    $ruc=999999999;
                }

                $comprobantesArray[] = [
                    'codigopadre' => '',
                    'codigo' => '',
                    'nombre' => $comp->nombres . ' ' . $comp->apellidos,
                    'nombrecomercial' => $comp->nombres . ' ' . $comp->apellidos,
                    'RUC' => floatval($ruc),
//                    'Fecha' => substr(str_replace('-','/',$comp->fecha1), 0, 10),
                    'Fecha' => $comp->fecha1,
                    'Referencia' => 'PAGO POR INSCRIPCIÓN EN CARRERA GUAYACO RUNNER 2017',
                    'Comentario' => 'GUAYACORUNNER',
                    'CtaIngreso' => '6252499004001',//Actualizar esto 6252499004001
                    'Cantidad' => 1,
                    'Valor' => (float)$comp->costo,
                    'Iva' => 'S',
                    'DIRECCION' => 'GUAYAQUIL',
                    'division' => 2004,
                    'TipoCli' => 1,
                    'actividad' => 1,
                    'codvend' => '',
                    'recaudador' => '',
                    'formadepago' => $comp->form_pago,
                    'estado' => 'A',
                    'diasplazo' => 1,
                    'precio' => 1,
                    'telefono' => 'NO',
                    'fax' => '',
                    'celular' => '',
                    'e_mail' => $comp->email,
                    'pais' => 1,
                    'provincia' => 1,
                    'ciudad' => 4,
                    'CtaxCob' => '1110101001',
                    'CtaxAnt' => '210307999',
                    'cupo' => 500,
                    'empresasri' => 'PERSONAS NO OBLIGADAS A LLEVAR CONTABILIDAD, FACTURA',
                ];
            }

            Excel::create('Comprobantes Excel', function ($excel) use ($comprobantesArray) {

                $excel->sheet('Comprobantes', function ($sheet) use ($comprobantesArray) {

                    $sheet->setColumnFormat([
                        'A' => 'General',
                        'B' => 'General',
                        'C' => 'General',
                        'D' => 'General',
                        'E' => '0',
                        'F' => 'dd/mm/yyyy;@',
                        'I' => '@',
                        'K' => '#,##0.00_-',
                        'N' => '0',
                        'O' => '0',
                        'P' => '0',
                        'U' => '0',
                        'V' => '0',
                        'AA' => '0',
                        'AB' => '0',
                        'AC' => '0',
                        'AF' => '#,##0.00_-',
                        'AD' => 'General',
                        'AE' => 'General'
                    ]);

                    $sheet->fromArray($comprobantesArray, null, 'A1', false, false);

                });
            })->export('xlsx');

//            return view('runner.comprobantes.index', compact('comprobantes', 'fechaD', 'fechaH', 'escenario', 'escenarioSelect'));
        }
    }
}