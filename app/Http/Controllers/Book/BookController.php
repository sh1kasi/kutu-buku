<?php

namespace App\Http\Controllers\Book;

use Carbon\Carbon;
use App\Models\Book\Book;
use App\Models\Cart\Cart;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Author\Author;
use App\Models\Pivot\Bookcate;
use App\Models\Category\Category;
use App\Models\Publisher\Publisher;
use App\Http\Controllers\Controller;

class BookController extends Controller
{
    public function index()
    {

        // $now = Carbon::now();
        // dd($now->year . $now->month . $now->day . '0' . $now->hour . $now->minute . $now->second);


        $book = Book::all();

        foreach ($book as $ky) {
            $key = $ky->title;
        }

        $category = Category::all();
        $author = Author::all();
        $publisher = Publisher::all();


        return view('Admin.Book.index', compact('book', 'author', 'publisher', 'category'));
    }

    public function create()
    {
        $publisher = Publisher::all();
        $author = Author::all();
        $category = Category::all();
        $book = Book::all();


        $book = Book::with('category')->first();


        return view('Admin.Book.form', compact('publisher', 'author', 'category', 'book'));
    }

    public function store(Request $request)
    {

        // dd($request);

        $this->validate($request, [
            'title' => 'required|unique:books,title',
            'year' => 'required',
            'description' => 'max:255',
            'author_id' => 'required',
            'publisher_id' => 'required',
            'category_id' => 'required',
            // 'cover' => 'required',
        ]);
       
        $data = $request->all();
        $data['slug'] = Str::slug($request->title);

        
      $book =  Book::create($data);
        

        if ($request->hasFile('cover')) {
            $request->file('cover')->move('coverimage/', $request->file('cover')->getClientOriginalName());
            $book->cover = $request->file('cover')->getClientOriginalName();
            $book->save();
        }

        return redirect()->route('book.index')->with('success', 'Buku berhasil ditambahkan!');
    
    }

    public function edit($id)
    {
        $book = Book::find($id);

        // dd($book->author);
            // if ($book->author_id == null) {
            //     // dd('kosong');
            // } elseif ($book->a) {
                
            // }

        // $pivot = Bookcate::where('id', $id)->get();

        // dd($pivot);

        // dd($book->category->id);

        // $book = Book::with('category')->get();

        // dd($book);


        // $kategori = Category::find($id);
        // dd($kategori);
        $author = Author::all();
        $publisher = Publisher::all();
        $category = Category::all();
        // dd($author);

        // foreach ($category as $cat) {
        //     if ($book->category->id == $cat->id) {
        //         dd('kosong');
        //     }
        // }

        

        return view('Admin.Book.edit', compact('book', 'author', 'publisher', 'category'));
    }

    public function update(Request $request, $id)
    {    
        $book = Book::find($id);

        $this->validate($request, [
            'title' => 'required',
            'category_id' => 'required',
            'year' => 'required|digits:4|integer|min:1900|max:'.(date('Y')+1),
            'author_id' => 'required',  
            'publisher_id' => 'required',
            'price' =>'required',
        ]);

        $data = $request->all();


        $book->update($data);

        if ($request->hasFile('cover')) {
            $request->file('cover')->move('coverimage/', $request->file('cover')->getClientOriginalName());
            $book->cover = $request->file('cover')->getClientOriginalName();
            $book->save();
        }

        // $test = Book::where('', $id)->delete();

       $categories = $request->category_id;

    //    $book->category()->attach($categories);

        return redirect()->route('book.index')->with('success', 'Buku berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $book = Book::find($id);
        Cart::where('book_id', $id)->each(function($cart) {
            $cart->delete();
        });
        // $cart = Cart::where('book_id', $id)->delete();
        // dd($cart);
        $book->delete();
        // $cart->delete();

        return redirect()->route('book.index');
    }

    // MODAL MODAL MODAL MODAL MODAL MODAL

    public function modalstore(Request $request)
    {
        $this->validate($request, [
            'desc' => 'max:255'
        ]);

        dd($request);
    }
}
