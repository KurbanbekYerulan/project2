<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'comment',
        'image',
        'user_id',
        'post_id'
    ];
    public function posts(){
        return $this->belongsTo('App\Models\Post');
    }
    public function users(){
        return $this->belongsTo('App\Models\User');
    }
}
