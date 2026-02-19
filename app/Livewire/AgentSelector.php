<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Validate;

class AgentSelector extends Component
{
    #[Validate('required|email')]
    public $email = '';

    #[Validate('required')]
    public $password = '';

    public function login()
    {
        $this->validate();

        if (Auth::attempt(['email' => $this->email, 'password' => $this->password])) {
            return redirect()->to('/');
        } else {
            $this->addError('email', 'Las credenciales no coinciden con nuestros registros.');
        }
    }

    public function render()
    {
        $agentSup = User::where('can_create_notes', true)->first();
        $agentJr  = User::where('can_create_notes', false)->first();

        return view('livewire.agent-selector', compact('agentSup', 'agentJr'));
    }
}
