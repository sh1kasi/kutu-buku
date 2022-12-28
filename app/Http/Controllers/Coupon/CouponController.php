<?php

namespace App\Http\Controllers\Coupon;

use Illuminate\Http\Request;
use App\Models\Coupon\Coupon;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Order_detail\Order_detail;

class CouponController extends Controller
{
    public function index()
    {
        $coupon = Coupon::get();

        return view('Admin.Coupons.index', compact('coupon'));
    }

    public function create()
    {

        return view('Admin.Coupons.form');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'code' => 'required | unique:coupons',
            'type' => 'required',
            'value' => 'required'
        ]);

        $coupon = new Coupon();
        $coupon->code = $request->code;
        $coupon->type = $request->type;
        if ($request->type == 'percent') {
            $coupon->percent_off = $request->value;
        } elseif ($coupon->type == 'value') {
            $coupon->value = $request->value;
        }

        $coupon->save();

        return redirect()->route('coupon.index')->with('success', 'Voucher berhasil ditambahkan!');
    }

    public function destroy($id)
    {
        $coupon = Coupon::find($id);
        $coupon->delete();

        return redirect()->route('coupon.index');
    }

    public function check(Request $request)
    {
        $harga_total = $request->input('harga_total');
        // dd($harga_total);
        $code = $request->input('code');

        $coupon  = Coupon::where('code', $code)->first();
        $order_detail = Order_detail::where('user_id', Auth::id())->where('status', 'Pending')->first();

        // dd($order_detail->subtotal - 10000);

        
        if (!$coupon) {
            return response()->json([
                'message' => 'Kode kupon tidak ditemukan!',
                'status' => 0,
            ]);
        } elseif($coupon->type == 'percent') {
            $percent = ($coupon->percent_off / 100) * $order_detail->subtotal;
            $total_price = $order_detail->subtotal - $percent;
            $order_detail->subtotal = $total_price;
            $order_detail->update();

            return response()->json([
                'message' => 'Berhasil Menggunakan kupon diskon!',
                'code' => $coupon->code,
                'off' => $coupon->percent_off,
                'percent' => $percent,
                'status' => 1,
                'harga_total' => $order_detail->subtotal,
            ]);            
        } elseif($coupon->type == 'value') {
            $value = $order_detail->subtotal - $coupon->value;
            // dd($value);
            $order_detail->subtotal = $value;
            $order_detail->update();
            return response()->json([
                'message' => 'Berhasil Menggunakan kupon diskon!',
                'code' => $coupon->code,
                'off' => $coupon->value,
                'value' => $value,
                'status' => 2,
                'harga_total' => $order_detail->subtotal,
            ]);
        } else {
            echo "OKE";
        }
        
  
    }

    public function cancelCoupon(Request $request)
    {
        $real_price = $request->input('before_disc');
        $order_detail = Order_detail::where('user_id', Auth::id())->where('status', 'Pending')->first();
        $order_detail->subtotal = $real_price;
        $order_detail->save();

        return response()->json();
    }
}
