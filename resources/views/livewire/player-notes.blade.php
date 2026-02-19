<div class="max-w-4xl mx-auto py-8 px-4">

    <div class="flex justify-between items-center mb-8">
        <a href="{{ route('login') }}" class="flex items-center text-gray-500 hover:text-indigo-600 transition font-medium">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            Volver al Dashboard
        </a>

        <div class="text-right text-sm text-gray-400">
            Agente: <span class="font-bold text-gray-600">{{ Auth::user()->name }}</span>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-lg overflow-hidden border border-gray-100">

        <div class="bg-indigo-600 p-6 text-white flex justify-between items-center">
            <div>
                <h1 class="text-2xl font-bold flex items-center gap-2">
                    <svg class="w-6 h-6 opacity-75" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                    {{ $player->name }}
                </h1>
                <p class="text-indigo-200 text-sm ml-8">{{ $player->email }}</p>
            </div>
            <div class="text-center bg-indigo-700 bg-opacity-50 px-4 py-2 rounded-lg">
                <span class="block text-2xl font-bold">{{ $notes->count() }}</span>
                <span class="text-xs uppercase tracking-wide opacity-75">Notas</span>
            </div>
        </div>

        <div class="p-6">
            @can('create-notes')
                <div class="mb-8 bg-gray-50 p-5 rounded-lg border border-gray-200">
                    <h3 class="text-sm font-bold text-gray-700 mb-3 uppercase tracking-wide">Nueva Nota Interna</h3>

                    <form wire:submit.prevent="saveNote">
                        <div class="mb-3">
                            <textarea
                                wire:model.defer="content"
                                rows="3"
                                class="w-full border-gray-300 rounded-lg shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                placeholder="Escribe los detalles de la observación..."></textarea>

                            @error('content')
                                <span class="text-red-500 text-sm mt-1 block flex items-center gap-1">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>

                        <div class="flex justify-between items-center">
                            <div>
                                @if (session()->has('message'))
                                    <span
                                        x-data="{ show: true }"
                                        x-init="setTimeout(() => show = false, 3000)"
                                        x-show="show"
                                        class="text-green-600 text-sm font-bold flex items-center gap-1">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                        {{ session('message') }}
                                    </span>
                                @endif
                            </div>

                            <button type="submit"
                                    class="bg-indigo-600 text-white px-6 py-2 rounded-lg hover:bg-indigo-700 transition flex items-center gap-2 disabled:opacity-50"
                                    wire:loading.attr="disabled">
                                <span wire:loading.remove>Guardar Nota</span>
                                <span wire:loading>Guardando...</span>
                            </button>
                        </div>
                    </form>
                </div>
            @else
                <div class="mb-8 bg-yellow-50 border-l-4 border-yellow-400 p-4">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-yellow-400" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" /></svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm text-yellow-700">
                                Modo de Solo Lectura. No tienes permisos para crear nuevas notas.
                            </p>
                        </div>
                    </div>
                </div>
            @endcan

            <div class="space-y-6 relative border-l-2 border-gray-200 ml-3 pl-6 pb-4">
                @forelse($notes as $note)
                    <div class="relative">
                        <div class="absolute -left-[33px] bg-white border-2 border-indigo-500 w-4 h-4 rounded-full mt-1.5"></div>

                        <div class="bg-gray-50 p-4 rounded-lg border border-gray-200 hover:bg-white hover:shadow-sm transition">
                            <div class="flex justify-between items-start mb-2">
                                <div class="flex items-center gap-2">
                                    <span class="font-bold text-gray-900">{{ $note->author->name }}</span>
                                    <span class="text-xs bg-gray-200 text-gray-600 px-2 py-0.5 rounded-full">{{ $note->formatted_date }}</span>
                                </div>
                            </div>
                            <p class="text-gray-700 text-sm leading-relaxed">{{ $note->content }}</p>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-10">
                        <div class="text-gray-300 mb-2">
                            <svg class="w-16 h-16 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                        </div>
                        <p class="text-gray-500 font-medium">No hay historial disponible.</p>
                        <p class="text-sm text-gray-400">Las notas creadas aparecerán aquí.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</div>
