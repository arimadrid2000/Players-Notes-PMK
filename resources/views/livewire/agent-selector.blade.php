<div class="bg-white p-8 rounded-xl shadow-lg border border-gray-100 w-full max-w-md mx-auto">
    <div class="text-center mb-8">
        <h1 class="text-3xl font-extrabold text-gray-800 mb-2">Acceso al Sistema</h1>
        <p class="text-gray-500">Ingresa tus credenciales de agente.</p>
    </div>

    <form wire:submit.prevent="login" class="space-y-5">
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Correo Electrónico</label>
            <input type="email" wire:model="email"
                   class="w-full border-gray-300 rounded-lg shadow-sm focus:border-indigo-500 focus:ring-indigo-500 p-2.5 border"
                   placeholder="ejemplo@casino.com">
            @error('email') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Contraseña</label>
            <input type="password" wire:model="password"
                   class="w-full border-gray-300 rounded-lg shadow-sm focus:border-indigo-500 focus:ring-indigo-500 p-2.5 border"
                   placeholder="••••••••">
            @error('password') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
        </div>

        <button type="submit"
                class="w-full bg-indigo-600 text-white font-bold py-3 px-4 rounded-lg hover:bg-indigo-700 transition flex justify-center items-center">
            <span wire:loading.remove>Iniciar Sesión</span>
            <span wire:loading>Verificando...</span>
        </button>
    </form>
</div>
