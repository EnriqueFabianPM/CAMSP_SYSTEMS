<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'fotoqr',
        'foto',
        'identificador',
        'nombre',
        'apellidos',
        'rol', // admin, docente, estudiante, visitante, padre
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

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // Relaciones
    public function responsable()
    {
        return $this->belongsTo(User::class, 'responsable_id');
    }

    public function estudiantes()
    {
        return $this->hasMany(User::class, 'responsable_id');
    }

    // Scopes (para filtrar por tipo)
    public function scopeDocentes($query)
    {
        return $query->where('rol', 'docente');
    }

    public function scopeEstudiantes($query)
    {
        return $query->where('rol', 'estudiante');
    }

    public function scopeVisitantes($query)
    {
        return $query->where('rol', 'visitante');
    }

    public function scopePadres($query)
    {
        return $query->where('rol', 'padre');
    }
}
