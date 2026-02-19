<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Dashboard extends Component
{

    public $currentScreen = 'agent_selection';
    public $selectedPlayerId = null;

    protected $listeners = [
        'agentLoggedIn' => 'showPlayerList',
        'goToNotes' => 'showNotes',
        'goBackToPlayers' => 'showPlayerList',
        'logout' => 'logoutAgent'
    ];

    public function mount()
    {
        if (Auth::check()) {
            $this->currentScreen = 'player_list';
        }
    }

    public function showPlayerList()
    {
        $this->selectedPlayerId = null;
        $this->currentScreen = 'player_list';
    }

    public function showNotes($playerId)
    {
        $this->selectedPlayerId = $playerId;
        $this->currentScreen = 'player_notes';
    }

    public function logoutAgent()
    {
        Auth::logout();
        $this->currentScreen = 'agent_selection';
    }

    public function render()
    {
        return view('livewire.dashboard')->layout('components.layouts.app');
    }
}
