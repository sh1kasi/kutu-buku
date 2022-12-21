<?php

namespace App\Models\Order_detail;

use App\Models\Cart\Cart;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order_detail extends Model
{
    use HasFactory;

    protected $table = 'orders_details';
    protected $guarded = [];

    public function cart()
    {
        return $this->hasMany(Cart::class);
    }
}
