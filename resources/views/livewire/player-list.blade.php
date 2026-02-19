<div class="bg-white p-8 rounded-xl shadow-lg border border-gray-100">
    <h2 class="text-xl font-bold text-gray-700 mb-6 border-b pb-2">Listado de Jugadores</h2>

    <div class="grid gap-3">
        @forelse($players as $player)
            <button wire:click="viewNotes({{ $player->id }})" class="w-full group flex items-center justify-between p-4 border rounded-lg hover:border-indigo-500 hover:shadow-md transition bg-white text-left">
                <div class="flex items-center gap-4">
                    <div class="bg-indigo-50 text-indigo-600 w-10 h-10 rounded-full flex items-center justify-center font-bold">
                        {{ substr($player->name, 0, 1) }}
                    </div>
                    <div>
                        <span class="block font-bold text-gray-800 group-hover:text-indigo-600 transition">{{ $player->name }}</span>
                        <span class="text-sm text-gray-500">{{ $player->email }}</span>
                    </div>
                </div>
                <span class="text-gray-300 group-hover:text-indigo-600 font-bold">Ver Notas &rarr;</span>
            </button>
        @empty
            <p class="text-gray-500 text-center py-4">No hay jugadores registrados.</p>
        @endforelse
    </div>
</div>
