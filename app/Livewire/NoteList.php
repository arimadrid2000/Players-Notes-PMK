<?php

namespace App\Livewire;

use Livewire\Component;
use App\Repositories\PlayerNoteRepository;
use App\Models\User;

class NoteList extends Component
{
    public $playerId;

    protected $listeners = ['noteAdded' => '$refresh'];

    public function render(PlayerNoteRepository $repo)
    {
        $notes = $repo->getNotesByPlayer($this->playerId);
        $player = User::find($this->playerId);

        return view('livewire.note-list', compact('notes', 'player'));
    }
}
