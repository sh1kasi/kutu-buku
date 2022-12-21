<?php

namespace App\Models\Author;

use App\Models\Book\Book;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Author extends Model
{
    use HasFactory;

    protected $table = 'authors';
    protected $guarded = '';

   
    public function book()
    {
        return $this->hasMany(Book::class);
    }
}
