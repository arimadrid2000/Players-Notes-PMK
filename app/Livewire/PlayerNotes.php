<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;
use App\Repositories\PlayerNoteRepository;
use Illuminate\Support\Facades\Gate;
use Illuminate\View\View;

class PlayerNotes extends Component
{

    public User $player;

    public string $content = '';

    protected $rules = [
        'content' => 'required|min:5|max:500',
    ];

    public function mount(User $player)
    {
        $this->player = $player;
    }

    public function saveNote(PlayerNoteRepository $repository)
    {
        if (!Gate::allows('create-notes')) {
            abort(403, 'No tienes permisos para crear notas.');
        }

        $this->validate();

        $repository->create([
            'user_id' => auth()->id(),
            'player_id' => $this->player->id,
            'content' => $this->content,
        ]);
        $this->reset('content');
        session()->flash('message', 'Nota agregada correctamente.');
    }

    public function render(PlayerNoteRepository $repository): View
    {
        $notes = $repository->getNotesByPlayer($this->player->id);

        return view('livewire.player-notes', [
            'notes' => $notes
        ])->layout('components.layouts.app');
    }
}
