<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Categoria;
use Session;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\CategoriaFormRequest;
use DB;
class CategoriaController extends Controller
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
            $categorias=DB::table('categorias') -> where ('categoria','LIKE','%'.$query.'%')
            -> orderBy ('id','desc')
            -> paginate(10);
            return view ('runner.categorias.index',["categorias"=>$categorias,"searchText"=>$query]);
        }
    }

    /**
    * Show the form for creating a new resource.
    * @return \Illuminate\Http\Response
    */

    public function create(){
        return view ("runner.categorias.create");
    }
    
    /**
    * Store a newly created resource in storage.
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */

    public function store(CategoriaFormRequest $request){
        $categoria=new Categoria;
        $categoria->categoria=$request->get('categoria');
        $categoria->save();
        Session::flash('message','Categoría creada correctamente');
        return Redirect::to('runner/categorias');
    }

    /**
    * Display the specified resource.
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */

    public function edit($id){
        return view ('runner.categorias.edit',["categoria"=>Categoria::findOrFail($id)]);
    }

    /**
    * Update the specified resource in storage.
    * @param  \Illuminate\Http\Request  $request
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    
    public function update(CategoriaFormRequest $request, $id){
        $categoria=Categoria::findOrFail($id);
        $categoria->categoria=$request->get('categoria');
        $categoria->update();
        Session::flash('message','Categoría actualizada correctamente');
        return Redirect::to('runner/categorias');
    }

    /**
    * Remove the specified resource from storage.
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    
    public function destroy($id)
    {
        $categoria=Categoria::findOrFail($id);
        if ($categoria->estado=='0'){
            $categoria->estado='1';
        }else
            $categoria->estado='0';
        $categoria->update();
//        Session::flash('message','Categoría eliminada correctamente');
        return Redirect::to('runner/categorias');
    }
}