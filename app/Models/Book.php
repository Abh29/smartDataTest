<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'author_id', 'title', 'description', 'cover_picture',
        'publisher', 'edition', 'printed_at', 'rating',
        'language', 'page_count', 'book_text', 'updated_at',
        'created_at'
    ];


    public function author()
    {
        return $this->belongsTo(Author::class, 'author_id', 'id');
    }

}
