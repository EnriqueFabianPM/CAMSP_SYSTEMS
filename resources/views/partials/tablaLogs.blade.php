<div class="bg-white rounded-3xl shadow-2xl overflow-hidden border border-slate-200">

    {{-- HEADER --}}
    <div class="px-6 py-4 border-b bg-slate-50 flex flex-col md:flex-row md:justify-between md:items-center gap-4">

        <h3 class="text-sm font-black uppercase text-slate-600 tracking-widest">
            Actividad del Sistema
        </h3>

        {{-- FILTROS --}}
        <form method="GET" class="flex flex-wrap gap-2 items-center">

            {{-- USUARIO --}}
            <input type="text" name="user" placeholder="Usuario (ID o nombre)" value="{{ request('user') }}"
                class="text-xs px-3 py-2 rounded-xl border border-slate-200 focus:ring-2 focus:ring-blue-400 outline-none">

            {{-- ACCIÓN --}}
            <input type="text" name="action" placeholder="Acción..." value="{{ request('action') }}"
                class="text-xs px-3 py-2 rounded-xl border border-slate-200 focus:ring-2 focus:ring-indigo-400 outline-none">

            {{-- 📆 MES --}} <select name="mes" class="text-xs px-3 py-2 rounded-xl border border-slate-200">
                <option value="">Mes</option> @foreach(range(1, 12) as $m) <option value="{{ $m }}" {{ request('mes') == $m ? 'selected' : '' }}>
                    {{ \Carbon\Carbon::create()->month($m)->locale('es')->monthName }}
                </option> @endforeach
            </select> {{-- 📅 AÑO --}} <input type="number" name="anio" placeholder="Año" value="{{ request('anio') }}"
                class="text-xs px-3 py-2 rounded-xl border border-slate-200 w-20"> , <div
                class="bg-white rounded-3xl shadow-2xl overflow-hidden border border-slate-200"></div>

            {{-- FECHA --}}
            <input type="date" name="date" value="{{ request('date') }}"
                class="text-xs px-3 py-2 rounded-xl border border-slate-200">

            <button class="bg-slate-800 text-white px-4 py-2 rounded-xl text-xs font-bold hover:bg-black">
                Filtrar
            </button>

            <a href="{{ route('logs.index') }}"
                class="bg-slate-200 px-3 py-2 rounded-xl text-xs font-bold hover:bg-slate-300">
                Limpiar
            </a>

        </form>
    </div>

    {{-- TABLA --}}
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-slate-200">

            {{-- HEAD --}}
            <thead class="bg-slate-100 text-slate-500">
                <tr>
                    <th class="px-6 py-4 text-left text-[10px] font-black uppercase">Usuario</th>
                    <th class="px-6 py-4 text-left text-[10px] font-black uppercase">Acción</th>
                    <th class="px-6 py-4 text-center text-[10px] font-black uppercase">Módulo</th>
                    <th class="px-6 py-4 text-center text-[10px] font-black uppercase">Fecha</th>
                    <th class="px-6 py-4 text-center text-[10px] font-black uppercase">Ver</th>
                </tr>
            </thead>

            {{-- BODY --}}
            <tbody class="divide-y divide-slate-100">

                @forelse($logs as $log)

                    @php
                        $color = match (true) {
                            str_contains($log->description, 'created') => 'green',
                            str_contains($log->description, 'updated') => 'blue',
                            str_contains($log->description, 'deleted') => 'red',
                            default => 'gray'
                        };
                    @endphp

                    <tr class="hover:bg-slate-50 transition">

                        {{-- 👤 USUARIO --}}
                        <td class="px-6 py-4 text-sm">
                            @if($log->causer)
                                <p class="font-bold text-slate-800">
                                    {{ $log->causer->nombre }}
                                </p>
                                <span class="text-[10px] text-blue-600 font-mono">
                                    ID: {{ $log->causer->id }}
                                </span>
                            @else
                                <span class="text-slate-400 text-xs">Sistema</span>
                            @endif
                        </td>

                        {{-- ⚡ ACCIÓN --}}
                        <td class="px-6 py-4 text-xs">
                            <span class="px-3 py-1 rounded-full text-[10px] font-bold uppercase
                                                @if($color === 'green') bg-green-100 text-green-700
                                                @elseif($color === 'blue') bg-blue-100 text-blue-700
                                                @elseif($color === 'red') bg-red-100 text-red-700
                                                @else bg-slate-100 text-slate-600
                                                @endif
                                            ">
                                {{ $log->description }}
                            </span>
                        </td>

                        {{-- 📦 MÓDULO --}}
                        <td class="px-6 py-4 text-center text-xs">
                            <span class="bg-indigo-50 text-indigo-700 px-2 py-1 rounded-lg font-bold text-[10px]">
                                {{ $log->log_name ?? 'general' }}
                            </span>
                        </td>

                        {{-- 📅 FECHA --}}
                        <td class="px-6 py-4 text-center text-xs text-slate-600">
                            {{ $log->created_at->format('d/m/Y') }}
                            <br>
                            <span class="text-[10px] text-slate-400">
                                {{ $log->created_at->format('H:i') }}
                            </span>
                        </td>

                        {{-- 🔍 VER --}}
                        <td class="px-6 py-4 text-center">
                            <a href="{{ route('logs.show', $log->id) }}" class="text-slate-400 hover:text-blue-500">
                                <i class="fas fa-eye"></i>
                            </a>
                        </td>

                    </tr>

                @empty
                    <tr>
                        <td colspan="5" class="text-center py-10 text-slate-400">
                            No hay logs registrados
                        </td>
                    </tr>
                @endforelse

            </tbody>
        </table>
    </div>
</div>