<?php

namespace App\Exports;

use Spatie\Activitylog\Models\Activity;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class LogsExport implements FromCollection, WithHeadings
{
    protected $filters;

    /**
     * Recibe los filtros (array)
     */
    public function __construct($filters = [])
    {
        $this->filters = $filters;
    }

    /**
     * Datos que se exportan
     */
    public function collection()
    {
        $query = Activity::with('causer')->latest();

        // 🔍 FILTROS

        if (!empty($this->filters['user'])) {
            $query->where('causer_id', $this->filters['user']);
        }

        if (!empty($this->filters['action'])) {
            $query->where('description', 'like', '%' . $this->filters['action'] . '%');
        }

        if (!empty($this->filters['date'])) {
            $query->whereDate('created_at', $this->filters['date']);
        }

        // 📦 MAPEO PARA EXCEL
        return $query->get()->map(function ($log) {
            return [
                'ID' => $log->id,
                'Usuario' => optional($log->causer)->nombre ?? 'Sistema',
                'Acción' => $log->description,
                'Módulo' => $log->log_name ?? 'N/A',
                'Tabla' => $log->subject_type ? class_basename($log->subject_type) : 'N/A',
                'ID Registro' => $log->subject_id ?? 'N/A',
                'Fecha' => $log->created_at->format('Y-m-d H:i:s'),
            ];
        });
    }

    /**
     * Encabezados del Excel
     */
    public function headings(): array
    {
        return [
            'ID',
            'Usuario',
            'Acción',
            'Módulo',
            'Tabla',
            'ID Registro',
            'Fecha',
        ];
    }
}