<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Hito;
use Illuminate\Support\Facades\Storage;

class HitoController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'titulo' => 'required',
            'descripcion' => 'required',
            'imagen' => 'nullable|image|max:2048'
        ]);
        if ($request->hasFile('imagen')) {
            $data['imagen'] = $request->file('imagen')->store('hitos', 'public');
        }
        $hito = Hito::create($data);
        return redirect()->back()->with('success', 'Hito creado correctamente.');
    }

    public function update(Request $request, $id)
    {
        $hito = Hito::findOrFail($id);
        $data = $request->validate([
            'titulo' => 'required',
            'descripcion' => 'required',
            'imagen' => 'nullable|image|max:2048'
        ]);
        if ($request->hasFile('imagen')) {
            if ($hito->imagen) {
                Storage::disk('public')->delete($hito->imagen);
            }
            $data['imagen'] = $request->file('imagen')->store('hitos', 'public');
        }
        $hito->update($data);
        return redirect()->back()->with('success', 'Hito actualizado correctamente.');
    }

    public function destroy($id)
    {
        $hito = Hito::findOrFail($id);
        if ($hito->imagen) {
            Storage::disk('public')->delete($hito->imagen);
        }
        $hito->delete();
        return redirect()->back()->with('success', 'Hito eliminado correctamente.');
    }
}
