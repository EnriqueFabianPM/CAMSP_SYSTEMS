<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\LogsExport;
use Spatie\Activitylog\Models\Activity;

class ControladprSistemaLog extends Controller
{
    /**
     * Mostrar todos los logs
     */
    public function index(Request $request)
    {
        $query = Activity::with('causer')->latest();

        // 🔍 Filtro por usuario
        if ($request->filled('user')) {
            $query->where('causer_id', $request->user);
        }

        // 🔍 Filtro por acción (texto)
        if ($request->filled('action')) {
            $query->where('description', 'like', '%' . $request->action . '%');
        }

        // 🔍 Filtro por fecha
        if ($request->filled('date')) {
            $query->whereDate('created_at', $request->date);
        }

        // 🔥 📆 FILTRO POR MES + AÑO (LO QUE TE FALTA)
        if ($request->filled('mes') && $request->filled('anio')) {
            $query->whereMonth('created_at', $request->mes)
                ->whereYear('created_at', $request->anio);
        }

        // 🔥 SI SOLO VIENE MES
        elseif ($request->filled('mes')) {
            $query->whereMonth('created_at', $request->mes);
        }

        // 🔥 SI SOLO VIENE AÑO
        elseif ($request->filled('anio')) {
            $query->whereYear('created_at', $request->anio);
        }

        $logs = $query->paginate(20);

        return view('admin.indexLogs', compact('logs'));
    }

    /**
     * Mostrar detalle de un log
     */
    public function show($id)
    {
        $log = Activity::with('causer')->findOrFail($id);

        return view('admin.showLogs', compact('log'));
    }

    /**
     * Limpiar logs antiguos (opcional)
     */
    public function clear()
    {
        Activity::truncate();

        return redirect()->back()->with('success', 'Logs eliminados correctamente');
    }

    public function export(Request $request)
    {
        return Excel::download(new LogsExport($request->all()), 'logs_sistema.xlsx');
    }
}