<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evento extends Model
{
    protected $fillable = [
        'titulo',
        'fecha',
        'descripcion',
        'link',
        'imagenes'
    ];

    protected $casts = [
        'imagenes' => 'array',
        'fecha' => 'date'
    ];
}

