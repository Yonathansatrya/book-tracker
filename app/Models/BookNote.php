<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookNote extends Model
{
    use HasFactory;

    protected $fillable = ['book_user_id', 'page_start', 'page_end', 'notes'];

    public function bookUser()
    {
        return $this->belongsTo(BookUser::class);
    }
}
