<div class="bg-white p-8 rounded-xl shadow-lg border border-gray-100">
    <div class="text-center mb-8">
        <h1 class="text-3xl font-extrabold text-gray-800 mb-2">Inicio de sesión (BackOffice)</h1>
        <p class="text-gray-500">Selecciona tu perfil para iniciar sesión en el sistema.</p>
    </div>

    @if(isset($agentSup) && isset($agentJr))
        <div class="grid gap-4">
            <button wire:click="loginAs({{ $agentSup->id }})" class="flex items-center p-5 border-2 border-gray-100 rounded-lg hover:border-green-500 hover:bg-green-50 transition group w-full text-left">
                <div class="bg-green-100 p-3 rounded-full mr-4 group-hover:bg-green-200">
                    <span class="text-green-600 font-bold text-xl">S</span>
                </div>
                <div>
                    <span class="block font-bold text-lg text-gray-800">{{ $agentSup->name }}</span>
                    <span class="text-sm text-green-600 font-medium">✅ Permisos de Escritura</span>
                </div>
            </button>

            <button wire:click="loginAs({{ $agentJr->id }})" class="flex items-center p-5 border-2 border-gray-100 rounded-lg hover:border-blue-500 hover:bg-blue-50 transition group w-full text-left">
                <div class="bg-blue-100 p-3 rounded-full mr-4 group-hover:bg-blue-200">
                    <span class="text-blue-600 font-bold text-xl">J</span>
                </div>
                <div>
                    <span class="block font-bold text-lg text-gray-800">{{ $agentJr->name }}</span>
                    <span class="text-sm text-blue-600 font-medium">👀 Solo Lectura</span>
                </div>
            </button>
        </div>
    @else
        <p class="text-red-500 text-center">Faltan datos. Ejecuta los seeders.</p>
    @endif
</div>
