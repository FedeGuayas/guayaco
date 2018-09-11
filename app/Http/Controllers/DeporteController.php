<?php

namespace App\Http\Controllers;

use App\Deporte;
use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests;
use DB;

class DeporteController extends Controller
{

    public function __construct(){
        $this->middleware('auth');
        $this->middleware('administrador');
    }

    /**
     * Display a listing of the resource.
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request){
        if ($request) {
            $query=trim($request -> get('searchText'));
            $deportes=DB::table('deportes') -> where ('deporte','LIKE','%'.$query.'%')
                -> orderBy ('id','desc')
                -> paginate(10);
            return view ('runner.deportes.index',["deportes"=>$deportes,"searchText"=>$query]);
        }
    }

    /**
     * Show the form for creating a new resource.
     * @return \Illuminate\Http\Response
     */

    public function create(){
        return view ("runner.deportes.create");
    }

    /**
     * Store a newly created resource in storage.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request){
        $deporte=new Deporte;
        $deporte->deporte=strtoupper($request->get('deporte'));
        $deporte->save();
        Session::flash('message','Deporte creado correctamente');
        return Redirect::to('runner/deportes');
    }

       /**
     * Show the form for editing the specified resource.
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function edit($id){
        return view ('runner.deportes.edit',["deporte"=>Deporte::findOrFail($id)]);
    }

    /**
     * Update the specified resource in storage.
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request, $id){
        $deporte=Deporte::findOrFail($id);
        $deporte->deporte=strtoupper($request->get('deporte'));
        $deporte->update();
        Session::flash('message','Deporte actualizado correctamente');
        return Redirect::to('runner/deportes');
    }

    /**
     * Remove the specified resource from storage.
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function destroy($id){
        $deporte=Deporte::findOrFail($id);
        $deporte->delete();
        Session::flash('message','Deporte eliminado correctamente');
        return Redirect::to('runner/deportes');
    }
}
