@php
    $user = auth()->user();
@endphp

<div class="bg-white rounded-3xl shadow-2xl overflow-hidden border border-slate-200">

    {{-- HEADER DE TABLA --}}
    <div class="px-6 py-4 border-b bg-slate-50 flex justify-between items-center">
        <h3 class="text-sm font-black uppercase text-slate-600 tracking-widest">
            Lista de Usuarios
        </h3>

        <form method="GET" class="flex flex-wrap gap-2 items-center">

            {{-- 🔍 BUSCADOR --}}
            <input type="text" name="nombre" placeholder="Buscar usuario..." value="{{ request('nombre') }}"
                class="text-xs px-3 py-2 rounded-xl border border-slate-200 focus:ring-2 focus:ring-blue-400 outline-none">

            {{-- 🏷️ FILTRO POR ROL --}}
            <select name="rol"
                class="text-xs px-3 py-2 rounded-xl border border-slate-200 focus:ring-2 focus:ring-indigo-400">
                <option value="">Todos los roles</option>
                <option value="admin" {{ request('rol') == 'admin' ? 'selected' : '' }}>Admin</option>
                <option value="docente" {{ request('rol') == 'docente' ? 'selected' : '' }}>Docente</option>
                <option value="estudiante" {{ request('rol') == 'estudiante' ? 'selected' : '' }}>Estudiante</option>
                <option value="padre" {{ request('rol') == 'padre' ? 'selected' : '' }}>Padre</option>
                <option value="director" {{ request('rol') == 'director' ? 'selected' : '' }}>Director</option>
                <option value="guardia" {{ request('rol') == 'guardia' ? 'selected' : '' }}>Guardia</option>
                <option value="servicios_escolares" {{ request('rol') == 'servicios_escolares' ? 'selected' : '' }}>
                    Servicios Escolares
                </option>
                <option value="visitante" {{ request('rol') == 'visitante' ? 'selected' : '' }}>Visitante</option>
            </select>

            {{-- 🛠️ FILTRO POR TALLER --}}
            <input type="text" name="taller" placeholder="Taller..." value="{{ request('taller') }}"
                class="text-xs px-3 py-2 rounded-xl border border-slate-200 focus:ring-2 focus:ring-blue-400 outline-none">

            {{-- BOTÓN --}}
            <button class="bg-slate-800 text-white px-4 py-2 rounded-xl text-xs font-bold hover:bg-black">
                Filtrar
            </button>

            {{-- LIMPIAR --}}
            <a href="{{ route('usuarios.index') }}"
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
                    <th class="px-6 py-4 text-left text-[10px] font-black uppercase">Usuario</th>
                    <th class="px-6 py-4 text-left text-[10px] font-black uppercase">Detalles</th>
                    <th class="px-6 py-4 text-center text-[10px] font-black uppercase">Rol</th>

                    @if($user->esEmpleado())
                        <th class="px-6 py-4 text-center text-[10px] font-black uppercase">Taller</th>
                        <th class="px-6 py-4 text-center text-[10px] font-black uppercase">QR</th>
                    @endif

                    <th class="px-6 py-4 text-center text-[10px] font-black uppercase">Acciones</th>
                </tr>
            </thead>

            {{-- BODY --}}
            <tbody class="divide-y divide-slate-100">

                @forelse($usuarios as $usuario)

                    <tr class="hover:bg-slate-50 transition {{ $user->id === $usuario->id ? 'bg-blue-50' : '' }}">

                        {{-- 👤 USUARIO --}}
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">

                                {{-- FOTO --}}
                                <div class="w-12 h-12">
                                    @if($usuario->foto && file_exists(public_path('storage/' . $usuario->foto)))
                                        <img src="{{ asset('storage/' . $usuario->foto) }}"
                                            class="w-12 h-12 rounded-full object-cover border-2 border-white shadow">
                                    @else
                                        <div
                                            class="w-12 h-12 rounded-full bg-slate-200 flex items-center justify-center font-bold text-slate-500">
                                            {{ strtoupper(substr($usuario->nombre, 0, 1)) }}
                                        </div>
                                    @endif
                                </div>

                                {{-- NOMBRE --}}
                                <div>
                                    <p class="text-sm font-black text-slate-800">
                                        {{ $usuario->nombre }} {{ $usuario->apellidos }}
                                    </p>
                                    <span class="text-[10px] text-blue-600 font-mono">
                                        #{{ $usuario->identificador }}
                                    </span>
                                </div>

                            </div>
                        </td>

                        {{-- 📋 DETALLES --}}
                        <td class="px-6 py-4 text-xs text-slate-600 space-y-1">

                            {{-- EMAIL --}}
                            <div>
                                <i class="fas fa-envelope text-slate-300 mr-1"></i>
                                {{ $usuario->email ?? 'Sin correo' }}
                            </div>

                            {{-- TELÉFONO --}}
                            @if($usuario->telefono)
                                <div>
                                    <i class="fas fa-phone text-slate-300 mr-1"></i>
                                    {{ $usuario->telefono }}
                                </div>
                            @endif

                            {{-- RESPONSABLE (clave para docentes/padres) --}}
                            @if($usuario->responsable_id && $user->esEmpleado())
                                <div class="text-amber-600 font-semibold">
                                    <i class="fas fa-user-shield mr-1"></i>
                                    Responsable ID: {{ $usuario->responsable_id }}
                                </div>
                            @endif

                        </td>

                        {{-- 🏷️ ROL --}}
                        <td class="px-6 py-4 text-center">
                            <span class="px-3 py-1 text-[9px] font-black rounded-full uppercase bg-slate-100">
                                {{ $usuario->rol }}
                            </span>
                        </td>

                        {{-- 🛠️ SOLO EMPLEADOS --}}
                        @if($user->esEmpleado())

                            {{-- TALLER --}}
                            <td class="px-6 py-4 text-center text-xs">
                                <span class="px-2 py-1 bg-blue-50 text-blue-700 rounded-lg font-bold text-[10px]">
                                    {{ $usuario->taller_asignado ?? 'N/A' }}
                                </span>
                            </td>

                            {{-- QR --}}
                            <td class="px-6 py-4 text-center">
                                @if($usuario->fotoqr)
                                    <img src="{{ asset('storage/' . $usuario->fotoqr) }}"
                                        class="w-10 h-10 mx-auto bg-white p-1 rounded-lg shadow">
                                @else
                                    <span class="text-[9px] text-slate-400">Sin QR</span>
                                @endif
                            </td>

                        @endif

                        {{-- ⚙️ ACCIONES --}}
                        <td class="px-6 py-4 text-center">
                            <div class="flex justify-center gap-4">

                                {{-- FICHA PÚBLICA (LIBRO) --}}
                                <a href="{{ route('usuarios.fichaPublica', $usuario->identificador) }}"
                                    class="text-slate-400 hover:text-indigo-500" title="Vista Pública">
                                    <i class="fas fa-book-open"></i>
                                </a>

                                {{-- VER (ADMIN) --}}
                                <a href="{{ route('usuarios.show', $usuario->identificador) }}"
                                    class="text-slate-400 hover:text-blue-500">
                                    <i class="fas fa-eye"></i>
                                </a>

                                {{-- EDITAR --}}
                                @if($user->rol === 'admin' || ($user->esEmpleado() && $usuario->rol !== 'admin'))
                                    <a href="{{ route('usuarios.edit', $usuario->identificador) }}"
                                        class="text-slate-400 hover:text-amber-500">
                                        <i class="fas fa-pen"></i>
                                    </a>
                                @endif

                                {{-- ELIMINAR --}}
                                @if($user->rol === 'admin' && $user->id !== $usuario->id)
                                    <form action="{{ route('usuarios.destroy', $usuario->identificador) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button class="text-slate-400 hover:text-red-500"
                                            onclick="return confirm('¿Eliminar usuario?')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                @endif

                            </div>
                        </td>

                    </tr>

                @empty
                    <tr>
                        <td colspan="6" class="text-center py-10 text-slate-400">
                            No hay usuarios disponibles
                        </td>
                    </tr>
                @endforelse

            </tbody>
        </table>
    </div>
</div>