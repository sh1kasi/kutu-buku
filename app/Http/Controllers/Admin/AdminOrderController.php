<?php

namespace App\Http\Controllers\Admin;

use App\Models\Book\Book;
use App\Models\Order\Order;
use Illuminate\Http\Request;
use App\Models\Delivery\Delivery;
use App\Http\Controllers\Controller;
use App\Models\Order_detail\Order_detail;
use Illuminate\Support\Facades\Auth;

class AdminOrderController extends Controller
{
    public function index()
    {
        $order = Order::get();

        return view('Admin.order.index', compact('order'));
    }

    public function detail($order_id)
    {

        $order = Order::where('order_id', $order_id)->first();
        $delivery = Delivery::where('user_id', Auth::id())->first();

        $book_id = explode(", ", $order->order_detail->book_id);
            $buku_array = [];
            foreach ($book_id as $key) {
                $buku = Book::where('id', '=', $key)->first();
                array_push($buku_array, $buku);
            }

            // dd($buku_array);
        
        

        // dd($order);

        return view('Admin.order.detail', compact('order', 'delivery', 'buku_array'));
    }

    public function orderCount(Request $request)
    {
        $order = Order::count();
        
        return response()->json([
            'count' => $order,
        ]);
    }

    public function completeOrder(Request $request)
    {
        $order = Order::where('id', $request->id)->first();

        $order->status = 'completed';
        $order->save();

        return redirect('/order');
    }

    public function deleteOrder(Request $request)
    {
        $id = $request->id;
        Order_detail::where('order_id', $id)->each(function($order_detail){
            $order_detail->delete();
        });
        Order::where('id', $id)->delete();

        return redirect('/order');
    }
    
}
