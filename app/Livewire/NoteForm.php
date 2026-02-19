<?php

namespace App\Livewire;

use Livewire\Component;
use App\Repositories\PlayerNoteRepository;
use Illuminate\Support\Facades\Gate;

class NoteForm extends Component
{
    public $playerId;
    public $content = '';

    protected $rules = ['content' => 'required|min:5|max:500'];

    public function saveNote(PlayerNoteRepository $repo)
    {
        if (!Gate::allows('create-notes')) abort(403, 'No tienes permisos.');

        $this->validate();

        $repo->create([
            'user_id' => auth()->id(),
            'player_id' => $this->playerId,
            'content' => $this->content,
        ]);

        $this->reset('content');
        session()->flash('message', 'Nota guardada con éxito.');

        $this->dispatch('noteAdded');
    }

    public function render()
    {
        return view('livewire.note-form');
    }
}
