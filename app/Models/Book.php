<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'published_at', 'total_page', 'average_rating', 'ratings_count', 'description', 'cover_image'];

    public function genres()
    {
        return $this->belongsToMany(Genre::class, 'book_genres');
    }

    public function authors()
    {
        return $this->belongsToMany(Author::class, 'book_author');
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'book_users')
                    ->withPivot('status', 'last_read_page', 'rating', 'started_at', 'finished_at')
                    ->withTimestamps();
    }

    public function owners()
    {
        return $this->belongsToMany(User::class, 'user_books');
    }
}
