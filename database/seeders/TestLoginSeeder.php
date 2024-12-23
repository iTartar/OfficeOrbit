<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class TestLoginSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Truncate the testlogin table
        DB::table('testlogin')->truncate();

        // Insert test users
        DB::table('testlogin')->insert([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => Hash::make('password123'),
            'role' => 'admin',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('testlogin')->insert([
            'name' => 'User',
            'email' => 'user@example.com',
            'password' => Hash::make('password123'),
            'role' => 'user',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
    }
}