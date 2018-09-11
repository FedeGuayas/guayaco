<?php

namespace App\Http\Controllers;


use App\Chip;
use App\Comprobante;
use App\Historico;
use App\Inscripcion;
use App\Result;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Http\Requests;

class ConfigController extends Controller
{
    public function __construct()
    {

        $this->middleware('administrador');

    }

    /**
     * Muestra el formulario donde se hace el cierre
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('runner.config.index');
    }

    public function postCierre(Request $request)
    {
        $year_now = Carbon::now()->year;
        $year = $request->input('year');

        if ($year == '') {
            return redirect()->route('runner.config.index')->withInput()->with('message_danger', 'Seleccione el año para el cierre');
        }
        if (strlen($year) < 4) {
            return redirect()->route('runner.config.index')->withInput()->with('message_danger', 'Formato de año incorrecto, debe escribir el año en el formato siguiente ejemplo: 2016');
        }
        if ($year > $year_now) {
            return redirect()->route('runner.config.index')->withInput()->with('message_danger', 'El año no puede ser superior al año actual');
        }

        $historico = Historico::where('year', $year)->first();

        if (count($historico) > 0) {
            return redirect()->route('runner.config.index')->withInput()->with('message_danger', 'No se puede hacer el cierre porque ya ha sido realizado para el año ' . $year);
        }

        $cierre = DB::table('inscripciones as i')
            ->join('personas as p', 'p.id', '=', 'i.persona_id')
            ->join('categorias as cat', 'cat.id', '=', 'i.categoria_id')
            ->join('circuitos as cir', 'cir.id', '=', 'i.circuito_id')
            ->leftJoin(DB::raw('(SELECT r.chip,r.place,r.time,ch.num_doc FROM results as r INNER JOIN chips as ch on ch.chip=r.chip) res'), function ($join) {
                $join->on('res.num_doc', '=', 'p.num_doc');
            })
            ->select('p.num_doc', 'p.nombres', 'p.apellidos', 'p.fecha_nac', 'p.genero', 'p.email', 'p.direccion', 'p.telefono', 'cat.categoria', 'cir.circuito', 'i.costo', 'res.chip', 'res.place', 'res.time')
            ->get();

        if (count($cierre) < 1) {
            return redirect()->route('runner.config.index')->withInput()->with('message_danger', 'Ocurrio un error al realizar la consulta a la bbdd');
        }

        //Insertar el cierre en la tabla historico
        $insert = [];
        try {
            DB::beginTransaction();
            foreach ($cierre as $key => $value) {
                if ($value->time != '') {
                    $insert[] = [
                        "num_doc" => $value->num_doc,
                        "nombres" => $value->nombres,
                        "apellidos" => $value->apellidos,
                        "fecha_nac" => $value->fecha_nac,
                        "sex" => $value->genero,
                        "email" => $value->email,
                        "direccion" => $value->direccion,
                        "telefono" => $value->telefono,
                        "category" => $value->categoria,
                        "circuit" => $value->circuito,
                        "chip" => $value->chip,
                        "place" => $value->place,
                        "time" => $value->time,
                        "year" => $year,
                        "costo" => $value->costo,
                    ];
                }
            }

            if (!empty($insert)) {
                $guardar = DB::table('historicos')->insert($insert);
                var_dump($guardar);
                if ($guardar) {
                    DB::statement('SET FOREIGN_KEY_CHECKS=0');
                    Inscripcion::truncate();
                    Chip::truncate();
                    Comprobante::truncate();
                    Result::truncate();
                }
            } else {
                return redirect()->route('runner.config.index')->with('message_danger', 'No se encontro nada para insertar');
            }

            DB::commit();
            return redirect()->route('runner.config.index')->with('message', 'Se realizo el cierre del año ' . $year . ' correctamente');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('runner.config.index')->with('message_danger',$e->getMessage());
//                'Ocurrio un error y no se pudo realizar el cierre del año ' . $year);
            //$e->getMessage(),
        }



//        return view('runner.config.index');
    }


}
