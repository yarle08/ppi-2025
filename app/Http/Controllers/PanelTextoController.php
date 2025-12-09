<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PanelTexto;

class PanelTextoController extends Controller
{
    public function update(Request $request)
    {
        $request->validate([
            'panel' => 'required',
            'clave' => 'required',
            'valor' => 'required',
        ]);
        $texto = PanelTexto::updateOrCreate(
            ['panel' => $request->panel, 'clave' => $request->clave],
            ['valor' => $request->valor]
        );
        return response()->json(['success' => true, 'texto' => $texto]);
    }
}
