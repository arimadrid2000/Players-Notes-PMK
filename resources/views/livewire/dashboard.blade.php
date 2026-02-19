<div class="min-h-screen bg-gray-100 font-sans">

    @if(Auth::check())
        <div class="bg-slate-800 p-4 flex justify-between items-center text-white shadow-md">
            <div>
                <p class="text-xs text-slate-400 uppercase tracking-wider">Logueado como:</p>
                <p class="font-bold text-lg">{{ Auth::user()->name }}</p>
            </div>
            <button wire:click="logoutAgent" class="text-sm bg-red-600 hover:bg-red-700 px-4 py-2 rounded transition flex items-center gap-2">
                Cerrar Sesión
            </button>
        </div>
    @endif

    <div class="max-w-4xl mx-auto py-8 px-4">

        @if($currentScreen === 'agent_selection')
            @livewire('agent-selector')

        @elseif($currentScreen === 'player_list')
            @livewire('player-list')

        @elseif($currentScreen === 'player_notes')
            <div class="mb-4">
                <button wire:click="showPlayerList" class="text-indigo-600 font-bold hover:underline">
                    &larr; Volver al Listado
                </button>
            </div>

            @livewire('note-form', ['playerId' => $selectedPlayerId])
            @livewire('note-list', ['playerId' => $selectedPlayerId])
        @endif

    </div>
</div>
