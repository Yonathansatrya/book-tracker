<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\BookNote;
use App\Models\BookTracker;
use App\Models\UserBook;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MyBooksController extends Controller
{
    public function index()
    {
        $user = auth()->id();
        $books = UserBook::where('user_id', $user)
            ->with([
                'book.genres',
                'book.trackers' => function ($query) use ($user) {
                    $query->where('user_id', $user);
                }
            ])
            ->get();
        return view('pages.mybooks', compact('books'));
    }

    public function create()
    {
        return view('my_books.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255|unique:books,title',
            'author' => 'required|string|max:255',
            'published_year' => 'required|integer',
            'total_page' => 'required|integer|min:0',
            'description' => 'nullable|string',
            'cover_image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
            'genre_ids' => 'required|array',
            'average_rating' => 'nullable|numeric|min:0|max:5',
            'ratings_count' => 'nullable|integer|min:0',
        ]);

        // dd($request);

        $imagePath = $request->hasFile('cover_image')
            ? $request->file('cover_image')->store('covers', 'public')
            : null;

        $book = Book::create([
            'title' => $request->title,
            'author' => $request->author,
            'published_year' => $request->published_year,
            'total_page' => $request->total_page,
            'description' => $request->description,
            'average_rating' => $request->average_rating,
            'ratings_count' => $request->ratings_count,
            'cover_image' => $imagePath,
        ]);

        if ($request->has('genre_ids')) {
            $book->genres()->attach($request->genre_ids);
        }

        UserBook::create([
            'user_id' => auth()->id(),
            'book_id' => $book->id,
        ]);

        return redirect()->route('my-books.index')->with('success', 'Buku berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $userBook = UserBook::where('user_id', auth()->id())->where('book_id', $id)->firstOrFail();
        $book = $userBook->book;
        return view('my_books.edit', compact('book'));
    }

    public function update(Request $request, $id)
    {
        $userBook = UserBook::where('user_id', auth()->id())->where('book_id', $id)->firstOrFail();
        $book = $userBook->book;

        $request->validate([
            'title' => 'required|string|max:255|unique:books,title,' . $book->id,
            'author' => 'required|string|max:255',
            'published_year' => 'required|integer',
            'total_page' => 'required|integer|min:0',
            'description' => 'nullable|string',
            'cover_image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
            'genre_ids' => 'nullable|array',
            'average_rating' => 'nullable|numeric|min:0|max:5',
            'ratings_count' => 'nullable|integer|min:0',
        ]);

        if ($request->hasFile('cover_image')) {
            if ($book->cover_image) {
                Storage::disk('public')->delete($book->cover_image);
            }
            $book->cover_image = $request->file('cover_image')->store('covers', 'public');
        }

        $book->update([
            'title' => $request->title,
            'author' => $request->author,
            'published_year' => $request->published_year,
            'total_page' => $request->total_page,
            'description' => $request->description,
            'average_rating' => $request->average_rating,
            'ratings_count' => $request->ratings_count,
            'cover_image' => $book->cover_image,
        ]);

        if ($request->has('genre_ids')) {
            $book->genres()->sync($request->genre_ids);
        }

        return redirect()->route('my-books.index')->with('success', 'Buku berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $userBook = UserBook::where('user_id', auth()->id())->where('book_id', $id)->firstOrFail();
        $book = $userBook->book;

        // Optional: Cek apakah buku ini juga dipakai user lain
        $otherUsersCount = UserBook::where('book_id', $book->id)->where('user_id', '!=', auth()->id())->count();

        if ($book->cover_image) {
            Storage::disk('public')->delete($book->cover_image);
        }

        $userBook->delete();

        if ($otherUsersCount === 0) {
            $book->genres()->detach();
            $book->delete();
        }

        return redirect()->route('my-books.index')->with('success', 'Buku berhasil dihapus.');
    }
}
