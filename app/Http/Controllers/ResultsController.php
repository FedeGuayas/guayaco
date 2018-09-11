<?php

namespace App\Http\Controllers;

ini_set('max_execution_time', 300); //5 minutes

use App\Result;
use Illuminate\Http\Request;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Input;
use Maatwebsite\Excel\Facades\Excel;
use DB;
use Yajra\Datatables\Datatables;
use Barryvdh\DomPDF\Facade as PDF;


class ResultsController extends Controller
{
    public function __construct(){

        $this->middleware('administrador', ['only' =>[ 'destroy','getResult','store','truncate']]);

    }


    /**
     * Mostrar vista de importar excel de resultados.
     *
     */
    public function getResult()
    {
        return view('runner.results.import');
    }

    /**
     * almacenar el ecel importado en la bd.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
        if ($request->file('result')){
//            $file=$request->file('chip');
//            $name=$file->getClientOriginalName();
            Excel::load(Input::file('result'), function($reader) {

                foreach ($reader->get() as $result) {
                    Result::create([
                        'first_name'=> $result->first_name,
                        'second_name' =>$result->second_name,
                        'last_name' =>$result->last_name,
                        'sex' =>$result->sex,
                        'category' =>$result->category,
                        'circuit' =>$result->circuit,
                        'chip' =>$result->chip,
                        'place' =>$result->place,
                        'time' =>$result->time
                    ]);
                }
            });
            Session::flash('message','Se importaron los datos');
        }else{
            Session::flash('message','Error al Importar');
        }
        return redirect()->route('result.index');
    }


    /**
     * Vaciar la tabla de la bd
     * @return
     */

    public function truncate()
    {
        DB::table('results')->delete();

        Session::flash('message','Tabla resultados vaciada');
        return redirect()->route('result.index');
    }


    /**
     * Muestro la vista de los resultados
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $results=Result::all();
        return view('runner.results.index',['results'=>$results]);
    }



    /**
     * Para mostrar la vista si la peticion es a api/result
     *
     * @return \Illuminate\View\View
     */
//    public function getIndex()
//    {
//        return view('runner.results.datatables.index');
//    }

    /**
     * Process datatables ajax request.
     *
     * @return \Illuminate\Http\JsonResponse
     */
//    public function anyData()
//    {
//        $result = Result::all();
//        return Datatables::of($result)->addColumn('action', function ($result) {
//            return '<a href="#edit-'.$result->id.'" class="btn btn-xs btn-warning" data-toggle="tooltip" data-placement="top" title="Diploma"><i class="fa fa-certificate" aria-hidden="true"></i></a>';
//        })
//            ->editColumn('id', 'ID: {{$id}}')
//            ->removeColumn('password')
//            ->make(true);
//    }

    /**
     * Generar el pdf con el diploma
     * @param $id
     * @return mixed
     */

    public function getDiploma($id)
    {

        $result = Result::findOrFail($id);
//        dd($result);

        $pdf = PDF::loadView('runner.results.pdf', compact('result'))
        ->setPaper('a4', 'landscape')->setWarnings(false);
        return $pdf->stream('DiplomaGuayaco2016.pdf');
    }

}
