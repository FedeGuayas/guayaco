<?php

namespace App\Http\Controllers;

use App\Categoria;
use App\Inscripcion;
use App\Persona;
use Illuminate\Http\Request;
use DB;

use App\Http\Requests;

class EstadisticaController extends Controller
{
    public function categorias()
    {
        $categorias = Inscripcion::
        join('personas as p', 'p.id', '=', 'persona_id')
            ->join('circuitos as cir', 'cir.id', '=', 'circuito_id')
            ->join('categorias as cat', 'cat.id', '=', 'categoria_id')
            ->select('edad', 'genero', 'circuito', 'categoria', 'categoria_id')
            ->groupBy('categoria_id')
            ->get();

        $total=Inscripcion::all()->count();
        
        $categoriaArray = [];
        foreach ($categorias as $c) {
            $categoriaArray[] = [
                'labels' => $c->categoria,
                'cantidad' => Inscripcion::where('categoria_id', $c->categoria_id)->count()
            ];
        }
        return view('runner/charts/categorias', compact('categoriaArray','total'));
    }

    public function circuitos()
    {
        $circuitos = Inscripcion::
        join('personas as p', 'p.id', '=', 'persona_id')
            ->join('circuitos as cir', 'cir.id', '=', 'circuito_id')
            ->join('categorias as cat', 'cat.id', '=', 'categoria_id')
            ->select('edad', 'genero', 'circuito', 'categoria', 'circuito_id')
            ->groupBy('circuito_id')
            ->get();
        
        $total=Inscripcion::all()->count();

        $circuitoArray = [];
        foreach ($circuitos as $c) {
            $circuitoArray[] = [
                'labels' => $c->circuito,
                'cantidad' => Inscripcion::where('circuito_id', $c->circuito_id)->count()
            ];
        }
        return view('runner/charts/circuitos', compact('circuitoArray','total'));
    }

    public function generos()
    {
        $masculinos = Inscripcion::
        join('personas as p', 'p.id', '=', 'persona_id')
            ->select('p.genero')
            ->where('p.genero', 'Masculino')->count();
        $femeninos = Inscripcion::
        join('personas as p', 'p.id', '=', 'persona_id')
            ->select('p.genero')
            ->where('p.genero', 'Femenino')->count();

        $total=Inscripcion::all()->count();
        return view('runner/charts/generos', compact('masculinos','femeninos','total'));
    }


    public function cat_cir()
    {
        $categorias = Inscripcion::
        join('personas as p', 'p.id', '=', 'persona_id')
            ->join('circuitos as cir', 'cir.id', '=', 'circuito_id')
            ->join('categorias as cat', 'cat.id', '=', 'categoria_id')
            ->select('edad', 'genero', 'circuito', 'categoria', 'categoria_id','circuito_id','inscripciones.id')
            ->where('categoria','Abierta [13-65]')
            ->groupBy('categoria_id')
            ->get();

        $categoriaArray = [];
        foreach ($categorias as $c) {
            $categoriaArray[] = [
                'labels' => $c->categoria,
                'cantidad' => Inscripcion::where('categoria_id', $c->categoria_id)->count(),
                'circuito'=>$c->circuito,
            ];

        }

           $circuitos = Inscripcion::
        join('personas as p', 'p.id', '=', 'persona_id')
            ->join('circuitos as cir', 'cir.id', '=', 'circuito_id')
            ->join('categorias as cat', 'cat.id', '=', 'categoria_id')
            ->select('edad', 'genero', 'circuito', 'categoria', 'circuito_id','inscripciones.id')
            ->groupBy('categoria_id')
            ->get();


        $circuitoArray = [];
        foreach ($circuitos as $c) {
            $circuitoArray[] = [
                'labels' => $c->circuito,
                'cantidad' => Inscripcion::where('categoria_id', $c->inscripciones())->count(),
                'categorias'=>$c->categoria
            ];
        }
        dd($circuitoArray);


        $catArray = [];
        foreach ($categorias as $c) {
            $catArray[] = [
                'categorias' => $c->categoria()
            ];
        }


//        $datos=DB::table('inscripciones')->select(DB::raw('circuito, categoria, COUNT(*) AS total'))
//            ->join( 'circuitos as cir' ,'cir.id','=','circuito_id')
//            ->join( 'categorias as cat','cat.id' ,'=','categoria_id')
//            ->groupBy ('circuito', 'categoria')
//            ->orderBy ('circuito_id')
//            ->get();

//        dd($datos);

        return view('runner/charts/cat_cir',compact('circuitoArray','categoriaArray'));
    }
    
    
    

}
