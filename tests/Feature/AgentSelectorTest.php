<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Livewire\Livewire;
use App\Livewire\AgentSelector;
use App\Models\User;
use App\Models\Role;

class AgentSelectorTest extends TestCase
{
    use RefreshDatabase;

    public function test_agent_can_login_with_correct_credentials()
    {
        $role = Role::create(['name' => 'Pro']);
        $user = User::create([
            'name' => 'Test Agent',
            'email' => 'test@casino.com',
            'password' => bcrypt('password123'),
            'role_id' => $role->id,
            'can_create_notes' => true,
        ]);

        Livewire::test(AgentSelector::class)
            ->set('email', 'test@casino.com')
            ->set('password', 'password123')
            ->call('login')
            ->assertRedirect('/');
        $this->assertAuthenticatedAs($user);
    }

    public function test_agent_cannot_login_with_incorrect_credentials()
    {
        $role = Role::create(['name' => 'Pro']);
        User::create([
            'name' => 'Test Agent',
            'email' => 'test@casino.com',
            'password' => bcrypt('password123'),
            'role_id' => $role->id,
        ]);

        Livewire::test(AgentSelector::class)
            ->set('email', 'test@casino.com')
            ->set('password', 'wrongpassword')
            ->call('login')
            ->assertHasErrors(['email'])
            ->assertNoRedirect();
        $this->assertGuest();
    }
}
