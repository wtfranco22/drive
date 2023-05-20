<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $rolAdmin = new Role();
        $rolAdmin->name = 'admin';
        $rolAdmin->save();

        $rolUser = new Role();
        $rolUser->name = 'user';
        $rolUser->save();
    }
}
