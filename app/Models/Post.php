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
    public function user(){
         return $this->belongsTo('App\Models\User');
    }
    protected $fillable = [
        'title',
        'contents',
        'fetured',
        'category_id',
        'slug',
        'user_id'
    ];
    protected $dates = [
        'deleted_at'
    ];



}
