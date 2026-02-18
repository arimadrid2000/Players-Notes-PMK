<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Prueba Técnica</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-lg">
        <h1 class="text-2xl font-bold mb-4 text-center">🧪 Panel de Pruebas</h1>
        <p class="text-gray-600 mb-6 text-center text-sm">
            Selecciona un jugador. El sistema te logueará automáticamente como
            <span class="font-bold text-indigo-600">Agente</span>.
        </p>

        @if(isset($agent) && $players->count() > 0)
            <div class="space-y-3">
                @foreach($players as $player)
                    <a href="{{ route('test.login', ['agentId' => $agent->id, 'playerId' => $player->id]) }}"
                       class="block p-4 border rounded hover:bg-indigo-50 hover:border-indigo-500 transition flex justify-between items-center group">
                        <div>
                            <span class="font-bold text-gray-800">{{ $player->name }}</span>
                            <span class="text-xs text-gray-500 block">{{ $player->email }}</span>
                        </div>
                        <span class="text-indigo-600 font-bold group-hover:translate-x-1 transition-transform">Ver Notas →</span>
                    </a>
                @endforeach
            </div>
        @else
            <div class="bg-red-100 text-red-700 p-4 rounded text-center">
                ⚠️ Faltan datos. Ejecuta: <br> <code>php artisan migrate:fresh --seed</code>
            </div>
        @endif
    </div>
</body>
</html>
