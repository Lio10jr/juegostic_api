<?php

namespace App\Http\Controllers;

use App\Models\Equipo;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
class EquipoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $equipos = Equipo::all();
        return response()->json($equipos);
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
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('images'), $imageName);
                $imagePath = asset('images/' . $imageName);
                $urlLogo = 'images/' . $imageName;
                $equipo = new Equipo([
                    'pk_idequ' => Str::uuid()->toString(),
                    'nom_equ' => $request->input('nom_equ'),
                    'logo' => $urlLogo,
                    'semestre' => $request->input('semestre'),
                    'representante' => $request->input('representante'),
                    'fk_idcamp' => $request->input('fk_idcamp'),
                ]);
                $equipo->save();

            }else {
                $equipo = new Equipo([
                    'pk_idequ' => Str::uuid()->toString(),
                    'nom_equ' => $request->input('nom_equ'),
                    'logo' => null,
                    'semestre' => $request->input('semestre'),
                    'representante' => $request->input('representante'),
                    'fk_idcamp' => $request->input('fk_idcamp'),
                ]);
                $equipo->save();
            }           
        } catch (\Throwable $th) {
            return response()->json(['error' => 'Error en la consulta SQL ' . $th], 500);
        }        
        return response()->json('Equipo creado!');
    }

    /**
     * Display the specified resource.
     */
    public function showCamp($fk_idcamp)
    {
        try {
            $eq = Equipo::where('fk_idcamp', $fk_idcamp)->get();
        } catch (\Throwable $th) {
            return response()->json(['error' => 'Error en la consulta SQL'], 500);
        }
        
        return response()->json($eq);
    }

    public function show($pk_idequ)
    {
        try {
            $eq = Equipo::where('pk_idequ', $pk_idequ)->get();
        } catch (\Throwable $th) {
            return response()->json(['error' => 'Error en la consulta SQL'], 500);
        }
        
        return response()->json($eq);
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, string $id)
    {
        try {
            $equipo = Equipo::find($id);
            $equipo->update([
                'nom_equ' => $request->input('nom_equ'),
                'semestre' => $request->input('semestre'),
                'representante' => $request->input('representante'),
                'fk_idcamp' => $request->input('fk_idcamp'),
            ]);
            
        } catch (\Throwable $th) {
            return response()->json(['error' => 'Error en la consulta SQL ' . $th], 500);
        }
        
        return response()->json('Equipo Actualizado!');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $equipo = Equipo::find($id);
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $eee = $request->input('name');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('images'), $imageName);
                $imagePath = asset('images/' . $imageName);
                $urlLogo = 'images/' . $imageName;

                
                $equipo->update([
                    'nom_equ' => $request->input('nom_equ'),
                    'logo' => $urlLogo,
                    'semestre' => $request->input('semestre'),
                    'representante' => $request->input('representante'),
                    'fk_idcamp' => $request->input('fk_idcamp'),
                ]);
                return response()->json('Equipo Actualizado' . $eee);
            }else {
                return response()->json('No hay imagen');
            }
        } catch (\Throwable $th) {
            return response()->json(['error' => 'Error en la consulta SQL ' . $th], 500);
        }
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $equipo = Equipo::find($id);
            $equipo->delete();
        } catch (\Throwable $th) {
            return response()->json(['error' => 'Error en la consulta SQL'], 500);
        }
        return response()->json('Equipo Eliminado!');
    }
}
