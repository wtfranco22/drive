<?php

namespace Database\Seeders;

use App\Models\Folder;
use Illuminate\Database\Seeder;

class FolderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $firtsYear = new Folder();
        $firtsYear->name = 'c1';
        $firtsYear->description = 'primer año';
        $firtsYear->url = 'url_de_la_imagen_presentada_pronto_';
        $firtsYear->save();

        $firtsYear2 = new Folder();
        $firtsYear2->name = 'c2';
        $firtsYear2->description = 'segundo año';
        $firtsYear2->url = 'url_de_la_imagen_presentada_pero_otra_je_pronto_';
        $firtsYear2->save();

        $firtsYear3 = new Folder();
        $firtsYear3->name = 'c3';
        $firtsYear3->description = 'tercer año';
        $firtsYear3->url = 'url_de_la_imagen_pronto_';
        $firtsYear3->save();
    }
}
