<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Genre;
use App\Models\Author;
use App\Models\UserBook;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UserBookController extends Controller
{
    public function index()
    {
        $userBooks = UserBook::with('book')->where('user_id', Auth::id())->get();
        return view('user_books.index', compact('userBooks'));
    }

    public function create()
    {
        $books = Book::all();
        $genres = Genre::all();
        $authors = Author::all();
        return view('user_books.create', compact('books', 'genres', 'authors'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'published_year' => 'required|integer',
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

        if ($request->has('author_ids')) {
            $book->authors()->attach($request->author_ids);
        }

        UserBook::create([
            'user_id' => Auth::id(),
            'book_id' => $book->id,
            'status' => $request->status,
        ]);

        return redirect()->route('user-books.index')->with('success', 'Buku berhasil ditambahkan ke daftar!');
    }

    public function edit(UserBook $userBook)
    {
        $book = $userBook->book;
        $genres = Genre::all();
        $authors = Author::all();
        return view('user_books.edit', compact('userBook', 'book', 'genres', 'authors'));
    }

    public function update(Request $request, $id)
    {
        $userBook = UserBook::where('user_id', auth()->id())->where('id', $id)->firstOrFail();
        $book = $userBook->book;

        $request->validate([
            'title' => 'required|string|max:255|unique:books,title,' . $book->id,
            'published_year' => 'required|integer',
            'total_page' => 'required|integer|min:0',
            'description' => 'nullable|string',
            'cover_image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
            'genre_ids' => 'nullable|array',
            'author_ids' => 'nullable|array',
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
        
        if ($request->has('author_ids')) {
            $book->authors()->sync($request->author_ids);
        }

        return redirect()->route('user-books.index')->with('success', 'Buku berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $userBook = UserBook::where('user_id', auth()->id())->where('id', $id)->firstOrFail();
        $book = $userBook->book;

        $otherUsersCount = UserBook::where('book_id', $book->id)
            ->where('user_id', '!=', auth()->id())
            ->count();

        if ($book->cover_image && $otherUsersCount === 0) {
            Storage::disk('public')->delete($book->cover_image);
        }

        $userBook->delete();

        if ($otherUsersCount === 0) {
            $book->genres()->detach();
            $book->authors()->detach();
            $book->delete();
        }

        return redirect()->route('user-books.index')->with('success', 'Buku berhasil dihapus dari daftar Anda.');
    }
}
