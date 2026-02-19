<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Player;
use App\Models\Role;
use App\Models\PlayerNote;

class PlayerNoteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {;
        $agent = User::where('role_id', Role::where('name', 'Pro')->value('id'))->first();
        $player = Player::first();

        if (!$agent || !$player) {
            return;
        }

        PlayerNote::create([
            'user_id' => $agent->id,
            'player_id' => $player->id,
            'content' => 'Nota mas antigua.',
            'created_at' => now()->subDays(5),
        ]);

        // Nota de Ayer
        PlayerNote::create([
            'user_id' => $agent->id,
            'player_id' => $player->id,
            'content' => 'Nota de ayer',
            'created_at' => now()->subDay(),
        ]);

        // Nota de Hoy
        PlayerNote::create([
            'user_id' => $agent->id,
            'player_id' => $player->id,
            'content' => 'Nota de hoy.',
            'created_at' => now(),
        ]);
    }
}
