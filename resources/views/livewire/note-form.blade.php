<div>
    @can('create-notes')
        <div class="bg-white p-6 rounded-lg shadow border border-gray-100 mb-6">
            <h3 class="text-sm font-bold text-gray-700 mb-3 uppercase tracking-wide">Nueva Nota</h3>

            <form wire:submit.prevent="saveNote">
                <div class="mb-3">
                    <textarea wire:model.defer="content" rows="3"
                              class="w-full border-gray-300 rounded-lg shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                              placeholder="Escribe los detalles..."></textarea>

                    @error('content') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
                </div>

                <div class="flex justify-between items-center">
                    <div>
                        @if (session()->has('message'))
                            <span class="text-green-600 text-sm font-bold">✅ {{ session('message') }}</span>
                        @endif
                    </div>
                    <button type="submit" class="bg-indigo-600 text-white px-6 py-2 rounded-lg hover:bg-indigo-700 transition">
                        Guardar Nota
                    </button>
                </div>
            </form>
        </div>
    @else
        <div class="mb-6 bg-yellow-50 border-l-4 border-yellow-400 p-4 rounded text-yellow-700 text-sm">
            ⚠️ Modo de Solo Lectura. No tienes permisos para crear nuevas notas.
        </div>
    @endcan
</div>
