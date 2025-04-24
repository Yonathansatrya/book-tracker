<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function home()
    {
        return view('pages.dashboard');
    }

    public function mybooks(Request $request)
    {
        $status = $request->query('status');

        $query = auth()->user()->BookUser()->with('book');

        if ($status) {
            $query->where('status', $status);
        }

        $trackers = $query->get();
        $books = auth()->user()->userBook;

        return view('pages.mybooks', compact('books', 'trackers', 'status'));
    }

    public function comunity()
    {
        return view('pages.community');
    }

    public function seacrh()
    {
        //
    }
}
