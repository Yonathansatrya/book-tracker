<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookTracker extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'book_id',
        'status',
        'last_read_page',
        'rating',
        'started_at',
        'finished_at'
    ];

    public function book()
    {
        return $this->belongsTo(Book::class);
    }

    public function notes()
    {
        return $this->hasMany(BookNote::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
