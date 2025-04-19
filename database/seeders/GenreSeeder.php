<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GenreSeeder extends Seeder
{
    public function run(): void
    {
        $genres = [
            ['name' => 'Fiction', 'description' => 'Narrative literary works created from the imagination.'],
            ['name' => 'Non-Fiction', 'description' => 'Prose writing based on facts, real events, and real people.'],
            ['name' => 'Fantasy', 'description' => 'Fiction with magical or supernatural elements.'],
            ['name' => 'Science Fiction', 'description' => 'Fiction based on futuristic concepts and science.'],
            ['name' => 'Mystery', 'description' => 'Fiction dealing with the solution of a crime or unraveling secrets.'],
            ['name' => 'Thriller', 'description' => 'Fiction intended to provoke excitement and suspense.'],
            ['name' => 'Romance', 'description' => 'Stories centered around love and relationships.'],
            ['name' => 'Horror', 'description' => 'Fiction meant to scare, unsettle, or horrify readers.'],
            ['name' => 'Biography', 'description' => 'A detailed description of a person’s life.'],
            ['name' => 'Autobiography', 'description' => 'A self-written account of the author\'s life.'],
            ['name' => 'History', 'description' => 'Books about past events and human affairs.'],
            ['name' => 'Self-help', 'description' => 'Books offering advice for personal improvement.'],
            ['name' => 'Philosophy', 'description' => 'Books dealing with fundamental nature of knowledge, existence, and reality.'],
            ['name' => 'Poetry', 'description' => 'Literary work in verse form, often expressive and rhythmic.'],
            ['name' => 'Drama', 'description' => 'Stories meant for theatrical performance.'],
            ['name' => 'Adventure', 'description' => 'Fiction involving exciting undertakings or explorations.'],
            ['name' => 'Young Adult', 'description' => 'Targeted at teens with coming-of-age themes.'],
            ['name' => 'Children\'s', 'description' => 'Books written specifically for children.'],
            ['name' => 'Comics', 'description' => 'Visual storytelling using sequential art.'],
            ['name' => 'Graphic Novels', 'description' => 'Narratives presented in comic-strip format and published as a book.'],
        ];

        foreach ($genres as $genre) {
            DB::table('genres')->insert([
                'name' => $genre['name'],
                'description' => $genre['description'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
