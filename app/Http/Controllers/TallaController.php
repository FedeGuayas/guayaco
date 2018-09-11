<?php

namespace App\Http\Controllers;

use App\Talla;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

use App\Http\Requests;

class TallaController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'administrador'],['except'=>['getTallaStock']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $tallas = Talla::all();

        return view('runner.tallas.index', compact('tallas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("runner.tallas.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'talla' => 'required',
            'color' => 'required',
            'stock' => 'integer',
        ];
        $this->validate($request, $rules);

        $talla = new Talla;
        $talla->talla = $request->get('talla');
        $talla->stock = $request->get('stock');
        $talla->color = $request->get('color');
        if ($request->get('stock') > 0) {
            $talla->estaDisponible();
        }
        $talla->save();

        Session::flash('message', 'Talla creada correctamente');
        return redirect()->route('runner.tallas.index');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $talla = Talla::findOrFail($id);
        return view('runner.tallas.edit', compact('talla'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $talla = Talla::findOrFail($id);

        $rules = [
            'talla' => 'required',
            'color' => 'required',
            'stock' => 'integer',
        ];

        $this->validate($request, $rules);

        $talla->talla = $request->get('talla');
        $talla->stock = $request->get('stock');
        $talla->color = $request->get('color');

        if ($request->get('stock') > 0) {
            $talla->estaDisponible();
        } else {
            $talla->noEstaDisponible();
        }

        $talla->save();

        Session::flash('message', 'Talla actualizada correctamente');
        return redirect()->route('runner.tallas.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $talla = Talla::findOrFail($id);
        $talla->delete();

        Session::flash('message', 'Talla ' . $talla->talla . '  eliminada');
        return redirect()->route('runner.tallas.index');
    }


    /**
     * Muestra el stock de la talla
     * @param $id
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
    public function getTallaStock(Request $request)
    {
        $talla = Talla::findOrFail($request->id);

        $stock= $talla->stock;

        return response()->json(['data' => $stock], 200);

    }

}
