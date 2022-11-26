<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Models\User;
use App\Models\Book;
use App\Models\Author;
use Tests\TestCase;

class ApiTest extends TestCase
{
    protected $bearerToken;
    protected $user;

    protected function setUp(): void
    {
        parent::setUp();

        
        if (User::all()->count() < 1) 
            $this->seed();

        $response = $this->post('/api/v1/login', [
            'email' => 'admin@example.com',
            'password' => 'password'
        ]);
        
        $this->bearerToken = $response['token'];
        $this->user = $response['user'];

        $this->assertNotNull($this->bearerToken);

    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_api_books_list()
    {
        $response = $this->get('/api/v1/books/list');

        $response->assertStatus(200);
        $response->assertJsonCount(Book::all()->count());
    }


    public function test_api_books_byid()
    {
        $book = Book::first();
        if ($book == null) {
            Book::factory(5)->create();
            $book = Book::first();
        }

        $this->assertNotNull($book);

        $response = $this->get('/api/v1/books/2000');

        $response->assertStatus(404);
        $response->assertJsonFragment([
            "error" => "Book not found",
        ]);


        $response = $this->get('/api/v1/books/'.$book->id);

        $response->assertStatus(200);
        $response->assertJsonFragment([
            'id' => $book->id,
            "author_id" => $book->author_id,
            "title" => $book->title,
            "description" => $book->description,
            "publisher" =>  $book->publisher,
            "edition" =>  $book->edition,
            "printed_at" =>  $book->printed_at,
            "rating" =>  $book->rating,
            "language" =>  $book->language,
            "pages_count" =>  $book->pages_count,
            "book_text" => $book->book_text,
        ]);

    }


    public function test_api_books_update()
    {
        $book = Book::first();
        $author = Author::first();

        if ($book == null || $author == null) {
            Author::factory(2)->create();
            Book::factory(5)->create();
            $book = Book::first();
            $author = Author::first();
        }

        $this->assertNotNull($book);
        $this->assertNotNull($author);

        $response = $this->post('/api/v1/books/update', [
            'id' => -1
        ], [
            'Accept' => 'application/json'
        ]);

        $response->assertStatus(401);
        $response->assertJsonFragment([
            "message" => "Unauthenticated."
        ]);


        $response = $this->post('/api/v1/books/update', [
            'id' => -1
        ],[
            'Accept' => 'application/json',
            'Authorization'=>'Bearer '. $this->bearerToken,
        ]);
    
        $response->assertStatus(422);
        $response->assertJsonFragment([
            "error" => "Book not found."
        ]);

        $response = $this->post('/api/v1/books/update', [
            'id' => 1,
            'author_id' => -1,
        ],[
            'Accept' => 'application/json',
            'Authorization'=>'Bearer '. $this->bearerToken,
        ]);
    
        $response->assertStatus(422);
        $response->assertJsonFragment([
            "message" => "The selected author id is invalid.",
        ]);

        $response = $this->post('/api/v1/books/update', [
            'id' => $book->id,
            'author_id' => 1,
            'title' => 'New Title',
            'description' => 'New Description'
        ],[
            'Accept' => 'application/json',
            'Authorization'=>'Bearer '. $this->bearerToken,
        ]);
    
        $response->assertStatus(200);
        $response->assertJsonFragment([
            'id' => $book->id,
            "author_id" => 1,
            "title" => 'New Title',
            "description" => 'New Description',
            "publisher" =>  $book->publisher, // these should not change
            "edition" =>  $book->edition,
            "printed_at" =>  $book->printed_at,
            "rating" =>  $book->rating,
            "language" =>  $book->language,
            "pages_count" =>  $book->pages_count,
            "book_text" => $book->book_text,
        ]);

        $book_edited = Book::find($book->id);
        $this->assertEquals($book_edited->author_id, 1);
        $this->assertEquals($book_edited->title, 'New Title');
        $this->assertEquals($book_edited->description, 'New Description');
        $this->assertEquals($book_edited->publisher, $book->publisher);
        $this->assertEquals($book_edited->printed_at, $book->printed_at);
        $this->assertEquals($book_edited->edition, $book->edition);
        $this->assertEquals($book_edited->rating, $book->rating);
        $this->assertEquals($book_edited->language, $book->language);
        $this->assertEquals($book_edited->page_count, $book->page_count);
        $this->assertEquals($book_edited->book_text, $book->book_text);

    }

    public function test_api_books_delete()
    {
        $response = $this->delete('/api/v1/books/1', [], [
            'Accept' => 'application/json',
        ]);

        $response->assertStatus(401);
        $response->assertJsonFragment([
            "message" => "Unauthenticated."
        ]);


        $response = $this->delete('/api/v1/books/-1', [], [
            'Accept' => 'application/json',
            'Authorization'=>'Bearer '. $this->bearerToken,
        ]);

        $response->assertStatus(404);
        $response->assertJsonFragment([
            "error" => "Resource not found."
        ]);


        $book = Book::first();
        if ($book == null) {
            Author::factory(2)->create();
            Book::factory(5)->create();
            $book = Book::first();
        }
            
        $this->assertNotNull($book);

        $response = $this->delete('/api/v1/books/'.$book->id, [], [
            'Accept' => 'application/json',
            'Authorization'=>'Bearer '. $this->bearerToken,
        ]);

        $response->assertStatus(204);
       
        $book = Book::find($book->id);
        $this->assertNull($book);

    }

    public function test_api_login()
    {

        $response = $this->post('/api/v1/login', [], [
            'Accept' => 'application/json'
        ]);

        $response->assertStatus(422);


        $response = $this->post('/api/v1/login', [
            'email' => 'wrongEmail@example.com',
            'password' => 'password'
        ]);

        $response->assertStatus(401);
        $response->assertJsonFragment([
            'error' => 'Wrong email or password',
        ]);


        $response = $this->post('/api/v1/login', [
            'email' => 'admin@example.com',
            'password' => 'wrongPassword'
        ]);

        $response->assertStatus(401);
        $response->assertJsonFragment([
            'error' => 'Wrong email or password',
        ]);

        
        $response = $this->post('/api/v1/login', [
            'email' => 'admin@example.com',
            'password' => 'password'
        ]);

        $response->assertStatus(200);
        $this->assertNotNull($response['token']);
    }


    public function test_api_logout()
    {
        $response = $this->post('/api/v1/logout', [], [
            'Accept' => 'application/json',
        ]);
    
        $response->assertStatus(401);
        $response->assertJsonFragment([
            "message" => "Unauthenticated."
        ]);


        $response = $this->post('/api/v1/logout', [], [
            'Accept' => 'application/json',
            'Authorization'=>'Bearer '. $this->bearerToken,
        ]);
    
        $response->assertStatus(200);
        $response->assertJsonFragment([
            "massage" => "logged out"
        ]);


        $response = $this->post('/api/v1/logout', [], [
            'Accept' => 'application/json',
            'Authorization'=>'Bearer '. $this->bearerToken,
        ]);
    
        $response->assertStatus(200);
        $response->assertJsonFragment([
            "massage" => "logged out"
        ]);

    }


}
