<?php

namespace App\Imports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;

class UsersImport implements ToCollection, WithHeadingRow
{
    public function collection(Collection $rows)
    {
        $llaveMaestra = "CAMSP_ADMIN_2026";

        foreach ($rows as $row) {

            if (empty($row['identificador']) || empty($row['nombre'])) {
                continue;
            }

            $usuarioExistente = User::where('identificador', $row['identificador'])->first();

            $rolSolicitado = strtolower($row['rol'] ?? 'visitante');
            $autorizacionExcel = $row['autorizacion'] ?? null;

            // 🔐 CONTROL DE ADMIN
            if ($rolSolicitado === 'admin') {
                $yaEraAdmin = $usuarioExistente && $usuarioExistente->rol === 'admin';
                $tienePermisoExcel = ($autorizacionExcel === $llaveMaestra);

                if (!$yaEraAdmin && !$tienePermisoExcel) {
                    $rolSolicitado = 'docente';
                }
            }

            // 🧠 LIMPIEZA POR ROL
            $esEstudiante = $rolSolicitado === 'estudiante';
            $esEmpleado = in_array($rolSolicitado, ['docente', 'director', 'guardia', 'servicios_escolares', 'admin']);

            $data = [
                'identificador' => $row['identificador'],
                'nombre' => $row['nombre'],
                'apellidos' => $row['apellidos'] ?? null,
                'rol' => $rolSolicitado,

                'email' => $row['email'] ?? null,
                'telefono' => $row['telefono'] ?? null,
                'direccion' => $row['direccion'] ?? null,

                'curp' => $row['curp'] ?? null,
                'fecha_nacimiento' => $row['fecha_nacimiento'] ?? null,

                'condicion' => ($esEstudiante || $esEmpleado) ? ($row['condicion'] ?? null) : null,
                'taller_asignado' => ($esEstudiante || $esEmpleado) ? ($row['taller_asignado'] ?? null) : null,

                'responsable_id' => $esEstudiante ? ($row['responsable_id'] ?? null) : null,

                'observaciones' => $row['observaciones'] ?? null,

                'estatus' => strtolower($row['estatus'] ?? 'activo'),
            ];

            if ($usuarioExistente) {
                $usuarioExistente->update($data);
            } else {
                $data['password'] = Hash::make($row['identificador']);
                User::create($data);
            }
        }
    }
}