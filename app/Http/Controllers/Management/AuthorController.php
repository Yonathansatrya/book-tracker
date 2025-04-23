<?php

namespace App\Http\Controllers\Management;

use App\Models\Author;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AuthorController extends Controller
{
    public function index()
    {
        $authors = Author::all();
        return view('management_book.authors.index', compact('authors'));
    }

    public function create()
    {
        return view('management_book.authors.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'bio' => 'nullable|string',
        ]);

        Author::create($request->all());
        return redirect()->route('authors.index')->with('success', 'Author berhasil ditambahkan!');
    }

    public function edit(Author $author)
    {
        return view('management_book.authors.edit', compact('author'));
    }

    public function update(Request $request, Author $author)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'bio' => 'nullable|string',
        ]);

        $author->update($request->all());
        return redirect()->route('authors.index')->with('success', 'Author berhasil diperbarui!');
    }

    public function destroy(Author $author)
    {
        $author->delete();
        return redirect()->route('authors.index')->with('success', 'Author berhasil dihapus!');
    }
}
