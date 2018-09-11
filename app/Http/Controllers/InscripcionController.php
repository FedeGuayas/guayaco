<?php

namespace App\Http\Controllers;

use App\Categoria;
use App\Circuito;
use App\Comprobante;
use App\Cuenta;
use App\Deporte;
use App\Deudore;
use App\Escenario;
use App\Inscripcion;

use App\Persona;
use App\Talla;
use App\User;
use Faker\Provider\lv_LV\Person;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Validator;
use Session;
use App\Http\Requests\InscripcionFormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade as PDF;
use DB;

use Illuminate\Support\Str;

use Illuminate\Support\Facades\Gate;


class InscripcionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
//        $this->middleware('administrador', ['only' => 'destroy']);

    }

    /**
     * Display a listing of the resource.
     * Muestra una lista de los recursos
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
            $inscripcion = DB::table('inscripciones as i')
                ->join('users as u', 'u.id', '=', 'i.user_id')
                ->join('personas as p', 'p.id', '=', 'i.persona_id')
                ->join('categorias as cat', 'cat.id', '=', 'i.categoria_id')
                ->join('circuitos as c', 'c.id', '=', 'i.circuito_id')
                ->join('escenarios as e', 'e.id', '=', 'u.escenario_id')
                ->join('comprobantes as comp', 'comp.inscripcion_id', '=', 'i.id')
                ->select('p.nombres', 'p.apellidos', 'p.num_doc', 'p.genero', 'i.edad', 'cat.categoria', 'c.circuito',
                    'i.num_corredor', 'i.talla', 'i.recomendado', 'i.costo', 'i.created_at as fecha',
                    'u.nombre as user', 'e.escenario as esc',
                    'i.user_id', 'i.id', 'e.id as eid', 'u.id as uid', 'i.created_at',
                    'comp.nombres as nombresf', 'comp.apellidos as apellidosf', 'comp.num_doc as cedula',
                    'comp.email as emailf', 'comp.telefono as telefonof', 'comp.direccion as direccionf',
                    'i.form_pago')
                ->where('p.num_doc', 'LIKE', '%' . $query . '%')
                ->orWhere('p.nombres', 'LIKE', '%' . $query . '%')
                ->orWhere('p.apellidos', 'LIKE', '%' . $query . '%')

//                ->Where('i.num_corredor', 'LIKE', '%' . $query . '%')
//                ->Where([
//                    ['u.id','=',"$usuario"],
//                ])
//                ->Where([
//                    ['e.id', 'LIKE', "%$escenario%"],
//                    ['i.created_at', 'LIKE', '%' . $fecha . '%'],
//                ])
                ->orderBy('i.id', 'desc')
                ->paginate(7);

            return view('runner.inscripciones.index', compact('escenarioSelect', 'usuarioSelect', 'usuario', 'escenario', 'fecha', 'inscripcion', 'query'));
        }

    }


    /**
     * Show the form for creating a new resource.
     * Mostrar el formulario para crear un nuevo recurso
     * @return \Illuminate\Http\Response
     */
    public function create($persID)
    {
        $persona = Persona::findOrFail($persID);

        $deudor = Deudore::where('num_doc', $persona->num_doc)->first();

        $deuda = 0;
        $chip_deuda = '';
        if (count($deudor) > 0) {
            $deuda = 3;
            $chip_deuda = $deudor->chip;
        }

        $categoria = ['' => 'Seleccione la categoría'] + Categoria::where('estado', '1')->lists('categoria', 'id')->all();
        $circuito = ['' => 'Seleccione el circuito'] + Circuito::where('estado', '1')->lists('circuito', 'id')->all();
        $tallas = Talla::where('status', Talla::TALLA_DISPONIBLE)->select(DB::raw('concat (talla," - ",color) as talla,id'))->get();
        $talla = ['' => 'Talla...'] + $tallas->lists('talla', 'id')->all();
//        $talla = ['' => 'Talla...'] + Talla::where('status', Talla::TALLA_DISPONIBLE)->lists('talla', 'id')->all();

        $deporte = ['' => 'Seleccione el deporte'] + Deporte::lists('deporte', 'id')->all();
        $cuenta = Cuenta::find(1);

        $edad = $persona->getEdad('fecha_nac');

        return view('runner.inscripciones.create', ["categoria" => $categoria, "circuito" => $circuito,
            "persona" => $persona, "edad" => $edad, "cuenta" => $cuenta, "deporte" => $deporte, "talla" => $talla, "deuda" => $deuda, "chip_deuda" => $chip_deuda]);

    }


    /**
     * Store a newly created resource in storage.
     * Para almacenar un recurso recien creado
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */


    public function store(InscripcionFormRequest $request)
    {

        try {
            DB::beginTransaction();

            //Utilizar este metodo sino exite limitacion con los chips
//            $numcorredor = DB::table('inscripciones')->max('num_corredor') + 1;

            //BEGIN PARA LIMITAR LOS NUMEROS DE CORREDOR POR PROBLEMAS CON CHIPS
            $max_num_corredor = DB::table('inscripciones')->max('num_corredor');

            //num de chip tope
            $max_permitido=2404;

            //si se llega al ultimo numero de chip
            if ($max_num_corredor===$max_permitido){

                //obtengo un contador almacenado en una tabla temporal
                $contador_temp = DB::table('inscripciones_temp')->where('id',1)->first();

                //restando al num maximo de chip e contador se obtiene el numero deseado de chip
                $numcorredor=$max_permitido-$contador_temp->cont;

                //actualizo el cont temporal decrementandolo en 1
                DB::table('inscripciones_temp')->decrement('cont');

            } else {
                $numcorredor=$max_num_corredor + 1;
            }

            if ($max_num_corredor > $max_permitido){
                return back()->withInput()->with('message_danger', 'Ocurrió un error con el numero del corredor');
            }
            //END PARA LIMITAR LOS NUMEROS DE CORREDOR POR PRONLEMAS CON CHIPS LIMITADOS


            $persona_id = $request->get('persona_id');
            $categoria_id = $request->get('categoria_id');
            $circuito_id = $request->get('circuito_id');
            $deporte_id = $request->get('deporte_id');
            $user_id = $request->get('user_id');
            $talla_id = $request->input('talla');
            $form_pago = $request->get('form_pago');

            $deuda = $request->get('chip_deuda');

            if ($deuda != '') {
                $deudor = Deudore::where('chip', $deuda)->first();
                $deudor->delete();
            }

            $cuenta_id = Cuenta::findOrFail(1);

            $inscripcion = new Inscripcion;
            $inscripcion->persona()->associate($persona_id);
            $inscripcion->categoria()->associate($categoria_id);
            $inscripcion->circuito()->associate($circuito_id);
            $inscripcion->user()->associate($user_id);
            $inscripcion->deporte()->associate($deporte_id);
//            $inscripcion->deporte();//para que permita nulo
            $inscripcion->fecha_insc = $request->get('fecha_insc');
            $inscripcion->edad = $request->get('edad');
            $inscripcion->kit = '1'; //1= no se ha retirado el kit
            $inscripcion->escenario = $request->get('escenario');
            $inscripcion->recomendado = $request->get('recomendado') == '' ? '' : $request->get('recomendado');
            $inscripcion->costo = $request->get('costo');
            $inscripcion->form_pago = isset($form_pago) ? $form_pago : '';
            $inscripcion->num_corredor = $numcorredor;

            if (isset($talla_id) && !isset($deporte_id)) {

                $talla = Talla::findOrFail($talla_id);

                if ($talla->stock <= 0) {
                    return back()->withInput()->with('message_danger', 'No hay disponibilidad de camisetas');
                }

                $nuevo_stock = $talla->stock - 1;

                if ($nuevo_stock < 0) {
                    return back()->withInput()->with('message_danger', 'No hay disponibilidad de camisetas');
                }
                if ($nuevo_stock <= 0) {
                    $talla->status = Talla::TALLA_NO_DISPONIBLE;
                } else {
                    $talla->status = Talla::TALLA_DISPONIBLE;
                }

                $inscripcion->talla = $talla->id;

                $talla->stock = $nuevo_stock;

                $talla->update();
            } else {
                $inscripcion->talla = $talla_id;
            }

            $inscripcion->save();

            $comprobante = new Comprobante;
            $comprobante->inscripcion()->associate($inscripcion);
            $comprobante->user()->associate($user_id);
            $comprobante->cuenta()->associate($cuenta_id);
            $comprobante->nombres = strtoupper($request->get('comp_nombres'));
            $comprobante->apellidos = strtoupper($request->get('comp_apellidos'));
            $comprobante->num_doc = $request->get('comp_documento');
            $comprobante->telefono = $request->get('comp_telefono');
            $comprobante->email = $request->get('comp_email');
            $comprobante->direccion = strtoupper($request->get('comp_direccion'));
            $comprobante->save();

            DB::commit();

        } catch (\Exception $e) {
            DB::rollback();
//            Session::flash('message_danger', 'Error! al guardar los datos');
            Session::flash('message_danger', $e->getMessage());
            return back()->withInput();
        }

        Session::flash('message', 'Inscripción y comprobante creados correctamente');
        return Redirect::to('runner/pagos');
    }


    /**
     * Display the specified resource.
     * Visualizar el recurso especificado por ejemplo detalles de usuario con un boton
     * @param  int $id
     * @return \Illuminate\Http\Response
     */

    public function show($id)
    {
        $inscripcion = Inscripcion::findOrFail($id);
        return view('runner.inscripciones.show', ["inscripcion" => $inscripcion]);
    }

    /**
     * Show the form for editing the specified resource.
     *Mostrar el formulario para editar el recurso especificado
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $inscripcion = Inscripcion::findOrFail($id);
        $persona_id = $inscripcion->persona_id;

        $categoria = ['' => 'Seleccione la categoría'] + Categoria::where('estado', '1')->lists('categoria', 'id')->all();
        $circuito = ['' => 'Seleccione el circuito'] + Circuito::where('estado', '1')->lists('circuito', 'id')->all();
        $deporte = ['' => 'Seleccione el deporte'] + Deporte::lists('deporte', 'id')->all();
        $tallas = Talla::select(DB::raw('concat (talla," - ",color) as talla,id'))->get();
        $talla = ['' => 'Talla...'] + $tallas->lists('talla', 'id')->all();

        $persona = Persona::findOrFail($persona_id);

        $ins_id = $inscripcion->id;

        $comprobante = Comprobante::where('inscripcion_id', $ins_id)->first();

        $cuenta_id = $comprobante->cuenta_id;
        $cuenta = Cuenta::findOrFail($cuenta_id);

        $edad = $inscripcion->edad;


        return view('runner.inscripciones.edit', compact('inscripcion', 'categoria', 'circuito', 'persona', 'edad', 'deporte', 'cuenta', 'comprobante', 'talla'));
    }


    /**
     * Update the specified resource in storage.
     * Actualizar el recurso especificado en el almacenamiento
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $inscripcion = Inscripcion::findOrFail($id);
        //solo puede actualizar su inscripcion
        if (Gate::denies('update', $inscripcion)) {//policy definida en Policies\InscripcionPolicy
            abort(403);
        }

        try {
            DB::beginTransaction();
            $persona_id = $inscripcion->persona_id;
            $categoria_id = $request->get('categoria_id');
            $circuito_id = $request->get('circuito_id');
            $deporte_id = $request->get('deporte_id');
            $talla_id = $request->get('talla');
            $form_pago = $request->get('form_pago');
            $user_id = $inscripcion->user_id;

            $inscripcion->persona()->associate($persona_id);
            $inscripcion->categoria()->associate($categoria_id);
            $inscripcion->circuito()->associate($circuito_id);
            $inscripcion->user()->associate($user_id);
            $inscripcion->deporte()->associate($deporte_id);

            //  $inscripcion->deporte();//para que permita nulo
            //  $inscripcion->fecha_insc = $inscripcion->fecha_insc;

//            $inscripcion->edad = $request->get('edad');
//            $inscripcion->kit = '1';

            //cambio de una talla por otra pero no se cambio a deportista
            if (isset($talla_id) && isset($inscripcion->talla) && !isset($deporte_id)) {

                //talla actual a actualizar si cambio la talla
                $talla_actual = Talla::findOrFail($talla_id);

                if ($talla_actual->stock <= 0) {
                    return back()->withInput()->with('message_danger', 'No hay disponibilidad de camisetas');
                }
                $nuevo_stock = $talla_actual->stock - 1;
                if ($nuevo_stock < 0) {
                    return back()->withInput()->with('message_danger', 'No hay disponibilidad de camisetas');
                } elseif ($nuevo_stock == 0) {
                    $talla_actual->status = Talla::TALLA_NO_DISPONIBLE;
                } elseif ($nuevo_stock > 0) {
                    $talla_actual->status = Talla::TALLA_DISPONIBLE;
                }
                $talla_actual->stock = $nuevo_stock;
                $talla_actual->update();

                //actualizo el stock de la talla anterior
                $talla_anterior = Talla::where('id', $inscripcion->talla)->first();
                $stock_anterior = $talla_anterior->stock + 1;
                if ($stock_anterior > 0) {
                    $talla_anterior->status = Talla::TALLA_DISPONIBLE;
                } else {
                    $talla_anterior->status = Talla::TALLA_NO_DISPONIBLE;
                }
                $talla_anterior->stock = $stock_anterior;
                $talla_anterior->update();

                $inscripcion->talla = $talla_actual->id;
            }

            //tenia talla y se cambio a deportista
            if (!isset($talla_id) && $talla_id != $inscripcion->talla && isset($deporte_id) && isset($inscripcion->talla)) {
                //actualizo el stock de la talla anterior
                $talla_anterior = Talla::where('id', $inscripcion->talla)->first();
                $stock_anterior = $talla_anterior->stock + 1;
                if ($stock_anterior > 0) {
                    $talla_anterior->status = Talla::TALLA_DISPONIBLE;
                } else {
                    $talla_anterior->status = Talla::TALLA_NO_DISPONIBLE;
                }
                $talla_anterior->stock = $stock_anterior;
                $talla_anterior->update();

                $inscripcion->talla = null;
            }

            //era deportista y se cambio a una talla
            if (isset($talla_id) && !isset($inscripcion->talla) && !isset($deporte_id)) {
                //actualizo el stock de la talla anterior

                $talla_actual = Talla::where('id', $talla_id)->first();
                $nuevo_stock = $talla_actual->stock - 1;
                if ($nuevo_stock < 0) {
                    return back()->withInput()->with('message_danger', 'No hay disponibilidad de camisetas');
                } elseif ($nuevo_stock == 0) {
                    $talla_actual->status = Talla::TALLA_NO_DISPONIBLE;
                } elseif ($nuevo_stock > 0) {
                    $talla_actual->status = Talla::TALLA_DISPONIBLE;
                }
                $talla_actual->stock = $nuevo_stock;
                $talla_actual->update();

                $inscripcion->talla = $talla_actual->id;
            }


            //  $inscripcion->escenario = $inscripcion->escenario;
            // $inscripcion->recomendado = $request->get('recomendado');
            $inscripcion->costo = $request->get('costo');
            $inscripcion->form_pago = isset($form_pago) ? $form_pago : '';
            $inscripcion->update();

            DB::commit();

        } catch (\Exception $e) {
            DB::rollback();
        }

        Session::flash('message', 'Inscripción editada correctamente');
        return Redirect::to('runner/inscripciones');
    }


    /**
     * Remove the specified resource from storage.
     *Quitar el recurso especificado de almacenamiento.
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $inscripcion = Inscripcion::findOrFail($id);
        if (Gate::denies('delete', $inscripcion)) {//policy definida en Policies\InscripcionPolicy
            abort(403);
        }

        if (isset($inscripcion->talla)) {
            $talla = Talla::findOrFail($inscripcion->talla);

            $talla_stock = $talla->stock + 1;
            if ($talla_stock > 0) {
                $talla->status = Talla::TALLA_DISPONIBLE;
            } else {
                $talla->status = Talla::TALLA_NO_DISPONIBLE;
            }

            $talla->stock = $talla_stock;
            $talla->update();
        }

        $inscripcion->delete();
        Session::flash('message', 'Inscripción eliminada correctamente');
        return Redirect::to('runner/inscripciones');
    }


    public function inscripcionesExcelChip(Request $request)
    {

        $queryD = trim($request->get('searchDesde'));
        $queryH = trim($request->get('searchHata'));
        $inscripciones = DB::table('inscripciones as i')
            ->join('personas as p', 'p.id', '=', 'i.persona_id')
            ->join('categorias as cat', 'cat.id', '=', 'i.categoria_id')
            ->join('circuitos as c', 'c.id', '=', 'i.circuito_id')
            ->select('p.nombres', 'p.apellidos', 'p.genero', 'p.num_doc', 'p.fecha_nac', 'p.email', 'p.telefono', 'p.direccion', 'i.num_corredor', 'cat.categoria', 'c.circuito', 'i.edad')
            ->whereBetween('num_corredor', [$queryD, $queryH])
            ->orderBy('num_corredor')
            ->get();

        $inscripcionesArray[] = ['CHIP', 'APELLIDOS', 'NOMBRES', 'CEDULA', 'FECHA DE NAC.', 'SEXO', 'EMAIL', 'TELEFONO', 'DIRECCION', 'CATEGORÍA', 'CIRCUITO'];
        foreach ($inscripciones as $insc) {


            $inscripcionesArray[] = [
                'numero' => $insc->num_corredor,
                'apellidos' => $insc->apellidos,
                'nombres' => $insc->nombres,
                'cedula' => $insc->num_doc,
                'fecha_nac' => $insc->fecha_nac,
                'sexo' => $insc->genero == 'Masculino' ? 'M' : 'F',
                'email' => $insc->email,
                'telefono' => $insc->telefono,
                'direccion' => $insc->direccion,
//                'edad' => $insc->edad,
                'categoria' => $insc->categoria,
                'circuito' => $insc->circuito,
            ];
        }

        Excel::create('Inscripciones Chips', function ($excel) use ($inscripcionesArray) {

            $excel->sheet('Chips', function ($sheet) use ($inscripcionesArray) {

                $sheet->cells('A1:K1', function ($cells) {
                    $cells->setFontWeight('bold');
                    //alineacion horizontal
                    $cells->setAlignment('center');
                    // alineacion vertical
                    $cells->setValignment('center');
                });

                $sheet->fromArray($inscripcionesArray, null, 'A1', false, false);

            });
        })->export('xlsx');
        return view('runner.inscripciones.index', ["searchDesde" => $queryD, "searchHasta" => $queryH]);
    }


    public function inscripcionesExcel(Request $request)
    {
        {
            $escenarioSelect = ['' => 'Seleccione el escenario'] + Escenario::lists('escenario', 'id')->all();
            $usuarioSelect = ['' => 'Seleccione el usuario'] + User::lists('nombre', 'id')->all();
            if ($request) {
                $fecha = $request->get('fecha');
                $escenario = $request->get('escenario');
                $usuario = $request->get('usuario');
                $inscripcion = DB::table('inscripciones as i')
                    ->join('users as u', 'u.id', '=', 'i.user_id')
                    ->join('personas as p', 'p.id', '=', 'i.persona_id')
                    ->join('categorias as cat', 'cat.id', '=', 'i.categoria_id')
                    ->join('circuitos as c', 'c.id', '=', 'i.circuito_id')
                    ->join('escenarios as e', 'e.id', '=', 'u.escenario_id')
                    ->join('comprobantes as comp', 'comp.inscripcion_id', '=', 'i.id')
                    ->select('p.nombres', 'p.apellidos', 'p.num_doc', 'p.genero', 'i.edad', 'cat.categoria', 'c.circuito',
                        'i.num_corredor', 'i.talla', 'i.recomendado', 'i.costo', 'i.created_at',
                        'u.nombre as user', 'e.escenario as esc',
                        'i.user_id', 'i.id', 'e.id as eid', 'u.id as uid',
                        'comp.nombres as nombresf', 'comp.apellidos as apellidosf', 'comp.num_doc as cedula',
                        'comp.email as emailf', 'comp.telefono as telefonof', 'comp.direccion as direccionf',
                        'i.form_pago')
                    ->where('i.created_at', 'LIKE', '%' . $fecha . '%')
                    ->where('e.id', 'LIKE', '%' . $escenario . '%')
                    ->orWhere('u.id', '=', $usuario)
                    ->orderBy('i.num_corredor')
                    ->get();

                $inscripcionArray[] = ['Número', 'Nombres ', 'Apellidos', 'CI', 'Talla', 'Color', 'Genero', 'Edad', 'Categoria', 'Circuito',
                    'Costo', 'Fecha', 'Usuario', 'Escenario', 'Nombres Fact ', 'Apellidos Fact',
                    'CI Fact', 'Correo Fact', 'Teléfono Fact', 'Dirección Fact',
                    'Forma Pago',];
                foreach ($inscripcion as $insc) {

                    $talla = $insc->talla;

                    if ($insc->talla != '' || $insc->talla != NULL) {
                        $talla_obj = Talla::where('id', $insc->talla)->first();
                        $talla = $talla_obj->talla;
                        $talla_color = $talla_obj->color;
                        $color = $talla_color == 'B' ? 'Blanca' : 'Negra';
                    } else {
                        $color = '-';
                    }

                    $inscripcionArray[] = [
                        'num' => $insc->num_corredor,
                        'nombresp' => $insc->nombres,
                        'apellidosp' => $insc->apellidos,
                        'cip' => $insc->num_doc,
                        'talla' => $talla,
                        'color' => $color,
                        'genp' => $insc->genero,
                        'edad' => $insc->edad,
                        'cat' => $insc->categoria,
                        'cir' => $insc->circuito,
//                        'rec' => $insc->recomendado,
                        'cost' => $insc->costo,
                        'fecha' => $insc->created_at,
                        'usuario' => $insc->user,
                        'esc' => $insc->esc,
                        'factname' => $insc->nombresf,
                        'apellidosf' => $insc->apellidosf,
                        'cedula' => $insc->cedula,
                        'emailf' => $insc->emailf,
                        'telefonof' => $insc->telefonof,
                        'direccionf' => $insc->direccionf,
                        'formapago' => $insc->form_pago,
                    ];
                }

                Excel::create('Inscripciones Excel', function ($excel) use ($inscripcionArray) {

                    $excel->sheet('Inscripciones', function ($sheet) use ($inscripcionArray) {

                        $sheet->fromArray($inscripcionArray, null, 'A1', false, false);

                    });
                })->export('xlsx');
            }
        }

    }


    public function kits(Request $request)
    {

        $query = trim($request->get('searchText'));
        $inscripciones = DB::table('inscripciones as i')
            ->join('personas as p', 'p.id', '=', 'i.persona_id')
//            ->join('chips as chip', 'chip.num_doc', '=', 'p.num_doc')
            ->join('categorias as cat', 'cat.id', '=', 'i.categoria_id')
            ->join('circuitos as c', 'c.id', '=', 'i.circuito_id')
            ->leftjoin('tallas as t', 't.id', '=', 'i.talla')
            ->select('p.nombres', 'p.apellidos', 'i.num_corredor', 'p.num_doc', 'cat.categoria', 'c.circuito', 'i.kit', 'i.created_at as fecha_insc', 'i.id', 'p.genero', 'i.talla', 'i.num_corredor as chip','t.talla','t.color')
            ->where('p.num_doc', 'LIKE', '%' . $query . '%')
            ->orWhere('p.nombres', 'LIKE', '%' . $query . '%')
            ->orWhere('p.apellidos', 'LIKE', '%' . $query . '%')
//            ->where('i.kit', '=', '1')
            ->orderBy('i.id', 'asc')
            ->paginate(10);

        return view('runner.inscripciones.reportes.kit', ["inscripciones" => $inscripciones, "searchText" => $query]);
    }

    public function entregarKit(Request $request, $id)
    {

        $inscripciones = Inscripcion::findOrFail($id);
        $inscripciones->kit = 0;
        $inscripciones->update();
        return Redirect::to('runner/inscripciones/kit');

    }
}
