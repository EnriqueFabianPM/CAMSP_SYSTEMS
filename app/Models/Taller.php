<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Taller extends Model
{
    use HasFactory;

    protected $table = 'talleres';

    protected $fillable = [
        'nombre',
        'aula',
    ];

    // Relaciones futuras (por ejemplo, usuarios asignados)
    public function usuarios()
    {
        return $this->hasMany(User::class, 'taller_asignado', 'nombre');
    }
}