<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = new User();
        $admin->role_id = 1;
        $admin->active = true;
        $admin->name = 'admin';
        $admin->email = 'example@gmail.com';
        $admin->password = Hash::make('admin123');
        $admin->save();

        $user = new User();
        $user->role_id = 2;
        $user->active = true;
        $user->name = 'franco';
        $user->email = 'wtfranco22@gmail.com';
        $user->password = Hash::make('franco123');
        $user->save();
    }
}
