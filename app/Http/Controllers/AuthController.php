<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Usuario;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        // Validar los datos de entrada
        $request->validate([
            'usuario' => 'required|string',
            'password' => 'required|string',
        ]);

        $credentials = $request->only('usuario', 'password');

        // Buscar el usuario
        $user = Usuario::where('usuario', $credentials['usuario'])->first();

        // Verificar si el usuario existe
        if (!$user) {
            \Log::error('Intento de login fallido: Usuario no encontrado', [
                'usuario' => $credentials['usuario']
            ]);
            return back()->withErrors(['usuario' => 'El usuario no existe'])
                        ->withInput($request->only('usuario'));
        }

        // Verificar la contraseña
        if (!Hash::check($credentials['password'], $user->password)) {
            \Log::error('Intento de login fallido: Contraseña incorrecta', [
                'usuario' => $credentials['usuario']
            ]);
            return back()->withErrors(['password' => 'La contraseña es incorrecta'])
                        ->withInput($request->only('usuario'));
        }

        // Login exitoso
        Auth::login($user);
        \Log::info('Login exitoso', ['usuario' => $user->usuario]);
        
        return redirect()->route('inicio');
    }
}
