<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use DB;

use App\Inscripcion;
use Maatwebsite\Excel\Facades\Excel;

class ExcelController extends Controller
{

    public function __construct(){
        $this->middleware('auth');
        $this->middleware('administrador');
    }

    
    
    public function index()
    {

       

        return view('runner.incripciones.index');
    }

}

//
//public function index()
//{
//
//    Excel::create('Laravel Excel', function($excel) {
//
//        $excel->sheet('IIII', function($sheet) {
//
//            $products = Inscripcion::all();
//
//            $sheet->fromArray($products);
//
//        });
//    })->export('xls');
//
//}}