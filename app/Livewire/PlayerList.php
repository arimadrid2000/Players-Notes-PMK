<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Player;

class PlayerList extends Component
{
    public function viewNotes($playerId)
    {
        $this->dispatch('goToNotes', playerId: $playerId);
    }

    public function render()
    {
        $players = Player::all();
        return view('livewire.player-list', compact('players'));
    }
}
