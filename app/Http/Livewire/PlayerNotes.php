<?php

declare(strict_types=1);

namespace App\Http\Livewire;

use App\Models\User;
use App\Repositories\PlayerNoteRepository;
use Illuminate\View\View;
use Livewire\Component;

class PlayerNotes extends Component
{
    public User $player;
    public string $content = '';

    protected array $rules = [
        'content' => ['required', 'string', 'min:5', 'max:500'],
    ];

    public function mount(User $player): void
    {
        $this->player = $player;
    }

    public function saveNote(PlayerNoteRepository $repository): void
    {
        $this->validate();

        if (!auth()->user()->can('create-notes')) {
            abort(403, 'Unauthorized');
        }

        $repository->create([
            'user_id'   => auth()->id(),
            'player_id' => $this->player->id,
            'content'   => $this->content,
        ]);

        $this->reset('content');
        $this->emit('noteAdded');
    }

    public function render(PlayerNoteRepository $repository): View
    {
        $notes = $repository->getNotesByPlayer($this->player->id);

        return view('livewire.player-notes', [
            'notes' => $notes
        ]);
    }
}
