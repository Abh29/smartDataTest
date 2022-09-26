<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Author;
use Illuminate\Validation\Rule;

class APIController extends Controller
{
    
    public function index()
    {
        return Book::all();
    }


    public function store(Request $request)
    {
        return 'hello store';
    }

    public function show(int $id)
    {
        $book = Book::find($id);
        if ($book == null)
             return response()->json(['error' => 'Book not found'], 404);
        return $book;
    }

    public function update(Request $request)
    {
        $authors = Author::pluck('id');

        $data = $request->validate([
            'id' => 'required|numeric',
            'title' => 'bail|required|max:255',
            'author_id' => ['required', 'numeric', Rule::In($authors)],
            'description' => 'required|max:2000',
            'publisher' => 'required|max:255',
            'edition' => 'required|max:255',
        ]);

        $book = Book::find($data['id']);
        if ($book == null)
            return response()->json(['error' => 'Book not found'], 404);


        $book->update($request->all());
        return response()->json($book, 200);
    }

    public function destroy($id)
    {
        $book = Book::find($id);
        if ($book == null)
            return response()->json(['error' => 'Resource not found'], 404);
        $book->delete();
        return response()->json(null, 204);
    }
}
