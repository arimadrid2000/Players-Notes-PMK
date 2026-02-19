<?php

namespace App\Livewire;

use Livewire\Component;
use App\Repositories\PlayerNoteRepository;
use App\Models\Player;

class NoteList extends Component
{
    public $playerId;

    protected $listeners = ['noteAdded' => '$refresh'];

    public function render(PlayerNoteRepository $repo)
    {
        $notes = $repo->getNotesByPlayer($this->playerId);
        $player = Player::findOrFail($this->playerId);

        return view('livewire.note-list', compact('notes', 'player'));
    }
}
