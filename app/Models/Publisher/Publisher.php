<?php

namespace App\Models\Publisher;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\Publisher\PublisherController;

class Publisher extends Model
{
    use HasFactory;

    protected $table = 'publishers';
    protected $guarded = '';
}
