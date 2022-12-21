<?php

namespace App\Http\Controllers\Main;

use App\Models\Book\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\Category\Category;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

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

        

        if ($request->category) {
           $book = Book::where('category_id', $request->category)->get();

        //    dd($book);
        }

        

        // dd($request);
        $category = Category::all();
        // $book = Book::all();
        // $book = Book::all();
        // $list = Category::where('slug', $request->category)->first();
        // // dd($list);
        // // dd($search);
        // // dd($pencarian);

        // $max = $book->max('price');
        // $min = $book->min('price');

        // // dd($max);

        // $min_harga = $request->min;

        // $max_harga = $request->max;


        // $range = $book->where('price', ">=", $min_harga)
        //               ->where('price', "<=", $max_harga);
        // // dd($range);
        // $filter_harga = $range->all();

        // dd($filter_harga);

        
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
        return view('main.riwayatpembelian');
    }

}
