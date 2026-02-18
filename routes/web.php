<?php

use Illuminate\Support\Facades\Route;
use App\Http\Livewire\PlayerNotes;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('/', function () {
    $agent = User::whereHas('role', fn($q) => $q->where('name', 'agent'))->first();
    $players = User::whereHas('role', fn($q) => $q->where('name', 'player'))->get();

    return view('dashboard', compact('agent', 'players'));
})->name('home');

Route::get('/test-login/{agentId}/{playerId}', function ($agentId, $playerId) {
    Auth::loginUsingId($agentId);
    return redirect()->route('player.notes', ['player' => $playerId]);
})->name('test.login');

Route::middleware('auth')->group(function () {
    Route::get('/players/{player}/notes', PlayerNotes::class)->name('player.notes');
});
