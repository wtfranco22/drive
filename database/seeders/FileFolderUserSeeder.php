<?php

namespace Database\Seeders;

use App\Models\FileFolderUser;
use Illuminate\Database\Seeder;

class FileFolderUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $historyFolder = new FileFolderUser();
        $historyFolder->file_id = 1;
        $historyFolder->folder_id = 1;
        $historyFolder->user_id = 2;
        $historyFolder->save();
        
        $historyFolder2 = new FileFolderUser();
        $historyFolder2->file_id = 2;
        $historyFolder2->folder_id = 1;
        $historyFolder2->user_id = 2;
        $historyFolder2->save();

        $historyFolder3 = new FileFolderUser();
        $historyFolder3->file_id = 3;
        $historyFolder3->folder_id = 1;
        $historyFolder3->user_id = 2;
        $historyFolder3->save();
    }
}
