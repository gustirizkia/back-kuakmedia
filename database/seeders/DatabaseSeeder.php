<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory(20)->create();
        $this->call([
            CategorySeeder::class
        ]);
        \App\Models\Article::factory(40)->create();
        \App\Models\Komentar::factory(300)->create();
        \App\Models\LikeUser::factory(500)->create();
        \App\Models\LihatArtikel::factory(30)->create();
        \App\Models\ShareArticle::factory(120)->create();
        \App\Models\RekomendasiAdmin::factory(12)->create();
        \App\Models\Keresahan::factory(12)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
