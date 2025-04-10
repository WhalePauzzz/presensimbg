<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
	public function run()
    {
        // Admin
        User::create([
            'name' => 'Admin1',
            'email' => 'admin1@gmail.com',
            'password' => Hash::make('admin1234'),
            'role' => 'admin',
        ]);

        // Guru
        User::create([
            'name' => 'guru1',
            'email' => 'guru@gmail.com',
            'password' => Hash::make('guru1234'), 
            'role' => 'guru',
        ]);
    }
}
