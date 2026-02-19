<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('roles')->insertOrIgnore([
            ['id' => 1, 'name' => 'Pro', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 2, 'name' => 'Standard', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
