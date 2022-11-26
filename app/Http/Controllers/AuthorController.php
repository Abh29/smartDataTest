<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Book;
use Illuminate\Http\Request;
use Ramsey\Uuid\Type\Integer;
use Illuminate\Validation\Rule;


class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $authors = Author::orderBy('created_at', 'DESC')->paginate(12);
        return view('main.author.index', ['authors' => $authors]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.author.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $author = new Author();

        $request->validate([
            'name' => 'required|max:255',
            'nick' => 'required|max:255',
            'birth_date' => 'required|date',
            'picture' => 'nullable|mimes:jpg,bmp,png|max:2048',
            'about_author' => 'max:5000',
        ]); 
        

        if($request->file()) {
            $fileName = time().'_'.$request->picture->getClientOriginalName();
            $filePath = $request->file('picture')->storeAs('uploads', $fileName, 'public');
            $author->picture = 'storage/' . $filePath;
        }

        $author->name = $request->get('name');
        $author->nick = $request->get('nick');
        $author->birth_date = $request->get('birth_date');
        $author->about_author = $request->get('about_author');

        $author->save();

        return redirect(route('admin.author.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $author = Author::find($id);
        if ($author == null)
            abort(404);
        return view('main.author.details', ['author' => $author]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(int $id)
    {
        $author = Author::find($id);
        if ($author == null)
            abort(404);
        return view('admin.author.edit', ['author' => $author]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
        $author = Author::find($id);
        if ($author == null) abort(404);

        $request->validate([
            'name' => 'required|max:255',
            'nick' => 'required|max:255',
            'birth_date' => 'required|date',
            'picture' => 'mimes:jpg,bmp,png|max:2048',
            'about_author' => 'max:5000',
        ]);     

        if($request->file()) {
            $fileName = time().'_'.$request->cover_picture->getClientOriginalName();
            $filePath = $request->file('picture')->storeAs('uploads', $fileName, 'public');
            $author->picture = 'storage/' . $filePath;
        }

        $author->name = $request->get('name');
        $author->nick = $request->get('nick');
        $author->birth_date = $request->get('birth_date');
        $author->about_author = $request->get('about_author');

        $author->save();

        return redirect(route('admin.author.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $author = Author::find($id);
        if ($author == null)
            return back();
        
        $books = $author->books;
        foreach ($books as $book)
            $book->delete();
        $author->delete();
        return redirect(route('admin.author.index'));
    }
}
