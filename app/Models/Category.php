<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $guarded =[];

    public function sub(){
        return $this->hasMany('App\Models\Category', 'sub_judul');
    }

    public function artikel(){
        return $this->hasMany("App\Models\Article", 'category_id');
    }
}
