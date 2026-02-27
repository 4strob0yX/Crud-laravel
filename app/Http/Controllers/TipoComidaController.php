<?php

namespace App\Http\Controllers;

use App\Models\TipoComida;
use Illuminate\Http\Request;

class TipoComidaController extends Controller
{
    public function index()
    {
        $tipocomidas = TipoComida::all();
        return view('Tipo_de_comidas.index', compact('tipocomidas'));
    }

    public function create()
    {
        return view('Tipo_de_comidas.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre_categoria'   => 'required|string',
            
        ]);

        TipoComida::create($request->only([
            'nombre_categoria',
        ]));

        return redirect()->route('tipo_comidas_create.index')
            ->with('exito', 'Tipo de comida creada registrada correctamente');
    }

    public function show(TipoComida $tipoComida)
    {
        return view('tipo_comidas.show', compact('tipo_comidas'));
    }

    public function edit(TipoComida $tipoComida)
    {
        return view('tipo_comidas.edit', compact('tipo_comidas'));
    }

    public function update(Request $request, Proveedor $proveedor)
    {
        $request->validate([
            'nombre_categoria'   => 'required|string,' . $tipoComida->id_tipo_comida . ',id_tipo_comida',
        ]);

        $proveedor->update($request->only([
            'nombre_categoria',
        ]));

        return redirect()->route('tipo_comidas.index')
            ->with('exito', 'Tipo de comida actualizado correctamente');
    }

    public function destroy(TipoComida $tipoComida)
    {
        $tipoComida->delete();

        return redirect()->route('tipo_comidas.index')
            ->with('exito', 'Tipo de comida  eliminado correctamente');
    }
}
