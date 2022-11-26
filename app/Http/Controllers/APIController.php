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
            'title' => 'nullable|max:255',
            'author_id' => ['nullable', 'numeric', Rule::In($authors)],
            'description' => 'nullable|max:2000',
            'publisher' => 'nullable|max:255',
            'edition' => 'nullable|max:255',
        ]);

        $book = Book::find($data['id']);
        if ($book == null)
            return response()->json(['error' => 'Book not found.'], 422);


        $book->update($data);
        return response()->json($book, 200);
    }

    public function destroy($id)
    {
        $book = Book::find($id);
        if ($book == null)
            return response()->json(['error' => 'Resource not found.'], 404);
        $book->delete();
        return response()->json(null, 204);
    }
}
