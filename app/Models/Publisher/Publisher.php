<?php

namespace App\Models\Publisher;

use App\Models\Book\Book;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Http\Controllers\Publisher\PublisherController;

class Publisher extends Model
{
    use HasFactory;

    protected $table = 'publishers';
    protected $guarded = '';


    // one-to-one, one-to-many, many-to-many? one-to-many
    // publisher punya banyak book

    /**
     * Get all of the books for the Publishee
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function books()
    {
        // return $this->hasMany(Book::class, 'foreign_key', 'local_key');
        return $this->belongsTo(Book::class, 'id', 'id');
    }


}
