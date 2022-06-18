<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Article extends Model
{
    use HasFactory;
    use Sluggable;

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
}
