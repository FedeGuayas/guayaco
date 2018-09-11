<?php

namespace App\Http\Controllers;

use App\Chip;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Requests;
use Session;
use DB;

class ChipsController extends Controller
{

    public function getChip()
    {
        return view('runner/inscripciones/reportes/importarChip');
    }
    
    
    public function postChip(Request $request)
    {

        if ($request->file('chip')){
//            $file=$request->file('chip');
//            $name=$file->getClientOriginalName();
            Excel::load(Input::file('chip'), function($reader) {

                foreach ($reader->get() as $chip) {
                    Chip::create([
                        'num_doc' => $chip->num_doc,
                        'chip' =>$chip->chip
                    ]);
                }
            });

            Session::flash('message','Se importaron los datos');
        }else{
            Session::flash('message','Error al Importar');
        }
        return redirect()->route('runner.inscripciones.kit');
    }

    public function truncateChip()
    {
        DB::table('chips')->delete();

        Session::flash('message','Tabla chips vaciada');
        return redirect()->route('runner.inscripciones.kit');
    }

}
