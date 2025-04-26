<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $queryParam = $request->input('q');

        $booksQuery = Book::with(['authors', 'genres']);

        if ($queryParam) {
            $booksQuery->where(function ($q) use ($queryParam) {
                $q->where('title', 'like', "%{$queryParam}%")
                    ->orWhereHas('authors', fn($q) => $q->where('name', 'like', "%{$queryParam}%"))
                    ->orWhereHas('genres', fn($q) => $q->where('name', 'like', "%{$queryParam}%"));
            });
        }

        if ($request->filled('posted') && $request->input('posted') !== 'all') {
            switch ($request->input('posted')) {
                case 'today':
                    $booksQuery->whereDate('created_at', today());
                    break;
                case 'week':
                    $booksQuery->whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()]);
                    break;
                case 'month':
                    $booksQuery->whereMonth('created_at', now()->month);
                    break;
                case 'year':
                    $booksQuery->whereYear('created_at', now()->year);
                    break;
            }
        }

        if ($request->filled('categories')) {
            $booksQuery->whereHas('genres', function ($q) use ($request) {
                $q->whereIn('name', $request->input('categories'));
            });
        }

        if ($request->filled('authors')) {
            $authorName = $request->input('authors');

            $booksQuery->whereHas('authors', function ($query) use ($authorName) {
                $query->where(function ($q) use ($authorName) {
                    foreach ($authorName as $name) {
                        $q->orWhere('name', 'like', '%' . $name . '%');
                    }
                });
            });
        }

        if ($request->filled('rating')) {
            $booksQuery->where('average_rating', '>=', $request->input('rating'));
        }

        if ($request->filled('type')) {
            $types = $request->input('type');

            if (in_array('short', $types)) {
                $booksQuery->where('total_page', '<', 100);
            }
            if (in_array('medium', $types)) {
                $booksQuery->WhereBetween('total_page', [100, 300]);
            }
            if (in_array('long', $types)) {
                $booksQuery->Where('total_page', '>', 300);
            }
        }

        if ($request->filled('published')) {
            switch ($request->input('published')) {
                case 'today':
                    $booksQuery->whereDate('published_at', today());
                    break;
                case 'week':
                    $booksQuery->whereBetween('published_at', [now()->startOfWeek(), now()->endOfWeek()]);
                    break;
                case 'month':
                    $booksQuery->whereMonth('published_at', now()->month);
                    break;
                case 'year':
                    $booksQuery->whereYear('published_at', now()->year);
                    break;
                case 'all-time':
                    break;
                case 'setup':
                    break;
            }
        }

        $books = $booksQuery->get();

        return view('search.results', [
            'books' => $books,
            'query' => $queryParam,
        ]);
    }
}
