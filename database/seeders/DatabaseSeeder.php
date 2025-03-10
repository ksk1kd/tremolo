<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\User::factory()->create([
            'name' => 'Bob ',
            'email' => 'bob@example.com',
            'password' => Hash::make('uHrdx55u'),
        ]);

        \App\Models\User::factory()->create([
            'name' => 'John',
            'email' => 'john@example.com',
            'password' => Hash::make('uHrdx55u'),
        ]);
    }
}
