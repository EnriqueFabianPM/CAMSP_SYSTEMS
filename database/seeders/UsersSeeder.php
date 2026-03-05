<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UsersSeeder extends Seeder
{
    public function run(): void
    {
        // Admin principal
        $admin = User::create([
            'identificador' => 'ADM001',
            'nombre' => 'Administrador',
            'apellidos' => 'General',
            'rol' => 'admin',
            'email' => 'admin@cam.edu.mx',
            'password' => Hash::make('Admin123*'),
            'telefono' => '8112345678',
            'direccion' => 'Oficina Principal',
            'estatus' => 'Activo',
        ]);

        // Docente
        $docente = User::create([
            'identificador' => 'DOC001',
            'nombre' => 'María',
            'apellidos' => 'Pérez',
            'rol' => 'docente',
            'email' => 'docente@cam.edu.mx',
            'password' => Hash::make('Docente123*'),
            'telefono' => '8123456789',
            'taller_asignado' => 'Carpintería',
            'estatus' => 'Activo',
        ]);

        // Padre de familia (lo creamos ANTES del estudiante)
        $padre = User::create([
            'identificador' => 'PAD001',
            'nombre' => 'José',
            'apellidos' => 'López',
            'rol' => 'padre',
            'email' => 'padre@cam.edu.mx',
            'password' => Hash::make('Padre123*'),
            'telefono' => '8134567890',
            'direccion' => 'Col. Centro, Monterrey',
            'estatus' => 'Activo',
        ]);

        // Estudiante (ahora sí puede referenciar al padre existente)
        $estudiante = User::create([
            'identificador' => 'EST001',
            'nombre' => 'Carlos',
            'apellidos' => 'López',
            'rol' => 'estudiante',
            'email' => 'estudiante@cam.edu.mx',
            'password' => Hash::make('Estudiante123*'),
            'responsable_id' => $padre->id, // ← ya existe
            'condicion' => 'TEA',
            'taller_asignado' => 'Panadería',
            'estatus' => 'Activo',
        ]);

        // Visitante (ej. representante SEP)
        $visitante = User::create([
            'identificador' => 'VIS001',
            'nombre' => 'Laura',
            'apellidos' => 'Ramírez',
            'rol' => 'visitante',
            'email' => 'visitante@cam.edu.mx',
            'password' => Hash::make('Visitante123*'),
            'observaciones' => 'Supervisión SEP',
            'estatus' => 'Activo',
        ]);
    }
}