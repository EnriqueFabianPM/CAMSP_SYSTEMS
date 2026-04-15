@php
    $user = auth()->user();
@endphp

<div class="bg-white rounded-3xl shadow-2xl overflow-hidden border border-slate-200">

    {{-- HEADER --}}
    <div class="px-6 py-4 border-b bg-slate-50 flex justify-between items-center">
        <h3 class="text-sm font-black uppercase text-slate-600 tracking-widest">
            Lista de Eventos
        </h3>

        {{-- FILTROS --}}
        <form method="GET" class="flex flex-wrap gap-2 items-center">

            {{-- 🔍 BUSCAR --}}
            <input type="text" name="titulo" placeholder="Buscar evento..." value="{{ request('titulo') }}"
                class="text-xs px-3 py-2 rounded-xl border border-slate-200 focus:ring-2 focus:ring-blue-400 outline-none">

            {{-- 📆 MES --}}
            <select name="mes" class="text-xs px-3 py-2 rounded-xl border border-slate-200">
                <option value="">Mes</option>
                @foreach(range(1, 12) as $m)
                    <option value="{{ $m }}" {{ request('mes') == $m ? 'selected' : '' }}>
                        {{ \Carbon\Carbon::create()->month($m)->locale('es')->monthName }}
                    </option>
                @endforeach
            </select>

            {{-- 📅 AÑO --}}
            <input type="number" name="anio" placeholder="Año" value="{{ request('anio') }}"
                class="text-xs px-3 py-2 rounded-xl border border-slate-200 w-20">

            {{-- BOTÓN --}}
            <button class="bg-slate-800 text-white px-4 py-2 rounded-xl text-xs font-bold hover:bg-black">
                Filtrar
            </button>

            {{-- LIMPIAR --}}
            <a href="{{ route('eventos.index') }}"
                class="bg-slate-200 px-3 py-2 rounded-xl text-xs font-bold hover:bg-slate-300">
                Limpiar
            </a>

        </form>
    </div>

    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-slate-200">

            {{-- HEAD --}}
            <thead class="bg-slate-100 text-slate-500">
                <tr>
                    <th class="px-6 py-4 text-left text-[10px] font-black uppercase">Evento</th>
                    <th class="px-6 py-4 text-left text-[10px] font-black uppercase">Descripción</th>
                    <th class="px-6 py-4 text-center text-[10px] font-black uppercase">Fecha</th>
                    <th class="px-6 py-4 text-center text-[10px] font-black uppercase">Imágenes</th>
                    <th class="px-6 py-4 text-center text-[10px] font-black uppercase">Acciones</th>
                </tr>
            </thead>

            {{-- BODY --}}
            <tbody class="divide-y divide-slate-100">

                @forelse($eventos as $evento)

                    <tr class="hover:bg-slate-50 transition">

                        {{-- 🎉 EVENTO --}}
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">

                                {{-- MINI IMAGEN --}}
                                <div class="w-12 h-12">
                                    @if(!empty($evento->imagenes) && is_array($evento->imagenes))
                                        <img src="{{ asset($evento->imagenes[0]) }}"
                                            class="w-12 h-12 rounded-xl object-cover border shadow">
                                    @else
                                        <div
                                            class="w-12 h-12 rounded-xl bg-slate-200 flex items-center justify-center text-slate-400">
                                            <i class="fas fa-image"></i>
                                        </div>
                                    @endif
                                </div>

                                {{-- TITULO --}}
                                <div>
                                    <p class="text-sm font-black text-slate-800">
                                        {{ $evento->titulo }}
                                    </p>
                                </div>

                            </div>
                        </td>

                        {{-- 📝 DESCRIPCIÓN --}}
                        <td class="px-6 py-4 text-xs text-slate-600 max-w-xs truncate">
                            {{ $evento->descripcion ?? 'Sin descripción' }}
                        </td>

                        {{-- 📅 FECHA --}}
                        <td class="px-6 py-4 text-center text-xs text-slate-600">
                            {{ $evento->fecha ? $evento->fecha->format('d/m/Y') : 'Sin fecha' }}
                        </td>

                        {{-- 🖼️ IMÁGENES --}}
                        <td class="px-6 py-4 text-center">
                            @if($evento->imagenes)
                                <span class="px-3 py-1 bg-blue-100 text-blue-700 rounded-full text-[10px] font-black">
                                    {{ count($evento->imagenes) }} fotos
                                </span>
                            @else
                                <span class="text-[10px] text-slate-400">Sin imágenes</span>
                            @endif
                        </td>

                        {{-- ⚙️ ACCIONES --}}
                        <td class="px-6 py-4 text-center">
                            <div class="flex justify-center gap-4">

                                {{-- FICHA PÚBLICA (LIBRO) --}}
                                <a href="{{ route('eventos.fichaPublica', $evento->id) }}"
                                    class="text-slate-400 hover:text-indigo-500" title="Vista Pública">
                                    <i class="fas fa-book-open"></i>
                                </a>

                                {{-- VER --}}
                                <a href="{{ route('eventos.show', $evento->id) }}"
                                    class="text-slate-400 hover:text-blue-500">
                                    <i class="fas fa-eye"></i>
                                </a>

                                {{-- EDITAR --}}
                                @if($user->rol === 'admin' || $user->rol === 'servicios_escolares')
                                    <a href="{{ route('eventos.edit', $evento->id) }}"
                                        class="text-slate-400 hover:text-amber-500">
                                        <i class="fas fa-pen"></i>
                                    </a>
                                @endif

                                {{-- ELIMINAR --}}
                                @if($user->rol === 'admin')
                                    <form action="{{ route('eventos.destroy', $evento->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')

                                        <button class="text-slate-400 hover:text-red-500"
                                            onclick="return confirm('¿Eliminar evento?')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                @endif

                            </div>
                        </td>

                    </tr>

                @empty
                    <tr>
                        <td colspan="5" class="text-center py-10 text-slate-400">
                            No hay eventos registrados
                        </td>
                    </tr>
                @endforelse

            </tbody>
        </table>
    </div>
</div>