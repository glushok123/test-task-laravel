<?php

namespace Database\Seeders;

use DB;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        User::create([
            'name' => 'admin',
            'email' => 'admin@test.loc',
            'password' => Hash::make('password'),
        ]);

        User::factory()->count(15)->create();
    }
}