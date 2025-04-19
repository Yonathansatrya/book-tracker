<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'author',
        'total_page',
        'published_year',
        'average_rating',
        'ratings_count',
        'description',
        'cover_image'
    ];

    public function genres()
    {
        return $this->belongsToMany(Genre::class, 'book_genre');
    }

    public function trackers()
    {
        return $this->hasMany(BookTracker::class);
    }
}
