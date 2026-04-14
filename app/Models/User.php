<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'fotoqr',
        'foto',
        'identificador',
        'nombre',
        'apellidos',
        'rol',
        'email',
        'password',
        'telefono',
        'direccion',
        'curp',
        'fecha_nacimiento',
        'condicion',
        'taller_asignado',
        'responsable_id',
        'observaciones',
        'estatus',
        'ultimo_acceso',
    ];

    protected $hidden = ['password', 'remember_token'];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'fecha_nacimiento' => 'date',
        ];
    }

    // --- RELACIONES ---

    // Un estudiante tiene un responsable (Padre)
    public function responsable()
    {
        return $this->belongsTo(User::class, 'responsable_id');
    }

    // Un padre tiene muchos hijos (Estudiantes)
    public function hijos()
    {
        return $this->hasMany(User::class, 'responsable_id');
    }

    // --- AYUDANTES DE ROL ---
    public function esEmpleado(): bool
    {
        // Roles administrativos y operativos definidos en tu reporte 
        return in_array($this->rol, ['admin', 'docente', 'director', 'guardia', 'servicios_escolares']);
    }
}