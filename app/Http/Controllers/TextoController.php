<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Texto;
use Illuminate\Support\Facades\Log;

class TextoController extends Controller
{
    public function update(Request $request, $clave)
    {
        Log::info('TextoController@update', [
            'clave' => $clave,
            'contenido' => $request->input('contenido')
        ]);

        $contenido = $request->input('contenido');

        if (is_null($contenido) || trim($contenido) === '') {
            if ($request->expectsJson()) {
                return response()->json(['success' => false, 'message' => 'Contenido vacío'], 400);
            }
            return redirect()->back();
        }

        $texto = Texto::where('clave', $clave)->first();

        if ($texto) {
            $texto->contenido = $contenido;
            $texto->save();
        } else {
            Texto::create([
                'clave' => $clave,
                'contenido' => $contenido,
            ]);
        }

        if ($request->expectsJson()) {
            return response()->json(['success' => true, 'message' => 'Texto actualizado correctamente']);
        }

        return redirect()->back();
    }

    public function index()
    {
        $textos = Texto::pluck('contenido', 'clave')->toArray();

        return view('index', [
            'modal_mision_titulo' => $textos['modal_mision_titulo'] ?? null,
            'modal_mision_texto' => $textos['modal_mision_texto'] ?? null,
            // ...
        ]);
    }
}
