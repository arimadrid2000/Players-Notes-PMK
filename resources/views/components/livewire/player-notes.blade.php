<div class="bg-white p-6 rounded-lg shadow-md">
    <h2 class="text-xl font-bold mb-4 text-gray-800">Historial de Notas de Jugador {{ $player->name }}</h2>

    @can('create-notes')
        <form wire:submit.prevent="saveNote" class="mb-6">
            <div class="mb-2">
                <label for="content" class="sr-only">New Note</label>
                <textarea
                    wire:model.defer="content"
                    id="content"
                    rows="3"
                    class="w-full border-gray-300 rounded shadow-sm focus:ring-blue-500 focus:border-blue-500"
                    placeholder="Escribe una nota..."
                ></textarea>
                @error('content') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="text-right">
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                    Guardar
                </button>
            </div>
        </form>
    @endcan

    <div class="space-y-4">
        @forelse($notes as $note)
            <div class="border-l-4 border-blue-500 bg-gray-50 p-3 rounded">
                <div class="flex justify-between items-center mb-1">
                    <span class="font-bold text-gray-700">{{ $note->author->name }}</span>
                    <span class="text-xs text-gray-500">{{ $note->formatted_date }}</span>
                </div>
                <p class="text-gray-800 text-sm">{{ $note->content }}</p>
            </div>
        @empty
            <p class="text-center text-gray-500">No hay notas para este jugador.</p>
        @endforelse
    </div>
</div>
