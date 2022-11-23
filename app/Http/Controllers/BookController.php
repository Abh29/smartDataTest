<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Author;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $books = Book::paginate(15);
        return view('main.book.index', ['books' => $books]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $authors = Author::all();
        return view('admin.book.create', ['authors' => $authors]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $book = new Book();

        $authors = Author::pluck('id');
        $request->validate([
            'title' => 'bail|required|max:255',
            'author_id' => ['required', 'numeric', Rule::In($authors)],
            'description' => 'required|max:2000',
            'publisher' => 'required|max:255',
            'edition' => 'required|max:255',
            'pages' => 'required|integer',
            'cover_picture' => 'nullable|mimes:jpg,bmp,png|max:2048',
            'book_text' => ''
        ]);

        if($request->file()) {
            $fileName = time().'_'.$request->cover_picture->getClientOriginalName();
            $filePath = $request->file('cover_picture')->storeAs('uploads', $fileName, 'public');
            $book->cover_picture = 'storage/' . $filePath;
        }

        $book->title = $request->get('title');
        $book->author_id = (int)($request->get('author_id'));
        $book->description = $request->get('description');
        $book->publisher = $request->get('publisher');
        $book->edition = $request->get('edition');
        $book->pages_count = (int)($request->get('pages'));
        $book->book_text = $request->get('book_text');

        $book->save();

        return redirect(route('admin.book.index'));

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $book = Book::find($id);
        if ($book == null)
            abort(404);
        return view('main.book.details', ['book' => $book]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $book = Book::find($id);
        if ($book == null) abort(404);
        $authors = Author::all();
        return view('admin.book.edit', ['book' => $book, 'authors' => $authors]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $book = Book::find($id);
        if ($book == null) abort(404);
        $authors = Author::pluck('id');

        $request->validate([
            'title' => 'bail|required|max:255',
            'author_id' => ['required', 'numeric', Rule::In($authors)],
            'description' => 'required|max:2000',
            'publisher' => 'required|max:255',
            'edition' => 'required|max:255',
            'cover_picture' => 'mimes:jpg,bmp,png|max:2048',
            'book_text' => ''
        ]);     

        if($request->file()) {
            $fileName = time().'_'.$request->cover_picture->getClientOriginalName();
            $filePath = $request->file('cover_picture')->storeAs('uploads', $fileName, 'public');
            $book->cover_picture = 'storage/' . $filePath;
        }

        $book->title = $request->get('title');
        $book->author_id = (int)($request->get('author_id'));
        $book->description = $request->get('description');
        $book->publisher = $request->get('publisher');
        $book->edition = $request->get('edition');
        $book->book_text = $request->get('book_text');

        $book->save();

        return redirect(route('admin.book.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $book = Book::find($id);
        if ($book != null) 
            $book->delete();
        return back();
    }
}
