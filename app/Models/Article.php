<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Support\Facades\DB;

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

    protected $appends = ['jumlah_share', 'status'];

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

    public function getJumlahShareAttribute(){
        $data = ShareArticle::where('article_id', $this->id)
            ->select(DB::raw("sum(jumlah) as total"))->first();
        if($data->total){
            return $data->total;
        }else{
            return 0;
        }
    }
    public function getStatusAttribute(){
        if($this->publish === "draft"){
          return "pending";
        }elseif($this->publish === "yes"){
          return "published";
        }else{
          return "failed";
        }
    }

    // public function getSlugArtikelAttribute(){
    //     return $this->slug;
    // }

}
