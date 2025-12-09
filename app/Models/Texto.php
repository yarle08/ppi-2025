<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Texto extends Model
{
    protected $fillable = ['clave', 'contenido'];

    // Deja esto en true si tu tabla tiene created_at y updated_at
    public $timestamps = true;

    /**
     * Obtiene el contenido de un texto por su clave, o retorna un valor por defecto si no existe
     */
    public static function obtenerTexto($clave, $defecto = '')
    {
        $texto = static::where('clave', $clave)->first();
        return $texto ? $texto->contenido : $defecto;
    }
}
