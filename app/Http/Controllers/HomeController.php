<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Book;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return redirect(route('admin.author.index'));
    }

    public function books()
    {
        $books = Book::orderBy('created_at', 'DESC')->paginate(5);
        return view('admin.book.index', ['books' => $books]);
    }

    public function authors()
    {
        $authors = Author::orderBy('created_at', 'DESC')->paginate(5);
        return view('admin.author.index', ['authors' => $authors]);
    }


}
