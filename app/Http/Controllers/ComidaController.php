<?php

namespace App\Http\Controllers;

use App\Models\TipoComida;
use App\Models\Comida; 
use Illuminate\Http\Request;

class ComidaController extends Controller
{
    public function index()
    {
        $comidas = Comida::with('tipoComida')->get(); 
        return view('comidas.index', compact('comidas'));
    }

    public function create()
    {
        $tipocomidas = TipoComida::all(); 
        return view('comidas.create', compact('tipocomidas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre_comida' => 'required|string|max:100',
            'costo' => 'required|numeric',
            'detalle_comida' => 'required',
            'id_tipo_comida' => 'required|exists:tb_tipo_comidas,id_tipo_comida'
        ]);

        Comida::create($request->only([
            'nombre_comida',
            'costo',
            'detalle_comida',
            'id_tipo_comida',
        ]));

        return redirect()->route('comidas.index')
            ->with('exito', 'Comida creada correctamente');
    }

    public function show(Comida $comida)
    {
        return view('comidas.show', compact('comida'));
    }

    public function edit(Comida $comida)
    {
        $tipocomidas = TipoComida::all();
        return view('comidas.edit', compact('comida', 'tipocomidas'));
    }

    public function update(Request $request, Comida $comida)
    {
        $request->validate([
            'nombre_comida' => 'required|string|max:100',
            'costo' => 'required|numeric',
            'detalle_comida' => 'required',
            'id_tipo_comida' => 'required|exists:tb_tipo_comidas,id_tipo_comida'
        ]);

        $comida->update($request->only([
            'nombre_comida',
            'costo',
            'detalle_comida',
            'id_tipo_comida',
        ]));

        return redirect()->route('comidas.index')
            ->with('exito', 'Comida actualizada correctamente');
    }

    public function destroy(Comida $comida)
    {
        $comida->delete();

        return redirect()->route('comidas.index')
            ->with('exito', 'Comida eliminada correctamente');
    }
}