<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Player;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $proRoleId = DB::table('roles')->where('name', 'Pro')->value('id');
        $standardRoleId = DB::table('roles')->where('name', 'Standard')->value('id');

        $agents = ['Supervisor', 'Junior'];
        foreach ($agents as $index => $name) {
            User::firstOrCreate(
                ['email' => 'agent' . strtolower($name) . '@casino.com'],
                [
                    'name' => 'Agente ' . $name,
                    'password' => bcrypt('12345678'),
                    'role_id' => $name === "Supervisor" ? $proRoleId : $standardRoleId,
                    'can_create_notes' => $name === "Supervisor",
                ]
            );
        }

        $players = ['Pedro', 'Juan', 'Maria'];
        foreach ($players as $index => $name) {
            Player::firstOrCreate(['email' => strtolower($name) . '@casino.com'], [
                'name' => $name . ' Player',
            ]);
        }
    }
}
