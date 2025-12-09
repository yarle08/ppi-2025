<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GaleriaImagen;
use Illuminate\Support\Facades\Storage;

class GaleriaImagenController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'imagen' => 'required|image|max:2048',
        ]);
        if ($request->hasFile('imagen')) {
            $rutaImagen = $request->file('imagen')->store('galeria', 'public');
            $img = new GaleriaImagen();
            $img->imagen = $rutaImagen;
            $img->save();
            return redirect()->back()->with('success', 'Imagen agregada correctamente.');
        } else {
            return redirect()->back()->with('error', 'No se subió la imagen.');
        }
    }

   public function update(Request $request, $id)
    {
        $img = GaleriaImagen::findOrFail($id);

        if ($request->hasFile('imagen')) {
            // Eliminar imagen anterior
            if ($img->imagen && Storage::disk('public')->exists($img->imagen)) {
                Storage::disk('public')->delete($img->imagen);
            }

            // Guardar la nueva imagen
            $rutaImagen = $request->file('imagen')->store('galeria', 'public');
            $img->imagen = $rutaImagen;
            $img->save();
        }

        return redirect()->back()->with('success', 'Imagen actualizada correctamente.');
    }


    public function destroy($id)
    {
        $img = GaleriaImagen::findOrFail($id);
        if ($img->imagen && Storage::disk('public')->exists($img->imagen)) {
            Storage::disk('public')->delete($img->imagen);
        }
        $img->delete();
        return redirect()->back()->with('success', 'Imagen eliminada correctamente.');
    }
}
