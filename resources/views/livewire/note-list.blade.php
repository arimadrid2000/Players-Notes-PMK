<div class="bg-white rounded-xl shadow border border-gray-100 overflow-hidden">
    <div class="bg-indigo-600 p-6 text-white flex justify-between items-center">
        <div>
            <h1 class="text-2xl font-bold">{{ $player->name }} (Listado de notas)</h1>
            <p class="text-indigo-200 text-sm">{{ $player->email }}</p>
        </div>
        <div class="text-center bg-indigo-700 px-4 py-2 rounded-lg">
            <span class="block text-2xl font-bold">{{ $notes->count() }}</span>
            <span class="text-xs uppercase opacity-75">Notas</span>
        </div>
    </div>
    <div class="p-6 space-y-4 border-l-2 border-gray-200 ml-8 my-4">
        @forelse($notes as $note)
            <div class="relative bg-gray-50 p-4 rounded-lg border border-gray-200">
                <div class="absolute -left-[42px] bg-white border-2 border-indigo-500 w-4 h-4 rounded-full mt-1"></div>

                <div class="flex justify-between items-start mb-2">
                    <span class="text-gray-700">{{ $note->content }}</span>
                    <span class="text-xs bg-gray-200 text-gray-600 px-2 py-0.5 rounded-full">{{ $note->formatted_date }}</span>
                </div>
                <p class="font-bold text-gray-900 text-sm">Creada por: {{ $note->author->name }}</p>
            </div>
        @empty
            <p class="text-center text-gray-500 py-6">No hay notas registradas para este jugador.</p>
        @endforelse
    </div>
</div>
