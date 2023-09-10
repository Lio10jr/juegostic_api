<?php

namespace App\Http\Controllers;

use App\Models\Tabla_Posiciones;
use App\Models\Vista_Posiciones;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Encuentros;

class TablaPosicionesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tabla_posiciones = Tabla_Posiciones::all();
        return response()->json($tabla_posiciones);
    }

    public function indexView()
    {
        $tabla_posiciones = Vista_Posiciones::all();
        return response()->json($tabla_posiciones);
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
            $tabla_posicion = new Tabla_Posiciones([
                'id_posicion' => Str::uuid()->toString(),
                'fk_idcamp' => $request->input('fk_idcamp'),
                'fk_id_fase_e' => $request->input('fk_id_fase_e'),
                'fk_idequ' => $request->input('fk_idequ'),
                'numgrupo' => $request->input('numgrupo'),
                'pj' => $request->input('pj'),
                'pg' => $request->input('pg'),
                'pe' => $request->input('pe'),
                'pp' => $request->input('pp'),
                'gf' => $request->input('gf'),
                'gc' => $request->input('gc'),
                'gd' => $request->input('gd'),
                'pts' => $request->input('pts'),
            ]);
            $tabla_posicion->save();
        } catch (\Throwable $th) {
            return response()->json(['error' => 'Error en la consulta SQL' . $th], 500);
        }
        
        return response()->json('Tabla de posiciones de Fase creada!');
    }

    /**
     * Display the specified resource.
     */
    public function show($id_posicion, $id_campeonato)
    {
        try {
            $tabla_posicion = Vista_Posiciones::where('id_posicion', $id_posicion)->where('fk_idcamp', $id_campeonato)->get();
        } catch (\Throwable $th) {
            return response()->json(['error' => 'Error en la consulta SQL'], 500);
        }
        return response()->json($tabla_posicion);
    }

    public function showCampeonato($id_campeonato)
    {
        try {
            $tabla_posicion = Tabla_Posiciones::where('fk_idcamp', $id_campeonato)->get();
        } catch (\Throwable $th) {
            return response()->json(['error' => 'Error en la consulta SQL'], 500);
        }
        return response()->json($tabla_posicion);
    }

    public function showCampeonatoView($id_campeonato)
    {
        try {
            $tabla_posicion = Vista_Posiciones::where('fk_idcamp', $id_campeonato)->get();
        } catch (\Throwable $th) {
            return response()->json(['error' => 'Error en la consulta SQL'], 500);
        }
        return response()->json($tabla_posicion);
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tabla_Posiciones $tabla_Posiciones)
    {
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $tabla_posicion = Tabla_Posiciones::find($id);
            $tabla_posicion->update($request->all());
            
        } catch (\Throwable $th) {
            return response()->json(['error' => 'Error en la consulta SQL' . $th], 500);
        }
        return response()->json('Tabla de posiciones de Fase Actualizado');
    }

    public function actualizarTablaPosiciones(Encuentros $encuentro)
    {
        $equipoLocal = $encuentro->fk_idequlocal;
        $equipoV = $encuentro->fk_idequvisit;
        // Equipo local        
        $pj = 1;
        $pg = $encuentro->goleslocal > $encuentro->golesvisit ? 1 : 0;
        $pe = $encuentro->goleslocal === $encuentro->golesvisit ? 1 : 0;
        $pp = $encuentro->goleslocal < $encuentro->golesvisit ? 1 : 0;
        $gf = $encuentro->goleslocal;;
        $gc = $encuentro->golesvisit;
        $gd = $gf - $gc;
        if ($encuentro->goleslocal > $encuentro->golesvisit){
            $pts = 3;
        }else {
            if ($encuentro->goleslocal < $encuentro->golesvisit) {
                $pts = 0;
            }else{
                $pts = 1;
            }
        }

        Tabla_Posiciones::where('fk_idcamp', $encuentro->fk_idcamp)
        ->where('fk_id_fase_e', $encuentro->fk_id_fase_e)
        ->where('fk_idequ', $equipoLocal)
        ->each(function ($posicion) use ($pj, $pg, $pe, $pp, $gf, $gc, $gd, $pts) {
            $posicion->pj = $posicion->pj + $pj;
            $posicion->pg = $posicion->pg + $pg;
            $posicion->pe = $posicion->pe + $pe;
            $posicion->pp = $posicion->pp + $pp;
            $posicion->gf = $posicion->gf + $gf;
            $posicion->gc = $posicion->gc + $gc;
            $posicion->gd = $posicion->gd + $gd;
            $posicion->pts = $posicion->pts + $pts;
            $posicion->save();
        });

        // Equipo V
        $pj_v = 1;
        $pg_v = $encuentro->golesvisit > $encuentro->goleslocal ? 1 : 0;
        $pe_v = $encuentro->golesvisit === $encuentro->goleslocal ? 1 : 0;
        $pp_v = $encuentro->golesvisit < $encuentro->goleslocal ? 1 : 0;
        $gf_v = $encuentro->golesvisit;
        $gc_v = $encuentro->goleslocal;
        $gd_v = $gf_v - $gc_v;

        if ($encuentro->golesvisit > $encuentro->goleslocal) {
            $pts_v = 3;
        } elseif ($encuentro->golesvisit < $encuentro->goleslocal) {
            $pts_v = 0;
        } else {
            $pts_v = 1;
        }

        Tabla_Posiciones::where('fk_idcamp', $encuentro->fk_idcamp)
        ->where('fk_id_fase_e', $encuentro->fk_id_fase_e)
        ->where('fk_idequ', $equipoV)
        ->each(function ($posicion) use ($pj_v, $pg_v, $pe_v, $pp_v, $gf_v, $gc_v, $gd_v, $pts_v) {
            $posicion->pj = $posicion->pj + $pj_v;
            $posicion->pg = $posicion->pg + $pg_v;
            $posicion->pe = $posicion->pe + $pe_v;
            $posicion->pp = $posicion->pp + $pp_v;
            $posicion->gf = $posicion->gf + $gf_v;
            $posicion->gc = $posicion->gc + $gc_v;
            $posicion->gd = $posicion->gd + $gd_v;
            $posicion->pts = $posicion->pts + $pts_v;
            $posicion->save();
        });

    }
        

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $tabla_posicion = Tabla_Posiciones::find($id);
            $tabla_posicion->delete();
        } catch (\Throwable $th) {
            return response()->json(['error' => 'Error en la consulta SQL'], 500);
        }
        return response()->json('Tabla de posiciones de Fase Eliminado!');
    }
}
