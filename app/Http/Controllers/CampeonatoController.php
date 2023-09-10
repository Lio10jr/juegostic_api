<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Campeonato;
use Illuminate\Support\Str;

class CampeonatoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $campeonatos = Campeonato::all();
        return response()->json($campeonatos);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $campeonato = new Campeonato([
                'pk_idcamp' => Str::uuid()->toString(),
                'name_camp' => $request->input('name_camp'),
                'anio_camp' => $request->input('anio_camp'),
                'estado' => $request->input('estado'),
            ]);
            $campeonato->save();
        } catch (\Throwable $th) {
            return response()->json(['error' => 'Error en la consulta SQL'], 500);
        }

        return response()->json('Campeonato creado!');
    }

    /**
     * Display the specified resource.
     */
    public function show($pk_idcamp)
    {
        try {
            $camp = Campeonato::where('pk_idcamp', $pk_idcamp)->get();
        } catch (\Throwable $th) {
            return response()->json(['error' => 'Error en la consulta SQL'], 500);
        }
        return response()->json($camp);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $campeonato = Campeonato::find($id);
            $campeonato->update($request->all());
        } catch (\Throwable $th) {
            return response()->json(['error' => 'Error en la consulta SQL'], 500);
        }
        return response()->json('Campeonato Actualizado');
    }

    public function updateEstado(Request $request, string $id)
    {
        try {
            // Encuentra el campeonato por su ID
            $campeonato = Campeonato::find($id);

            $campeonato->estado = false;
            $campeonato->save();
        } catch (\Throwable $th) {
            return response()->json(['error' => 'Error en la consulta SQL'], 500);
        }

        return response()->json('Estado del Campeonato Actualizado');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

        try {
            $campeonato = Campeonato::find($id);
            $campeonato->delete();
        } catch (\Throwable $th) {
            return response()->json(['error' => 'Error en la consulta SQL'], 500);
        }
        return response()->json('Campeonato Eliminado!');
    }
}
