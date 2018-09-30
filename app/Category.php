<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';

    protected $fillable = ['name', 'description'];

    public $timestamps = false;

    public function posts()
    {
        return $this->hasMany(Post::class)->orderByDesc('id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class)->orderByDesc('id');
    }
}
