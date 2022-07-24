<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Support\Facades\DB;

class ArtikelModel extends Model
{
    use HasFactory;
    use Sluggable;

    protected $table = 'articles';

    protected $casts = [
        'created_at' => 'datetime:d M Y H:i',
    ];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'judul'
            ]
        ];
    }


    protected $guarded = [];

    public function kategori(){
        return $this->belongsTo('App\Models\Category', 'category_id');
    }

    public function penulis(){
        return $this->belongsTo('App\Models\User', 'user_id');
    }

    public function komentar(){
        return $this->hasMany('App\Models\Komentar');
    }

    public function view(){
        return $this->hasMany('App\Models\LihatArtikel');
    }

    public function like(){
        return $this->hasMany('App\Models\LikeUser');
    }

    public function search($query, $keyword){
        return $query->where('judul', "LIKE", "%$keyword%");
    }

}
