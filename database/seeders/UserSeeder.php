<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'id'      => 'jonievendi',
            'name'      => 'joni',
            'email'     => 'jonior999@gmail.com',
            'password'  => bcrypt('jonior999'),
            'role'  => 'Admin',
        ]);
    }
}
