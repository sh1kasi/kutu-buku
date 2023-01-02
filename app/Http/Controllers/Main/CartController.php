<?php

namespace App\Http\Controllers\Main;

use Carbon\Carbon;
use Midtrans\Snap;
use Midtrans\Config;
use App\Models\Book\Book;
use App\Models\Cart\Cart;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Delivery\Delivery;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\Order_detail\Order_detail;

class CartController extends Controller
{
    public function addBook(Request $request)
    {
        $book_id = $request->input('book_id');
        $book_qty = $request->input('book_qty');

        if (Auth::check())
        {
            $book_check = Book::where('id', $book_id)->first();
            // dd($book_check);

            if ($book_check)
            {

                if (Cart::where('book_id', $book_id)->where('user_id', Auth::id())->exists())
                {
                    $cart = Cart::where('book_id', $book_id)->where('user_id', Auth::id())->first();
                    // dd($cart);
                    $data = $cart->book_qty + $book_qty;
                    $cart->update(['book_qty' => $data]);
                     return response()->json([
                        'status' =>201,
                        'message'=>'Ditambahkan ke Keranjang',
                    ]);
                }
                else
                {
                    $keranjang = new Cart();
                    $keranjang->user_id = Auth::id();
                    $keranjang->book_id = $book_id;
                    $keranjang->book_qty = $book_qty;
                    $keranjang->save();

                    $book_check->cart_id = $keranjang->id;
                    $book_check->save();

                    return response()->json([
                        'status' =>200,
                        'message'=>$book_check->title. " Berhasil Ditambahkan ke Keranjang",
                        'data'=>$book_check,
                    ]);
                }
            }

        }
        else
        {
            // dd('login sek mas');

            return response()->json([
                'status' => 401,
                'message' => 'Login Untuk Melanjutkan',
            ]);
        }
    }

    public function view()
    {    
        $cartitems = Cart::where('user_id', Auth::id())->get();

        // $cart = Cart::where('user_id', Auth::id())->pluck('book_id')->toArray();
        

        

        $id = Auth::id();
        $dt = Carbon::now();
        $order_id = $dt->year . $dt->month . $dt->day . $dt->hour . $dt->minute . $dt->second . '-' . $id;
        
            // $di = Cart::get();
            // dd($di->id);
        
        return view('main.keranjang', compact('cartitems', 'order_id'));
    }

    public function checkout_post(Request $request)
    {
        $order_detail = Order_detail::where('user_id', Auth::id())->where('status', 'Pending')->first();
        $cart = Cart::where('user_id', Auth::id())->get();

        $qty = 0;
        $total_price = 0;
        foreach ($cart as $item) {
                $qty += $item->book_qty;
                $total_price += $item->book_qty * $item->book->price;
        }   
        
        // dd($qty);




        $cart_book_id = Cart::where('user_id', Auth::id())->pluck('book_id')->toArray();
        // $book_id_array = collect($cart_book_id)->implode(', ');
        // dd($book_id_array);
        

        if (!$order_detail) {
            $order_detail = new Order_detail;
        }
        $order_detail->user_id = $request->user_id;
        $order_detail->book_id = collect($cart_book_id)->implode(', ');
        $order_detail->qty = $qty;
        $order_detail->subtotal = $total_price;
        $order_detail->status = "Pending";
        $order_detail->save();
        // dd($snapToken);
        

        return redirect()->route('checkoutView');
    }

    public function checkout_post_update(Request $request)
    {

        $total_price = $request->input('total_price');
        // $harga_ongkir = $request->input('harga_ongkir');
        // $nama_ongkir = $request->input('nama_ongkir');

        $order_detail = Order_detail::where('user_id', Auth::id())->where('status', 'Pending')->first();
        
        $order_detail->subtotal = $total_price; 
        $order_detail->update();

        return response()->json();
    }

    public function updateCart(Request $request)
    {
        $book_id = $request->input('book_id');
        $book_qty = $request->input('book_qty');

        if (Auth::check())
        {
            if (Cart::where('book_id', $book_id)->where('user_id', Auth::id())->exists())
            {
                $cart = Cart::where('book_id', $book_id)->where('user_id', Auth::id())->first();
                $cart->book_qty = $book_qty;
                $cart->update();

                return response()->json(['status' => 'Jumlah Produk Berhasil di Tambah']);
            }
        }
    }

    public function deleteBook(Request $request)
    {
        if (Auth::check())
        {
            $book_id = $request->input('book_id');
            if (Cart::where('book_id', $book_id)->where('user_id', Auth::id())->exists())
            {
                $cartitems = Cart::where('book_id', $book_id)->where('user_id', Auth::id())->first();
                $cartitems->delete();
                return response()->json(['status' => 'Product Berhasil Terhapus' ]);
            }
        }
        else
        {
            return response()->json(['status' => 'Login Untuk Menlanjutkan!' ]);
        }
    }

    public function counter()
    {
        $cart = Cart::where('user_id', Auth::id())->get();
        foreach ($cart as $key) {
            $qty = $key->book_qty;
            $qty += $qty;
        }
        
        return view('layouts.main', compact('qty'));
    }
    
    public function midtransPay(Request $reqeust)
    {

        $username = auth()->user()->name;
        $email = auth()->user()->email;

        $id = Auth::id();
        $dt = Carbon::now();
        $order_id = $dt->year . $dt->month . $dt->day . $dt->hour . $dt->minute . $dt->second . '-' . $id;

        $delivery = Delivery::where('user_id', Auth::id())->first();
        $order_detail = Order_detail::where('user_id', Auth::id())->where('status', 'Pending')->first();
        

        // Set your Merchant Server Key
        \Midtrans\Config::$serverKey = 'SB-Mid-server-J8mqAmHwAdqx78u29VEj1F1C';
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = false;
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = true;

        $params = array(
            'transaction_details' => array(
                'order_id' => $order_id,
                'gross_amount' => $order_detail->subtotal
            ),
            'customer_details' => array(
                'first_name' => $username,
                'last_name' => " ",
                'email' => $email,
                'phone' => $delivery->phone,
            ),
            'shipping_address' => array(
                "first_name" => $delivery->receiver,
                "last_name" => " ",
                "email" => $email,
                "phone" => $delivery->phone,
                "address" => $delivery->address,
                "city" => $delivery->regency->name,
                "country_code" => "IDN"
            ),
        );

        $snapToken = \Midtrans\Snap::getSnapToken($params);

        return response()->json([
            'snaptoken' => $snapToken,
        ]);

    }

    public function massDelete(Request $request)
    {
        $id = $request->input('selectedId');
        Cart::where('user_id', Auth::id())->whereIn('book_id', $id)->delete();
        // $cart->delete();
    }
}
