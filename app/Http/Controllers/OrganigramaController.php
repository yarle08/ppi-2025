<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Organigrama;
use Illuminate\Support\Facades\Storage;

class OrganigramaController extends Controller
{
    public function index()
    {
        // Crear datos por defecto si no existen
        $this->crearDatosPorDefecto();
        
        $organigramas = Organigrama::all()->keyBy('cargo');
        return view('organigrama', compact('organigramas'));
    }
    
    private function crearDatosPorDefecto()
    {
        $cargos = [
            [
                'cargo' => 'presidente',
                'titulo' => 'Presidente',
                'descripcion' => 'El presidente lidera la estrategia general de la empresa y supervisa todas las operaciones clave.',
                'imagen' => null
            ],
            [
                'cargo' => 'vicepresidente',
                'titulo' => 'Vicepresidente',
                'descripcion' => 'El vicepresidente apoya al presidente y se encarga de áreas clave como desarrollo y operaciones.',
                'imagen' => null
            ],
            [
                'cargo' => 'contador',
                'titulo' => 'Contador',
                'descripcion' => 'El contador gestiona las finanzas de la empresa, asegurando la transparencia y la eficiencia.',
                'imagen' => null
            ],
            [
                'cargo' => 'empleados',
                'titulo' => 'Empleados',
                'descripcion' => 'Los empleados son el motor de la empresa, trabajando en diversas áreas para alcanzar los objetivos.',
                'imagen' => null
            ]
        ];

        foreach ($cargos as $cargo) {
            Organigrama::firstOrCreate(
                ['cargo' => $cargo['cargo']], 
                $cargo
            );
        }
    }

    public function update(Request $request, $id)
    {
        $organigrama = Organigrama::findOrFail($id);
        
        $request->validate([
            'titulo' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'imagen' => 'nullable|image|max:2048'
        ]);

        $organigrama->titulo = $request->titulo;
        $organigrama->descripcion = $request->descripcion;

        if ($request->hasFile('imagen')) {
            // Eliminar imagen anterior si existe
            if ($organigrama->imagen && Storage::disk('public')->exists($organigrama->imagen)) {
                Storage::disk('public')->delete($organigrama->imagen);
            }

            // Guardar nueva imagen
            $rutaImagen = $request->file('imagen')->store('organigrama', 'public');
            $organigrama->imagen = $rutaImagen;
        }

        $organigrama->save();

        return redirect()->back()->with('success', 'Organigrama actualizado correctamente.');
    }
}
