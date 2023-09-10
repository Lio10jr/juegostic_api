<?php

namespace App\Http\Controllers;

use App\Models\Fase_Encuentros;
use Illuminate\Http\Request;

class FaseEncuentrosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $f_encuentros = Fase_Encuentros::all();
        return response()->json($f_encuentros); 
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
    public function store(Request $request)
    {
        try {
            $f_encuentros = new Fase_Encuentros([
                'id_fase_e' =>  $request->input('id_fase_e'),
                'nombre_fase' => $request->input('nombre_fase'),
                'numero_fase' => $request->input('numero_fase'),
            ]);
            $f_encuentros->save();
        } catch (\Throwable $th) {
            return response()->json(['error' => 'Error en la consulta SQL'], 500);
        }
        
        return response()->json('Fase_Encuentros creado!');
    }

    /**
     * Display the specified resource.
     */
    public function show($id_fase_e)
    {
        try {
            $fase_Encuentros = Fase_Encuentros::where('id_fase_e', $id_fase_e)->get();
        } catch (\Throwable $th) {
            return response()->json(['error' => 'Error en la consulta SQL'], 500);
        }
        return response()->json($fase_Encuentros);
    }

    public function showCamp($idcamp)
    {
        try {
            $fase_Encuentros = Fase_Encuentros::where('fk_idcamp', $idcamp)->get();
        } catch (\Throwable $th) {
            return response()->json(['error' => 'Error en la consulta SQL'], 500);
        }
        return response()->json($fase_Encuentros);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Fase_Encuentros $fase_Encuentros)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $fase_Encuentros = Fase_Encuentros::find($id);
            $fase_Encuentros->update($request->all());
        } catch (\Throwable $th) {
            return response()->json(['error' => 'Error en la consulta SQL'], 500);
        }
        return response()->json('Fase Encuentros Actualizado');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $fase_Encuentros = Fase_Encuentros::find($id);
            $fase_Encuentros->delete();
        } catch (\Throwable $th) {
            return response()->json(['error' => 'Error en la consulta SQL'], 500);
        }
        return response()->json('Fase Encuentros Eliminado!');
    }
}
