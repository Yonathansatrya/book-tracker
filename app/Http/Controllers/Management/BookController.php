<?php

namespace App\Http\Controllers\Management;

use App\Models\Book;
use App\Models\Genre;
use App\Models\Author;
use App\Models\UserBook;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::with(['genres', 'authors'])->get();
        return view('management_book.books.index', compact('books'));
    }

    public function show($id)
    {
        $books = Book::with(['genres', 'authors'])->get();
        return view('management_book.books.show', compact('books'));
    }

    public function create()
    {
        $authors = Author::all();
        $genres = Genre::all();
        return view('management_book.books.create', compact('genres', 'authors'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'published_at' => 'required|date',
            'total_page' => 'required|integer|min:0',
            'description' => 'nullable|string',
            'cover_image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
            'genre_ids' => 'required|array',
            'author_ids' => 'required|array',
            'average_rating' => 'nullable|numeric|min:0|max:5',
            'ratings_count' => 'nullable|integer|min:0',
        ]);

        if ($request->hasFile('cover_image')) {
            $imagePath = $request->file('cover_image')->store('covers', 'public');
        } else {
            $imagePath = null;
        }

        $book = Book::create([
            'title' => $request->title,
            'published_at' => $request->published_at,
            'total_page' => $request->total_page,
            'description' => $request->description,
            'average_rating' => $request->average_rating,
            'ratings_count' => $request->ratings_count,
            'cover_image' => $imagePath,
        ]);

        if ($request->has('genre_ids')) {
            $book->genres()->attach($request->genre_ids);
        }

        if ($request->has('author_ids')) {
            $book->authors()->attach($request->author_ids);
        }

        return redirect()->route('books.index')->with('success', 'Buku berhasil ditambahkan!');
    }

    public function edit(Book $book)
    {
        $authors = Author::all();
        $genres = Genre::all();
        return view('management_book.books.edit', compact('book', 'genres', 'authors'));
    }

    public function update(Request $request, Book $book)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'total_page' => 'required|integer|min:0',
            'published_at' => 'required|date',
            'description' => 'nullable|string',
            'cover_image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
            'genre_ids' => 'required|array',
            'author_ids' => 'required|array',
            'average_rating' => 'nullable|numeric|min:0|max:5',
            'ratings_count' => 'nullable|integer|min:0',
        ]);

        if ($request->hasFile('cover_image')) {
            if ($book->cover_image) {
                Storage::delete('public/' . $book->cover_image);
            }

            $imagePath = $request->file('cover_image')->store('covers', 'public');
        } else {
            $imagePath = $book->cover_image;
        }

        $book->update([
            'title' => $request->title,
            'published_at' => $request->published_at,
            'total_page' => $request->total_page,
            'description' => $request->description,
            'average_rating' => $request->average_rating,
            'ratings_count' => $request->ratings_count,
            'cover_image' => $imagePath,
        ]);

        $book->genres()->sync($request->genre_ids);
        $book->authors()->sync($request->author_ids);

        return redirect()->route('books.index')->with('success', 'Buku berhasil diperbarui!');
    }

    public function destroy(Book $book)
    {
        if ($book->cover_image) {
            Storage::delete('public/' . $book->cover_image);
        }

        $book->authors()->detach();
        $book->genres()->detach();
        $book->delete();

        return redirect()->route('books.index')->with('success', 'Buku berhasil dihapus!');
    }
}
