<?php

namespace App\Http\Controllers;

use App\Models\Pokemon;
use Illuminate\Http\Request;

class PokemonController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return \App\Models\Pokemon::all();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(\Illuminate\Http\Request $request)
    {
        // Validamos los datos
        $request->validate([
            'nombre' => 'required',
            'tipo' => 'required',
            'nivel' => 'required|integer',
            'es_legendario' => 'required|boolean',
            'peso' => 'required|numeric',
            'fecha_captura' => 'required|date'
        ]);

        $pokemon = \App\Models\Pokemon::create($request->all());
        return response()->json($pokemon, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $pokemon = \App\Models\Pokemon::find($id);

        if (!$pokemon) {
            return response()->json(['mensaje' => 'Pokemon no encontrado'], 404);
        }

        return $pokemon;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pokemon $pokemon)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(\Illuminate\Http\Request $request, $id)
    {
       
        $pokemon = \App\Models\Pokemon::find($id);

       
        if (!$pokemon) {
            return response()->json(['mensaje' => 'Pokemon no encontrado'], 404);
        }

        
        $pokemon->update($request->all());

        
        return response()->json($pokemon, 200);
    }

    public function destroy($id)
    {

        $pokemon = \App\Models\Pokemon::find($id);

        
        if (!$pokemon) {
            return response()->json(['mensaje' => 'Pokemon no encontrado'], 404);
        }

        $pokemon->delete();

        
        return response()->json(['mensaje' => 'Pokemon eliminado correctamente'], 200);
    }
}