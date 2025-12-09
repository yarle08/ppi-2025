<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hito extends Model
{
    protected $fillable = ['titulo', 'descripcion', 'imagen'];
}
