<?php

namespace App\Http\Controllers;

use App\Models\Servicio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ServicioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $servicios = Servicio::all();
        return view('nuestros_servicios', compact('servicios'));
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
        $data = $request->validate([
            'titulo' => 'required',
            'descripcion' => 'required',
            'duracion' => 'nullable',
            'precio' => 'nullable',
            'imagen' => 'nullable|image|max:2048'
        ]);
        if ($request->hasFile('imagen')) {
            $data['imagen'] = $request->file('imagen')->store('servicios', 'public');
        }
        Servicio::create($data);
        return back()->with('success', 'Servicio creado correctamente');
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
    public function update(Request $request, Servicio $servicio)
    {
        $data = $request->validate([
            'titulo' => 'required',
            'descripcion' => 'required',
            'duracion' => 'nullable',
            'precio' => 'nullable',
            'imagen' => 'nullable|image|max:2048'
        ]);
        if ($request->hasFile('imagen')) {
            if ($servicio->imagen) Storage::disk('public')->delete($servicio->imagen);
            $data['imagen'] = $request->file('imagen')->store('servicios', 'public');
        }
        $servicio->update($data);
        return back()->with('success', 'Servicio actualizado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Servicio $servicio)
    {
        if ($servicio->imagen) Storage::disk('public')->delete($servicio->imagen);
        $servicio->delete();
        return back()->with('success', 'Servicio eliminado correctamente');
    }
}
