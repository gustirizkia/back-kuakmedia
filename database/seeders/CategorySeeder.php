<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $essai = Category::create([
            'nama' => 'Esai'
        ]);

        $subEsai = Category::create([
            'nama' => 'Studi Agama',
            'sub_judul' => $essai->id
        ]);
        $subEsai = Category::create([
            'nama' => 'Filsafat Islam',
            'sub_judul' => $essai->id
        ]);
        $subEsai = Category::create([
            'nama' => 'Gender',
            'sub_judul' => $essai->id
        ]);

        $viral = Category::create([
            'nama' => 'Viral'
        ]);

        $Estetika = Category::create([
            'nama' => 'Estetika'
        ]);

        // Cerpen, Puisi, Tafsir Sastra
        $subEstetika = Category::create([
            'nama' => 'Cerpen',
            'sub_judul' => $Estetika->id
        ]);
        $subEstetika = Category::create([
            'nama' => 'Puisi',
            'sub_judul' => $Estetika->id
        ]);
        $subEstetika = Category::create([
            'nama' => 'Tafsir',
            'sub_judul' => $Estetika->id
        ]);
        $subEstetika = Category::create([
            'nama' => 'Sastra',
            'sub_judul' => $Estetika->id
        ]);

        $UnekUnek = Category::create([
            'nama' => 'Unek-Unek'
        ]);

        $BukuFilm = Category::create([
            'nama' => 'Buku & Film'
        ]);

        // Resensi Buku, Review Film
        $subBukuFilm = Category::create([
            'nama' => 'Resensi Buku',
            'sub_judul' => $BukuFilm->id
        ]);
        $subBukuFilm = Category::create([
            'nama' => 'Review Film',
            'sub_judul' => $BukuFilm->id
        ]);

    }
}
