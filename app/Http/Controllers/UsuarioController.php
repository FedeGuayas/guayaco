<?php

namespace App\Http\Controllers;

use App\Escenario;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\UsuarioUpdateRequest;
use App\Http\Requests\UsuarioFormRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;


use DB;
use Illuminate\Support\Facades\Session;

class UsuarioController extends Controller
{

    public function __construct(){
        $this->middleware('auth');
        $this->middleware('administrador');

    }

    /**
     * Display a listing of the resource.
     * Muestra una lista de los recursos
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request)
    {    
        if ($request) {
            $query=trim($request -> get('searchText'));
            $usuarios=User::
                join('rols as r','users.rols_id','=','r.id')
                ->join('escenarios as e','users.escenario_id','=','e.id')
                ->select('users.id','name','nombre','email','password','e.escenario','r.rol','estado','avatar')
                ->where ('users.nombre','LIKE','%'.$query.'%')
                ->where ('users.name','LIKE','%'.$query.'%')
                ->where ('users.estado','1')
                ->orderBy ('users.id','desc')
                ->paginate(10);
            return view ('runner.usuarios.index',["usuarios"=>$usuarios,"searchText"=>$query]);
        }
//        $query=trim($request -> get('searchText'));
//        $usuarios=User::orderBy ('created_at','desc')->paginate(7);
//        return view ('runner.usuarios.index',["usuarios"=>$usuarios,"searchText"=>$query]);
    }

    /**
     * Show the form for creating a new resource.
     * Mostrar el formulario para crear un nuevo recurso
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $rol=DB::table('rols')->get();
        $escenario=DB::table('escenarios')->get();
        return view ("runner.usuarios.create",["roles"=>$rol,"escenarios"=>$escenario]);
    }



    /**
     * Store a newly created resource in storage.
     * Para almacenar un recurso recien creado
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(UsuarioFormRequest $request)
    {
        $usuario=new User;
        $usuario->name=strtoupper($request->get('name'));
        $usuario->email=$request->get('email');
        $usuario->password=$request->get('password');
        $usuario->nombre=strtoupper($request->get('nombre'));
        $usuario->rols_id=$request->get('rols_id');
        $usuario->escenario_id=$request->get('escenario_id');
        $usuario->estado=$request->get('estado');
        if ($request->file('avatar')){ //si se selecciona un archivo
            $file=$request->file('avatar');
            $name='usuario_img_'.time().'.'.$file->getClientOriginalExtension();
            $path=public_path().'/dist/img/users/';//ruta donde se guardara
            $file->move($path,$name);//lo copio a $path con el nombre $name
            $usuario->avatar=$name;//ahora se guarda  en el atributo avatar la imagen
        }
        $usuario->save();
        Session::flash('message','Usuario creado correctamente');
        return Redirect::to('runner/usuarios');
}


    /**
     * Display the specified resource.
     * Visualizar el recurso especificado por ejemplo detalles de usuario con un boton
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function show($id)
    {
        $usuario=User::findOrFail($id);
        return view ('runner.usuarios.show',["usuario"=>$usuario]);
    }

    /**
     * Show the form for editing the specified resource.
     *Mostrar el formulario para editar el recurso especificado
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $usuario=User::findOrFail($id);
        $rol=DB::table('rols')->get();
        $escenario=DB::table('escenarios')->get();
        return view ('runner.usuarios.edit',["usuario"=>$usuario,"rol"=>$rol,"escenario"=>$escenario]);
    }

    public function editProfile($id)
    {
        $usuario=User::findOrFail($id);
        $rol=DB::table('rols')->get();
        $escenario=DB::table('escenarios')->get();
        return view ('runner.usuarios.profile.editProfile',["usuario"=>$usuario,"rol"=>$rol,"escenario"=>$escenario]);
    }



    /**
     * Update the specified resource in storage.
     * Actualizar el recurso especificado en el almacenamiento
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UsuarioUpdateRequest $request, $id)
    {
        $usuario=User::findOrFail($id);
        $usuario->name=strtoupper($request->get('name'));
        $usuario->email=$request->get('email');
        $usuario->password=($request->get('password'));
        $usuario->nombre=strtoupper($request->get('nombre'));
        $usuario->rols_id=$request->get('rols_id');
        $usuario->escenario_id=$request->get('escenario_id');
        $usuario->estado=$request->get('estado');
        if ($request->file('avatar')){ //si se selecciona un archivo
            $file=$request->file('avatar');
            $name='usuario_img_'.time().'.'.$file->getClientOriginalExtension();
            $path=public_path().'/dist/img/users/';//ruta donde se guardara
            $file->move($path,$name);//lo copio a $path con el nombre $name
            $usuario->avatar=$name;//ahora se guarda  en el atributo avatar la imagen
        }
        $usuario->update();
        //$usuario=User::findOrFail($id)->update($request->all());
        Session::flash('message','Usuario editado correctamente');
        return Redirect::to('runner/usuarios');
    }

//    public function updateProfile(UsuarioUpdateRequest $request, $id)
//    {
//
//        $usuario=User::findOrFail($id);
//        if (Gate::denies('updateProfile', $usuario)) {//politica solo puede actualizar su perfil
//            abort(403);
//        }
//        $usuario->name=$request->get('name');
//        $usuario->email=$request->get('email');
//        $usuario->password=($request->get('password'));
//        $usuario->nombre=$request->get('nombre');
//        $usuario->rols_id=$request->get('rols_id');
//        $usuario->escenario_id=$request->get('escenario_id');
//        $usuario->estado=$request->get('estado');
//        if (Input::hasFile('avatar')){
//            $file=Input::file('avatar');
//            $file->move(public_path().'/dist/img/users/',$file->getClientOriginalName());
//            $usuario->avatar=$file->$file->getClientOriginalName();
//        }
//        $usuario->update();
//
//        //$usuario=User::findOrFail($id)->update($request->all());
//        Session::flash('message','Perfil editado correctamente');
//        return Redirect::to('runner/home');
//    }



    /**
     * Remove the specified resource from storage.
     *Quitar el recurso especificado de almacenamiento.
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $usuario=User::findOrFail($id);
        $usuario->estado='0';
        $usuario->update();
        Session::flash('message','Usuario eliminado correctamente');
        return Redirect::to('runner/usuarios');
    }


    public function getRestore(Request $request)
    {
        if ($request) {
            $query=trim($request -> get('searchText'));
            $usuarios=User::
                join('rols as r','users.rols_id','=','r.id')
                ->join('escenarios as e','users.escenario_id','=','e.id')
                ->select('users.id','name','nombre','email','password','e.escenario','r.rol','estado','avatar')
                ->where ('users.nombre','LIKE','%'.$query.'%')
                ->where ('users.name','LIKE','%'.$query.'%')
                ->where ('users.estado','0')
                ->orderBy ('users.id','desc')
                ->paginate(10);
            return view ('runner.usuarios.restore',["usuarios"=>$usuarios,"searchText"=>$query]);
        }
    }
    
    
    public function postRestore($id)
    {
        $usuario=User::findOrFail($id);
        $usuario->estado='1';
        $usuario->update();
        Session::flash('message','Usuario restaurado correctamente');
        return Redirect::to('runner/usuarios/restore');
    }

}
