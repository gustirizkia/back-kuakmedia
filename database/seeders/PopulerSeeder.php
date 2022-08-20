<?php

namespace Database\Seeders;

use App\Models\Article;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


class PopulerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $artikel = Article::limit(14);

        // foreach($artikel as $item){
        //     DB::table('article_populers')->insertGetId([
        //         'article_id' => $item->id,
        //         'view' => 
        //     ]);
        // }
    }
}
