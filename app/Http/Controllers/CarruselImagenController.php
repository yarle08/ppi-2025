<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CarruselImagen;
use App\Models\Texto;
use Illuminate\Support\Facades\Storage;

class CarruselImagenController extends Controller
{
    public function update(Request $request, $clave)
    {
        $request->validate([
            'imagen' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $file = $request->file('imagen');
        $path = $file->store('carrusel', 'public');

        $carruselImagen = CarruselImagen::updateOrCreate(
            ['clave' => $clave],
            ['ruta' => $path]
        );

        return response()->json(['ruta' => $path]);
    }

    public function index()
    {
        // Cargar imágenes del carrusel
        $imagenes = CarruselImagen::pluck('ruta', 'clave')->toArray();
        
        // Cargar todos los textos editables
        $textos = Texto::pluck('contenido', 'clave')->toArray();
        
        // Preparar datos para la vista
        $data = [
            'imagenes' => $imagenes,
            // Textos del carrusel
            'carrusel_titulo_1' => $textos['carrusel_titulo_1'] ?? null,
            'carrusel_texto_1' => $textos['carrusel_texto_1'] ?? null,
            'carrusel_titulo_2' => $textos['carrusel_titulo_2'] ?? null,
            'carrusel_texto_2' => $textos['carrusel_texto_2'] ?? null,
            'carrusel_titulo_3' => $textos['carrusel_titulo_3'] ?? null,
            'carrusel_texto_3' => $textos['carrusel_texto_3'] ?? null,
            // Textos de la empresa
            'empresa_titulo' => $textos['empresa_titulo'] ?? null,
            'empresa_parrafo_1' => $textos['empresa_parrafo_1'] ?? null,
            'empresa_parrafo_2' => $textos['empresa_parrafo_2'] ?? null,
            // Textos de los modales
            'modal_mision_titulo' => $textos['modal_mision_titulo'] ?? null,
            'modal_mision_texto' => $textos['modal_mision_texto'] ?? null,
            'modal_vision_titulo' => $textos['modal_vision_titulo'] ?? null,
            'modal_vision_texto' => $textos['modal_vision_texto'] ?? null,
            'modal_servicios_titulo' => $textos['modal_servicios_titulo'] ?? null,
            'modal_servicios_texto' => $textos['modal_servicios_texto'] ?? null,
        ];
        
        return view('index', $data);
    }
}
