<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AgentSelector extends Component
{
    public function loginAs($agentId)
    {
        Auth::loginUsingId($agentId);

        $this->dispatch('agentLoggedIn');
    }

    public function render()
    {
        $agentSup = User::where('can_create_notes', true)->first();
        $agentJr  = User::where('can_create_notes', false)->first();

        return view('livewire.agent-selector', compact('agentSup', 'agentJr'));
    }
}
