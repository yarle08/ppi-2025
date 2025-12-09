<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PanelTexto extends Model
{
    use HasFactory;
    protected $fillable = ['panel', 'clave', 'valor'];
}
