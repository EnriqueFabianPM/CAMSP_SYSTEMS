<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class UsersExport implements FromCollection, WithHeadings, WithMapping
{
    public function collection()
    {
        return User::with('responsable')->get();
    }

    public function map($user): array
    {
        return [
            $user->identificador,
            $user->nombre,
            $user->apellidos,
            $user->rol,
            $user->email,
            $user->telefono,
            $user->direccion,
            $user->curp,
            optional($user->fecha_nacimiento)->format('Y-m-d'),
            $user->condicion,
            $user->taller_asignado,
            $user->responsable_id,
            $user->observaciones,
            $user->estatus,
            '', // autorizacion (vacío por seguridad)
        ];
    }

    public function headings(): array
    {
        return [
            'identificador',
            'nombre',
            'apellidos',
            'rol',
            'email',
            'telefono',
            'direccion',
            'curp',
            'fecha_nacimiento',
            'condicion',
            'taller_asignado',
            'responsable_id',
            'observaciones',
            'estatus',
            'autorizacion', // SOLO para admin
        ];
    }
}