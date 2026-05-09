<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserAccountSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        DB::table('users')->insert([
            [
                'email' => 'johndoe@example.com',
                'fullname' => 'John Doe',
                'password' => bcrypt('password'),
                'role' => 'customer',
            ],
            [
                'email' => 'justinparlan@example.com',
                'fullname' => 'Justin Parlan',
                'password' => bcrypt('password'),
                'role' => 'admin',
            ],
        ]);

    }
}
