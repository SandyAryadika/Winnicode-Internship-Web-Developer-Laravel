<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    protected $fillable = ['name', 'email', 'bio', 'photo', 'is_active', 'user_id'];

    public function articles()
    {
        return $this->hasMany(Article::class);
    }
    public function getPhotoUrlAttribute()
    {
        return $this->photo ? asset('storage/' . $this->photo) : asset('images/default-avatar.png');
    }
    public function getArticleCountAttribute()
    {
        return $this->articles()->count();
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
