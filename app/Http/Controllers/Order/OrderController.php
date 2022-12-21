<?php

namespace App\Http\Controllers\Order;

use Midtrans\Snap;
use Midtrans\Config;
use App\Models\Cart\Cart;
use App\Models\Order\Order;
use Illuminate\Http\Request;
use App\Models\Courier\Courier;
use App\Models\Delivery\Delivery;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Order_detail\Order_detail;

class OrderController extends Controller
{
    
    function addOrder(Request $request)
    {
        $total_price = $request->input('total_price');
        $harga_ongkir = $request->input('harga_ongkir');
        $delivery = Delivery::where('user_id', Auth::id())->first();
        $cart = Cart::where('user_id', Auth::id())->get();
        $orders = Order::where('user_id', Auth::id())->where('status', 'Unpaid')->first();
        // dd($orders);
        foreach ($cart as $data) {
            
        }
        if (!$orders) {
            $orders = new Order;
        } 
            $orders->user_id = Auth::id();
            $orders->name = $delivery->receiver;
            $orders->address = $delivery->address;
            $orders->phone = $delivery->phone;
            $orders->qty = $data->book_qty;
            $orders->ongkir_price = $harga_ongkir;
            $orders->total_price = $total_price;
            $orders->status = 'Unpaid';
            $orders->save();

            // $order = Order::where('user_id', Auth::id())->where('status', 'Unpaid')->first();

            // dd($order);

        return response()->json([
            'data'=>$orders,
        ]);
        
    }

    public function payment_post(Request $request)
    {
        // return $request;

        $json = json_decode($request->get('json'));
        $order_detail = Order_detail::where('user_id', Auth::id())->first();
        $delivery = Delivery::where('user_id', Auth::id())->first();
        $total_price = $request->input('total_price');
        $harga_ongkir = $request->input('harga_ongkir');
        $nama_ongkir = $request->input('nama_ongkir');


        $order = new Order;
        $order->order_detail_id =  $order_detail->id;
        $order->delivery_id = $delivery->id;
        $order->status = $json->transaction_status;
        $order->transaction_id = isset($json->transaction_id) ?  $json->transaction_id : null;
        $order->order_id = $json->order_id;
        $order->expedition = $nama_ongkir;
        $order->ongkir_price = $harga_ongkir;
        $order->total_price = $total_price;
        $order->gross_amount = $json->gross_amount;
        $order->payment_type = $json->payment_type;
        $order->payment_code = isset($json->payment_code) ? $json->payment_code : null;
        $order->pdf_url = isset($json->pfd_url) ? $json->pdf_url : null;


        // dd($order);

        $order->save();
    

        $order_detail->order_id = $order->id;
        $order_detail->save();
        // dd($order_detail);


        $cart = Cart::where('user_id', Auth::id())->get();
        foreach ($cart as $value) {
            $value->delete();
        }

        

        


    }
}
