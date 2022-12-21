<?php

namespace App\Models\Cart;

use App\Models\Book\Book;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cart extends Model
{
    use HasFactory;

    protected $tables = 'carts';
    protected $guarded = '';

    public function book()
    {
        return $this->belongsTo(Book::class);
    }
}
