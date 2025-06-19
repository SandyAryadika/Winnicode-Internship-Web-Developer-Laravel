<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    protected $fillable = ['name', 'email', 'bio', 'photo', 'is_active', 'user_id'];

    public function articles()
    {
        return $this->hasMany(Article::class, 'author_id', 'id');
        // ->whereNotNull('published_at')
        // ->orderByDesc('published_at');
    }

    public function publishedArticles()
    {
        return $this->hasMany(Article::class, 'author_id', 'id')
            ->whereNotNull('published_at');
    }

    public function getPhotoUrlAttribute()
    {
        $storagePath = public_path('storage/' . $this->photo);
        $publicPath = public_path($this->photo); // untuk images/default.png

        if ($this->photo && file_exists($storagePath)) {
            return asset('storage/' . $this->photo);
        }

        if ($this->photo && file_exists($publicPath)) {
            return asset($this->photo);
        }

        return asset('images/default.png'); // fallback terakhir
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
