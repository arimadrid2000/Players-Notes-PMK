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

        User::firstOrCreate(
            ['email' => 'agent@casino.com'],
            [
                'name' => 'Agent User',
                'password' => bcrypt('password'),
                'role_id' => $agentRoleId,
            ]
        );

        $players = ['Pedro', 'Juan', 'Maria'];
        foreach ($players as $index => $name) {
            User::firstOrCreate(['email' => strtolower($name) . '@casino.com'], [
                'name' => $name . ' Player',
                'password' => bcrypt('password'),
                'role_id' => $playerRoleId,
            ]);
        }
    }
}
