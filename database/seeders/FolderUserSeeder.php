<?php

namespace Database\Seeders;

use App\Models\FolderUser;
use Illuminate\Database\Seeder;

class FolderUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $folder = new FolderUser();
        $folder->folder_id = 1;
        $folder->user_id = 2;
        $folder->save();
    }
}
