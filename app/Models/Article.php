<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Article extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'content',
        'thumbnail',
        'status',
        'category_id',
        'author_id',
        'published_at',
        'views',
        'is_hot',
        'is_headline',
        'is_featured',
        'is_editor_choice',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function author()
    {
        return $this->belongsTo(Author::class, 'author_id');
    }

    protected $casts = [
        'published_at' => 'datetime',
    ];

    public function getThumbnailUrlAttribute()
    {
        return $this->thumbnail && file_exists(public_path('storage/' . $this->thumbnail))
            ? asset('storage/' . $this->thumbnail)
            : asset('images/default.jpg');
    }
}
