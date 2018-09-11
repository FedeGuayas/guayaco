<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Circuito;
use Session;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\CircuitoFormRequest;
use DB;

class CircuitoController extends Controller
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
            $circuitos=DB::table('circuitos') -> where ('circuito','LIKE','%'.$query.'%')
            -> orderBy ('id','desc')
            -> paginate(10);
            return view ('runner.circuitos.index',["circuitos"=>$circuitos,"searchText"=>$query]);
        }
    }

    /**
    * Show the form for creating a new resource.
    * @return \Illuminate\Http\Response
    */

    public function create(){
        return view ("runner.circuitos.create");
    }
    
    /**
    * Store a newly created resource in storage.
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */

    public function store(CircuitoFormRequest $request){
        $circuito=new Circuito;
        $circuito->circuito=$request->get('circuito');
        $circuito->estado='1';
        $circuito->save();
        Session::flash('message','Circuito creado correctamente');
        return Redirect::to('runner/circuitos');
    }

    /**
    * Show the form for editing the specified resource.
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */

    public function edit($id){
        return view ('runner.circuitos.edit',["circuito"=>Circuito::findOrFail($id)]);
    }

    /**
    * Update the specified resource in storage.
    * @param  \Illuminate\Http\Request  $request
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    
    public function update(CircuitoFormRequest $request, $id){
        $circuito=Circuito::findOrFail($id);
        $circuito->circuito=$request->get('circuito');
        $circuito->update();
        Session::flash('message','Circuito editado correctamente');
        return Redirect::to('runner/circuitos');
    }

    /**
    * Remove the specified resource from storage.
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    
    public function destroy(Request $request,$id){
        $circuito=Circuito::findOrFail($id);
        if ($circuito->estado=='0'){
            $circuito->estado='1';
        }else
            $circuito->estado='0';
        $circuito->update();
//        Session::flash('message','Circuito desactivado');
        return Redirect::to('runner/circuitos');
    }
}