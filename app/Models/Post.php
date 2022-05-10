<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory;
    use SoftDeletes;

    public function  category(){
        return $this->belongsTo('App\Models\Category');
    }
    public function getFetured($fetured){
        return asset($fetured);
    }
    public function tags(){
        return $this->belongsToMany('App\Models\Tag');
    }
    protected $fillable = [
        'title',
        'contents',
        'fetured',
        'category_id',
        'slug'
    ];
    protected $dates = [
        'deleted_at'
    ];



}
