<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Livewire\Livewire;
use App\Livewire\NoteForm;
use App\Models\User;
use App\Models\Role;
use App\Models\Player;

class NoteFormTest extends TestCase
{
    use RefreshDatabase;

    public function test_pro_agent_can_save_a_note()
    {
        $role = Role::create(['name' => 'Pro']);
        $proAgent = User::create([
            'name' => 'Supervisor',
            'email' => 'pro@casino.com',
            'password' => bcrypt('password'),
            'role_id' => $role->id,
            'can_create_notes' => true,
        ]);

        $player = Player::create([
            'name' => 'Juan Martinez',
            'email' => 'juan@casino.com',
            'wallet_balance' => 100,
            'is_active' => true
        ]);

        $this->actingAs($proAgent);

        Livewire::test(NoteForm::class, ['playerId' => $player->id])
            ->set('content', 'El jugador solicitó un aumento de límite.')
            ->call('saveNote')
            ->assertHasNoErrors()
            ->assertDispatched('noteAdded');
        $this->assertDatabaseHas('player_notes', [
            'user_id' => $proAgent->id,
            'player_id' => $player->id,
            'content' => 'El jugador solicitó un aumento de límite.',
        ]);
    }

    public function test_note_content_is_required_and_has_minimum_length()
    {
        $role = Role::create(['name' => 'Pro']);
        $proAgent = User::create([
            'name' => 'Supervisor',
            'email' => 'pro@casino.com',
            'password' => bcrypt('password'),
            'role_id' => $role->id,
            'can_create_notes' => true,
        ]);

        $this->actingAs($proAgent);

        Livewire::test(NoteForm::class, ['playerId' => 1])
            ->set('content', 'ola')
            ->call('saveNote')
            ->assertHasErrors(['content' => 'min']);

        Livewire::test(NoteForm::class, ['playerId' => 1])
            ->set('content', '')
            ->call('saveNote')
            ->assertHasErrors(['content' => 'required']);
    }

    public function test_standar_agent_cannot_save_a_note()
    {
        $role = Role::create(['name' => 'Standar']);
        $standarAgent = User::create([
            'name' => 'Junior',
            'email' => 'junior@casino.com',
            'password' => bcrypt('password'),
            'role_id' => $role->id,
            'can_create_notes' => false,
        ]);

        $player = Player::create([
            'name' => 'Maria Jugadora',
            'email' => 'maria@casino.com',
            'wallet_balance' => 50,
            'is_active' => true
        ]);

        $this->actingAs($standarAgent);

        Livewire::test(NoteForm::class, ['playerId' => $player->id])
            ->set('content', 'Intento de nota no autorizada')
            ->call('saveNote')
            ->assertForbidden();

        $this->assertDatabaseMissing('player_notes', [
            'content' => 'Intento de nota no autorizada',
        ]);
    }
}
