<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    public function authRegistro(Request $request)
    {
        /* try {
            if (!$user = JWTAuth::parseToken()->authenticate()) {
                return response()->json([
                    'error' => 'No autorizado'
                ], 401);
            }
        }catch(JWTException $e) {
            return response()->json([
                'error' => 'Token no creado'
            ], 500);
        }

        if ($user->rol == 'presidente') {
            return response()->json(['mensaje' => 'Usted no tiene permisos para registrar un nuevo usuario']);
        } */

        try {
            $user = User::create([
                'name' => $request->input('name') . ' ' . $request->input('lastname'),
                'email' => $request->input('email'),
                'phone' => $request->input('phone'),
                'rol' => $request->input('rol'),
                'password' => Hash::make($request->input('password')),
            ]);
            $token = JWTAuth::fromUser($user);

        } catch (error) {
            return response()->json([
                'Error' => error,
            ], 201);
        }
        

        return response()->json([
            'jwt' => $token,
        ], 201);
    }

    public function authLogin(Request $request)
    {
        $credentials = request(['email', 'password']);
        
        try {
            if (!$token = auth()->attempt($credentials)) {
                return response()->json([
                    'error' => 'No autorizado'
                ], 401);
            }
        }catch(JWTException $e) {
            return response()->json([
                'error' => 'Token no creado'
            ], 500);
        }

        // Crear una cookie con el token
        $cookie = cookie('token', $token, 90); // 1 day

        return response(['jwt' => $token])->withCookie($cookie);
    }


    public function user()
    {
        try {
            if (!$user = JWTAuth::parseToken()->authenticate()) {
                return response()->json(['error' => 'Usuario no existe'], 404);
            }
        } catch (Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {
            return response()->json(['error' => 'Token expired'], $e->getStatusCode());
        } catch (Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {
            return response()->json(['error' => 'Invalid token'], $e->getStatusCode());
        } catch (Tymon\JWTAuth\Exceptions\JWTException $e) {
            return response()->json(['error' => 'Token absent'], $e->getStatusCode());
        }
    
        return response()->json(['user' => $user]);
    }

    public function logout(Request $request)
    {
        // Invalidar el token del usuario autenticado
        JWTAuth::invalidate(JWTAuth::getToken());

        // Eliminar la cookie del token
        $cookie = cookie::forget('jwt');

        return response()->json(['mensaje' => 'Sesion Cerrada'])->withCookie($cookie);
    }
}
