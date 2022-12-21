<?php

namespace App\Http\Controllers\Author;

use App\Models\Book\Book;
use Illuminate\Http\Request;
use App\Models\Author\Author;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class AuthorController extends Controller
{
    
    
    public function index()
    {
        $author = Author::all();

        return view('Admin.Author.index', compact('author'));
    }

    public function create()
    {
        
        return view('Admin.Author.form');
    }

    public function store(Request $request)
    {

        // dd($request);

        $this->validate($request, [
            'name' => 'required',
            'address' => 'required',
        ]);

        // dd($request);

        $data = $request->all();

        // dd($data);

        Author::create($data);

        return redirect()->route('author.index')->with('success', 'Author berhasil ditambahkan!');
    
    }

    public function modalStore(Request $request) {
        // dd($request);    

      $validator = Validator::make($request->all(), [
            'name_author' => 'required',
            'address' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status'=>400,
                'errors'=>$validator->messages(),
            ]);
        } else {
            $author = new Author;
            $author->name = $request->name_author;
            $author->address = $request->address;
            $author->save();
            return response()->json([
                'status'=>200,
                'message'=>'Author Berhasil Ditambahkan',
                'data'=>$author,
            ]);
        }


    }

    public function edit($id)
    {
        $author = Author::find($id);
        

        $relasi = Book::with('author')->where('author_id', $id)->get();
        dd($relasi);
        // dd($category);

        return view('Admin.Author.edit', compact('author'));
    }

    public function update(Request $request, $id)
    {    
        $author = Author::find($id);



        $this->validate($request, [
            'name' => 'required',
            'address' => 'required',
        ]);

        $data = $request->all();

       $author->update($data);

        return redirect()->route('author.index')->with('success', 'Author berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $author = Author::find($id);
        $author->delete();

        return redirect()->route('author.index');
    }
}
