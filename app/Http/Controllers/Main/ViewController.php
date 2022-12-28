<?php

namespace App\Http\Controllers\Main;

use DateInterval;
use Midtrans\Snap;
use App\Models\Book\Book;
use App\Models\Order\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\Category\Category;
use App\Models\Delivery\Delivery;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use App\Models\Order_detail\Order_detail;

class ViewController extends Controller
{
    public function index(Request $request)
    {
        
        
        $search = $request->q;

        
        $book = Book::all();
        $pencarian = Book::search($search)->get();
        // dd($book);


        return view('main.index', compact('book', 'search', 'pencarian'));
    }

    public function bukuPilihan(Request $request)
    {

        $f_category = $request->category;
        $search = $request->q;
        $min = $request->min;
        $max = $request->max;
        $high_price = $request->prices;
        $min_price = $request->price;
        $date = $request->date;

        if ($f_category) {
           $book = Book::filtercategory($f_category)->get();
        } elseif ($search) {
            $book = Book::search($search)->get();
        } elseif ($min && $max) {
            // dd('filter harga'); 
            $book = Book::rangeprice($min, $max)->get();
        } elseif ($high_price) {
            $book = Book::orderBy('price', 'DESC')->get();
        } elseif ($min_price) {
            $book = Book::orderBy('price', 'ASC')->get();
        } elseif ($date) {
            $book = Book::orderBy('created_at', 'DESC')->get();
            // DD($book);
        } else {
            $book = Book::all();
        }

        $category = Category::all();
       
        return view('main.bukuPilihan', compact('category', 'book'));
    }

    public function register()
    {

        return view('main.account.daftar');
    }

    public function login()
    {
        
        return view('main.account.login');
    }

    public function bukuProducts($slug)
    {

        $book = Book::where('slug', $slug)->get();
        foreach ($book as $b) {
        //  dd($b);     
        }

        $id = Auth::id();
        $dt = Carbon::now();
        $order_id = $dt->year . $dt->month . $dt->day . $dt->hour . $dt->minute . $dt->second . '-' . $id;

        return view('main.book-page', compact('book', 'b', 'order_id'));
    }

    public function riwayatPembelian()
    {
        $order = Order::where('user_id', Auth::id())->get();
        foreach ($order as $orders) {
            foreach ($orders->order_detail as $od) {
            }    
        }
        // dd($orders->order_detail);
        
        $order_detail = Order_detail::where('user_id', Auth::id())->first();
        // dd($order_detail);
        $book_id = explode(", ", $orders->order_detail->book_id);
        $buku_array = [];
        foreach ($book_id as $key) {
            $buku = Book::where('id', '=', $key)->first();
            array_push($buku_array, $buku);
        }
        // dd($buku_array);
        

        // $implode = $order->order_detail;

        return view('main.riwayatpembelian', compact('order', 'buku', 'buku_array', 'od', 'order_detail'));
    }

    public function detailTransaksi($id)
    {
        $order = Order::find($id);
        foreach ($order->order_detail as $key) {
            
        }
        
        $order_detail = Order_detail::where('user_id', Auth::id())->first();

        $book_id = explode(", ", $order->order_detail->book_id);
        $buku_array = [];
        foreach ($book_id as $key) {
            $buku = Book::where('id', '=', $key)->first();
            array_push($buku_array, $buku);
        }

// dd($buku);

        $username = auth()->user()->name;
        $email = auth()->user()->email;

        $id = Auth::id();
        $dt = Carbon::now();
        $order_id = $dt->year . $dt->month . $dt->day . $dt->hour . $dt->minute . $dt->second . '-' . $id;

        $delivery = Delivery::where('user_id', Auth::id())->first();

        $date = $order->created_at;
        // $paytime = $date->format('d m Y');
        $endtime = $date->add(new DateInterval("P1D"))->format('d m Y h:i:s');

        // dd($endtime);

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
                 'gross_amount' => $order->total_price,
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

        return view('main.detailtransaksi', compact('order', 'order_detail', 'buku_array', 'snapToken', 'delivery', 'endtime'));   
    }

}
