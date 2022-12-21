<?php

namespace App\Models\Category;

use App\Models\Book\Book;
use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\Category\CategoryController;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;

    protected $table = 'categories';

    protected $guarded = '';

    public function book()
    {
        return $this->hasMany(Book::class);
    }
}
