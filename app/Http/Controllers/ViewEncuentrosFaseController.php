<?php

namespace App\Http\Controllers;

use App\Models\View_Encuentros_Fase;
use Illuminate\Http\Request;

class ViewEncuentrosFaseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $encuentros_fase = View_Encuentros_Fase::all();
        return response()->json($encuentros_fase); 
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($id_fase_e)
    {
        try {
            $encuentrosFase = View_Encuentros_Fase::where('id_fase_e', $id_fase_e)->get();
    
        } catch (\Throwable $th) {
            return response()->json(['error' => 'Error en la consulta SQL'], 500);
        }
        return response()->json($encuentrosFase);
    }

    public function showCamp($fk_idcamp)
    {
        try {
            $encuentrosFase = View_Encuentros_Fase::where('fk_idcamp', $fk_idcamp)->get();
    
        } catch (\Throwable $th) {
            return response()->json(['error' => 'Error en la consulta SQL'], 500);
        }
        return response()->json($encuentrosFase);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(View_Encuentros_Fase $view_Encuentros_Fase)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, View_Encuentros_Fase $view_Encuentros_Fase)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(View_Encuentros_Fase $view_Encuentros_Fase)
    {
        //
    }
}
