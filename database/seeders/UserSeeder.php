<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $agentRoleId = DB::table('roles')->where('name', 'agent')->value('id');
        $playerRoleId = DB::table('roles')->where('name', 'player')->value('id');

        $agents = ['Supervisor', 'Junior'];
        foreach ($agents as $index => $name) {
            User::firstOrCreate(
                ['email' => 'agent' . strtolower($name) . '@casino.com'],
                [
                    'name' => 'Agente ' . $name,
                    'password' => bcrypt('12345678'),
                    'role_id' => $agentRoleId,
                    'can_create_notes' => $name === "Supervisor",
                ]
            );
        }

        $players = ['Pedro', 'Juan', 'Maria'];
        foreach ($players as $index => $name) {
            User::firstOrCreate(['email' => strtolower($name) . '@casino.com'], [
                'name' => $name . ' Player',
                'password' => bcrypt('987654'),
                'role_id' => $playerRoleId,
            ]);
        }
    }
}
