<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, HasRoles, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // User.php
    public function author()
    {
        return $this->hasOne(Author::class);
    }

    // Author.php
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getRoleListAttribute()
    {
        return $this->getRoleNames()->implode(', ');
    }

    public function articles()
    {
        return $this->hasMany(Article::class, 'author_id');
    }

    protected static function booted(): void
    {
        static::saved(function (User $user) {
            // Refresh roles relationship
            $user->load('roles');

            // Cek apakah user adalah writer dan belum punya author
            if ($user->hasRole('writer') && !$user->author()->exists()) {
                Author::create([
                    'user_id'   => $user->id,
                    'name'      => $user->name,
                    'email'     => $user->email,
                    'photo'     => 'images/default.png',
                    'is_active' => false,
                ]);
            }
        });
    }
}
