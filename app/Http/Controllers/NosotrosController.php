<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Texto;
use App\Models\Hito;

class NosotrosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $textos = \App\Models\Texto::pluck('contenido', 'clave')->toArray();
        $hitos = \App\Models\Hito::all();
        $galeria = \App\Models\GaleriaImagen::all();

        return view('sobre_nosotros', [
            'historia_titulo'    => $textos['historia_titulo'] ?? null,
            'historia_parrafo_1' => $textos['historia_parrafo_1'] ?? null,
            'historia_parrafo_2' => $textos['historia_parrafo_2'] ?? null,
            'hitos' => $hitos,
            'galeria' => $galeria,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'imagen' => 'nullable|image|max:2048'
        ]);

        $rutaImagen = 'static/img/empresa.jpg'; // Imagen por defecto
        if ($request->hasFile('imagen')) {
            $rutaImagen = $request->file('imagen')->store('static/img', 'public');
        }

        $hito = Hito::create([
            'titulo' => $request->titulo,
            'descripcion' => $request->descripcion,
            'imagen' => $rutaImagen
        ]);

        return response()->json(['success' => true, 'hito' => $hito]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $hito = Hito::findOrFail($id);
        $hito->delete();
        return response()->json(['success' => true]);
    }
}
