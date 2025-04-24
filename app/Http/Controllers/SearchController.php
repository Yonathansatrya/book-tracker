<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Author;
use App\Models\Genre;
use App\Models\BookUser;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->input('q');

        $books = Book::with(['authors', 'genres'])
            ->where('title', 'like', "%{$query}%")
            ->orWhereHas('authors', fn($q) => $q->where('name', 'like', "%{$query}%"))
            ->orWhereHas('genres', fn($q) => $q->where('name', 'like', "%{$query}%"))
            ->orWhereHas('users', fn($q) => $q->where('status', $query))
            ->get();

        return view('search.results', compact('books', 'query'));
    }
}
