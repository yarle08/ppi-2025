<?php

namespace App\Http\Controllers;

use App\Models\Contacto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use App\Mail\NuevoContactoMail;

class ContactoController extends Controller
{
    public function index()
    {
        return view('contactenos');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        $contacto = Contacto::create($validated);

        // Enviar notificación por email al administrador
        try {
            Mail::to('jarayarleni8@gmail.com')->send(new NuevoContactoMail($contacto));
        } catch (\Exception $e) {
            // Log el error pero no interrumpir el flujo
            Log::error('Error al enviar notificación de contacto: ' . $e->getMessage());
        }

        return back()->with('success', 'Mensaje enviado correctamente.');
    }

    public function getMensajes(Request $request)
    {
        $perPage = $request->input('per_page', 10);
        
        // Ordenar: no leídos y no respondidos primero, luego por fecha descendente
        $mensajes = Contacto::orderByRaw('(CASE WHEN leido = false THEN 0 ELSE 1 END)')
                           ->orderByRaw('(CASE WHEN respondido = false THEN 0 ELSE 1 END)')
                           ->orderBy('created_at', 'desc')
                           ->paginate($perPage);
        
        return response()->json($mensajes);
    }

    public function marcarComoLeido($id)
    {
        $contacto = Contacto::findOrFail($id);
        $contacto->leido = true;
        $contacto->save();
        
        return response()->json(['success' => true]);
    }

    public function responder(Request $request, $id)
    {
        $request->validate([
            'respuesta' => 'required|string',
        ]);

        $contacto = Contacto::findOrFail($id);
        
        // Enviar email
        try {
            Mail::send('emails.respuesta_contacto', [
                'nombreCliente' => $contacto->name,
                'asuntoOriginal' => $contacto->subject,
                'mensajeOriginal' => $contacto->message,
                'respuesta' => $request->respuesta,
            ], function($message) use ($contacto) {
                $message->to($contacto->email, $contacto->name)
                        ->subject('Re: ' . $contacto->subject);
            });

            // Marcar como leído y respondido
            $contacto->leido = true;
            $contacto->respondido = true;
            $contacto->save();

            return response()->json([
                'success' => true,
                'message' => 'Respuesta enviada correctamente'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al enviar el email: ' . $e->getMessage()
            ], 500);
        }
    }

    public function destroy($id)
    {
        $contacto = Contacto::findOrFail($id);
        $contacto->delete();
        
        return response()->json(['success' => true]);
    }
}
