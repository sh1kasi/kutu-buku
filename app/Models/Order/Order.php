<?php

namespace App\Models\Order;

use App\Models\Coupon\Coupon;
use Illuminate\Database\Eloquent\Model;
use App\Models\Order_detail\Order_detail;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';
    protected $guarded = [];

    public function order_detail()
    {
        return $this->belongsTo(Order_detail::class);
    }

    public function coupon()
    {
        return $this->belongsTo(Coupon::class);
    }
}
