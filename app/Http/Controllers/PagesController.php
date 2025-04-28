<?php

namespace App\Http\Controllers;

use App\Models\BookUser;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function home()
    {
        $user = auth()->id();

        $Completedbook = BookUser::where('user_id', $user)
            ->where('status', 'finished')
            ->count();

        $ScheduleBooks = BookUser::where('user_id', $user)
            ->where('status', 'reading')
            ->join('books', 'book_users.book_id', '=', 'books.id')
            ->whereRaw('book_users.last_read_page < books.total_page')
            ->count();

        $totalBook = BookUser::where('user_id', $user)->count();

        return view('pages.dashboard', compact('Completedbook', 'ScheduleBooks', 'totalBook'));
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
