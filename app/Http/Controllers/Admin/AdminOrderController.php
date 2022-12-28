<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminOrderController extends Controller
{
    public function index()
    {
        $order = Order::get();

        return view('Admin.order.index', compact('order'));
    }

    public function detail()
    {
        
        return view('Admin.order.detail');
    }
}
