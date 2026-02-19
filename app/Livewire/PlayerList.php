<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;

class PlayerList extends Component
{
    public function viewNotes($playerId)
    {
        $this->dispatch('goToNotes', playerId: $playerId);
    }

    public function render()
    {
        $players = User::whereHas('role', fn($q) => $q->where('name', 'player'))->get();
        return view('livewire.player-list', compact('players'));
    }
}
