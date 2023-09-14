<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Str;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;


class AuthController extends Controller
{
    public function authRegistro(Request $request)
    {
        try {
            $user = User::create([
                'nombre' => $request->input('name'),
                'apellido' => $request->input('lastname'),
                'email' => $request->input('email'),
                'celular' => $request->input('phone'),
                'fk_rol' => $request->input('rol'),
                'password' => Hash::make($request->input('password')),
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'Error' => $e,
            ], 201);
        }
        

        return response()->json([
            'mensaje' => 'Registro Exitoso',
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
        }catch(\Exception $e) {
            return response()->json([
                'error' => 'Token no creado'
            ], 500);
        }
        // Obtener el usuario autenticado
        $user = auth()->user();
        
        // Crear una cookie con el token
        $cookie = cookie('access_token', $token, 90); // 1 day

        // Convertir los datos del usuario en una cadena JSON
        $userData = [
            'user' => $user,
        ];

        $userDataJson = json_encode($userData);

        $usercookie  = cookie('user_', $userDataJson, 90); // 1 day

        $response = response([
            'access_token' => $token,
            'user_' => $userDataJson,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 90]);

        // Asignar ambas cookies a la respuesta
        $response->withCookie($cookie);
        $response->withCookie($usercookie);

        return $response;
    }


    public function user()
    {
        try {
            if (!$user = JWTAuth::parseToken()->authenticate()) {
                return response()->json(['error' => 'Usuario no existe', 'user' => auth()->user()], 404);
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

    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 90
        ]);
    }
}
