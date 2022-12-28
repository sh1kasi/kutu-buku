<?php

namespace App\Http\Controllers;

use App\Models\Order\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ApiController extends Controller
{
    public function payment_handler(Request $request)
    {
        $serverkey = env("MIDTRANS_SERVER_KEY");

        $signature_key = hash('sha512', $request->order_id.$request->status_code.$request->gross_amount.$serverkey);
        // dd($serverkey);
// return $signature_key;
        if ($signature_key != $request->signature_key) {
            dd('gabisa ngab');
        }
        // Success Status
        $order = Order::where('order_id', $request->order_id)->first();
        return $order->update(['status' => $request->transaction_status]);

    }
}
