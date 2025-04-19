<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class BookNote extends Model
{
    use HasFactory;

    protected $fillable = [
        'book_tracker_id',
        'page_start',
        'page_end',
        'notes',
    ];

    public function tracker()
    {
        return $this->belongsTo(BookTracker::class, 'book_tracker_id');
    }
}
