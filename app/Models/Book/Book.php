<?php

namespace App\Models\Book;

use App\Models\Cart\Cart;
use App\Models\Author\Author;
use App\Models\Category\Category;
use App\Models\Customer\Customer;
use App\Models\Publisher\Publisher;
use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\Book\BookController;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Book extends Model
{
    use HasFactory;

    protected $table = 'books';

    protected $guarded = '';
 
  
    public function publisher()
    {
        return $this->belongsTo(Publisher::class);
    }

  
    public function author()
    {
        return $this->belongsTo(Author::class);
    }


    public function category()
    {   
        return $this->belongsTo(Category::class);
    }

    public function customers()
    {
        return $this->belongsToMany(Customer::class);
    }


    public function scopeSearch($query, $search)
    {
        return $query->where('title', 'like', '%' .$search. '%');
    }

    public function scopeFiltercategory($query, $category)
    {
        return $query->where('category_id', $category);
    }

    public function scopeRangeprice($query, $min, $max)
    {
        return $query->where('price', '>=', $min)->where('price', '<=', $max);
    }

    // public function scopeDate($query, $date)
    // {
    //     return $query->where()
    // }

}
