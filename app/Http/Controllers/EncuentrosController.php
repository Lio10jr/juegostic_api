<?php

namespace App\Http\Controllers;

use App\Models\Encuentros;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Controllers\TablaPosicionesController;

class EncuentrosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $encuentros = Encuentros::all();
        return response()->json($encuentros); 
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
            $encuentro = new Encuentros([
                'id_enc' => Str::uuid()->toString(),
                'fk_idcamp' => $request->input('fk_idcamp'),
                'fk_idequlocal' => $request->input('fk_idequlocal'),
                'fk_id_fase_e' => $request->input('fk_id_fase_e'),
                'goleslocal' => null,
                'fk_idequvisit' => $request->input('fk_idequvisit'),
                'golesvisit' => null,
                'campo' => $request->input('campo'),
                'fecha_hora' => $request->input('fecha_hora'),
                'numgrupo' => $request->input('numgrupo'),
                'estado_encuentro' => $request->input('estado_encuentro'),

            ]);
            $encuentro->save();
        } catch (\Throwable $th) {
            return response()->json(['error' => 'Error en la consulta SQL' . $th], 500);
        }
        
        return response()->json('Encuentros creado!');
    }

    /**
     * Display the specified resource.
     */
    public function show($id_enc)
    {
        try {
            $encuentro = Encuentros::where('id_enc', $id_enc)->get();
        } catch (\Throwable $th) {
            return response()->json(['error' => 'Error en la consulta SQL'], 500);
        }
        return response()->json($encuentro);
    }

    public function showCamp($idcamp)
    {
        try {
            $encuentro = Encuentros::where('fk_idcamp', $idcamp)->get();
        } catch (\Throwable $th) {
            return response()->json(['error' => 'Error en la consulta SQL'], 500);
        }
        return response()->json($encuentro);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Encuentros $encuentros)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $encuentro = Encuentros::find($id);

            if (!$encuentro) {
                return response()->json(['error' => 'El encuentro no existe'], 404);
            }
            $estadoAnterior = $encuentro->estado_encuentro;

            $encuentro->update($request->all());
            // Verifica si el estado del encuentro ha cambiado a "Terminado"
            if ($encuentro->estado_encuentro === 'Terminado' && $estadoAnterior !== 'Terminado') {
                $tablaPosicionesController = new TablaPosicionesController();
                $tablaPosicionesController->actualizarTablaPosiciones($encuentro);
            }
        } catch (\Throwable $th) {
            return response()->json(['error' => 'Error en la consulta SQL' . $th], 500);
        }
        return response()->json('Encuentros Actualizado');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $encuentros = Encuentros::find($id);
            $encuentros->delete();
        } catch (\Throwable $th) {
            return response()->json(['error' => 'Error en la consulta SQL'], 500);
        }
        return response()->json('Encuentros Eliminado!');
    }
}
