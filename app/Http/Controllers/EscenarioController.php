<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Session;
use App\Escenario;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\EscenarioFormRequest;
use DB;


class EscenarioController extends Controller
{


    public function __construct(){
        $this->middleware('auth');
        $this->middleware('administrador');
    }
    
    public function index(Request $request){
        if ($request) {
            $buscar=trim($request -> get('searchText'));
            $escenarios_select=DB::table('escenarios') -> where ('escenario','LIKE','%'.$buscar.'%')
                -> orderBy ('id','desc')
                -> paginate(10);
            return view ('runner.escenarios.index',["escenarios"=>$escenarios_select,"searchText"=>$buscar]);
        }
    }

    /**
     * Show the form for creating a new resource.
     * @return \Illuminate\Http\Response
     */

    public function create(){
        return view ("runner.escenarios.create");
    }

    /**
     * Store a newly created resource in storage.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(EscenarioFormRequest $request){

        $escenario=new Escenario;
        $escenario->escenario=strtoupper($request->get('escenario'));
        $escenario->save();
        Session::flash('message','Escenario creado correctamente');
        return Redirect::to('runner/escenarios');
    }

    /**
     * Show the form for editing the specified resource.
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function edit($id){
        return view ('runner.escenarios.edit',["escenarios"=>Escenario::findOrFail($id)]);
    }

    /**
     * Update the specified resource in storage.
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function update(EscenarioFormRequest $request, $id){
        $escenario=Escenario::findOrFail($id);
        $escenario->escenario=strtoupper($request->get('escenario'));
        $escenario->update();
        Session::flash('message','Escenario actualizado correctamente');
        return Redirect::to('runner/escenarios');
    }

    /**
     * Remove the specified resource from storage.
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function destroy($id){
        $escenarios=Escenario::findOrFail($id);
        $escenarios->delete();
        Session::flash('message','Escenario eliminado correctamente');
        return Redirect::to('runner/escenarios');
    }
}
