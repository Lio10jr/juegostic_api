<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
class loginController extends Controller
{
    public function authLogin(Request $request)
    {
        $email = $request->get('email');
        $password = $request->get('password');

        $credencials = request()->only($email,$password);

        if ( Auth::attempt($credencials)) {
            return 'estas dentro';
        }
        return 'no entras capo';

        /* // Valida los datos de la solicitud
        $request->validate([
            'title' => 'required|string|max:255',
        ]);

        $title = $request->get('title');
        $status = $request->get('status');
        $date = $request->get('date');
        
        $task = new task();
        $task->title = $title;
        $task->status = $status;
        $task->date = $date;

        $task->save();
        // return $task;
        return response()->json([
            'message' => 'Tarea creada exitosamente',
            'task' => $task,
        ], 201); */
    }
}
