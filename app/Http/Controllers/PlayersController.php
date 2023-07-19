<?php

namespace App\Http\Controllers;

use App\Models\Players;
use Illuminate\Http\Request;

class PlayersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $players = Players::all();
        return response()->json($players); 
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
            $player = new Players([
                'pk_ced' => $request->input('pk_ced'),
                'nombre' => $request->input('nombre'),
                'apellido' => $request->input('apellido'),
                'semestre' => $request->input('semestre'),
                'f_nacimiento' => $request->input('f_nacimiento'),
                'fk_idequ' => $request->input('fk_idequ'),
            ]);
            $player->save();
        } catch (\Throwable $th) {
            return response()->json(['error' => 'Error en la consulta SQL'], 500);
        }
        
        return response()->json('Players creado!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Players $players)
    {
        try {
            $pla = Players::find($players);
        } catch (\Throwable $th) {
            return response()->json(['error' => 'Error en la consulta SQL'], 500);
        }
        return response()->json($pla);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Players $players)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $players = Players::find($id);
            $players->update($request->all());
        } catch (\Throwable $th) {
            return response()->json(['error' => 'Error en la consulta SQL'], 500);
        }
        return response()->json('Players Actualizado');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $players = Players::find($id);
            $players->delete();
        } catch (\Throwable $th) {
            return response()->json(['error' => 'Error en la consulta SQL'], 500);
        }
        return response()->json('Players Eliminado!');
    }
}
