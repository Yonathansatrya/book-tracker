<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Book;
use App\Models\Author;
use App\Models\Genre;

class BookSeeder extends Seeder
{
    public function run(): void
    {
        $authors = Author::factory()->count(5)->create();
        $genres = Genre::factory()->count(5)->create();

        Book::factory()->count(20)->create()->each(function ($book) use ($authors, $genres) {
            $book->authors()->attach($authors->random(1)->pluck('id')->toArray());
            $book->genres()->attach($genres->random(rand(1, 3))->pluck('id')->toArray());
        });
    }
}
