<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Session;
use App\Rol;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\RolFormRequest;
use DB;


class RolesController extends Controller
{


    public function __construct(){
        $this->middleware('auth');
        $this->middleware('administrador');
    }

    public function index(Request $request){
        if ($request) {
            $query=trim($request -> get('searchText'));
            $roles=DB::table('rols') -> where ('rol','LIKE','%'.$query.'%')
                -> orderBy ('id','desc')
                -> paginate(10);
            return view ('runner.roles.index',["roles"=>$roles,"searchText"=>$query]);
        }
    }

    /**
     * Show the form for creating a new resource.
     * @return \Illuminate\Http\Response
     */

    public function create(){
        return view ("runner.roles.create");
    }

    /**
     * Store a newly created resource in storage.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(RolFormRequest $request){

        $rol=new Rol;
        $rol->rol=$request->get('rol');
        $rol->save();
        Session::flash('message','Rol creado correctamente');
        return Redirect::to('runner/roles');
    }

    /**
     * Display the specified resource.
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function show($id){
        $rol=Rol::findOrFail($id);
        return view ('runner.roles.show',["rol"=>$rol]);
    }

    /**
     * Show the form for editing the specified resource.
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function edit($id){
        $rol=Rol::findOrFail($id);
        return view ('runner.roles.edit',["rol"=>$rol]);
    }

    /**
     * Update the specified resource in storage.
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function update(RolFormRequest $request, $id){
        $rol=Rol::findOrFail($id);
        $rol->rol=$request->get('rol');
        $rol->update();
        Session::flash('message','Rol editado correctamente');
        return Redirect::to('runner/roles');
    }

    /**
     * Remove the specified resource from storage.
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function destroy($id){
        $rol=Rol::findOrFail($id);
        $rol->delete();
        Session::flash('message','Rol eliminado correctamente');
        return Redirect::to('runner/roles');
    }
}
