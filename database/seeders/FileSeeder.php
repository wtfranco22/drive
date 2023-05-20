<?php

namespace Database\Seeders;

use App\Models\File;
use Illuminate\Database\Seeder;

class FileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $fy = new File();
        $fy->folder_id=1;
        $fy->name = 'matematica 1';
        $fy->format = 'pdf';
        $fy->url = 'url_de_la_imagen_presentada_pronto_';
        $fy->save();

        $fy2 = new File();
        $fy2->folder_id=1;
        $fy2->name = 'lengua 1';
        $fy2->format = 'pdf';
        $fy2->url = 'url_de_la_imagen_presentada_aasdf_pronto_';
        $fy2->save();

        $fy3 = new File();
        $fy3->folder_id=1;
        $fy3->name = 'literatura 1';
        $fy3->format = 'word';
        $fy3->url = 'url_deaesentada_aasdf_pronto_';
        $fy3->save();

        $fy4 = new File();
        $fy4->folder_id=2;
        $fy4->name = 'idioma 2';
        $fy4->format = 'xls';
        $fy4->url = 'url_de_imagen_presentada_aasdf_pronto_';
        $fy4->save();

        $fy5 = new File();
        $fy5->folder_id=3;
        $fy5->name = 'contabilidad 3';
        $fy5->format = 'xls';
        $fy5->url = 'url_d_presentada_aasdf_pronto_';
        $fy5->save();

        $fy6 = new File();
        $fy6->folder_id=3;
        $fy6->name = 'filosofia 3';
        $fy6->format = 'pdf';
        $fy6->url = 'url_de_imagen_presentada_aasdf_pronto_filo';
        $fy6->save();
    }
}
