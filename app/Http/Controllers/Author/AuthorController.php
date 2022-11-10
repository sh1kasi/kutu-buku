<?php

namespace App\Http\Controllers\Author;

use Illuminate\Http\Request;
use App\Models\Author\Author;
use App\Http\Controllers\Controller;

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

        $data = $request->all();

        // dd($data);

        Author::create($data);

        return redirect()->route('author.index')->with('message', 'Author berhasil ditambahkan!');
    
    }

    public function edit($id)
    {
        $author = Author::find($id);
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

        return redirect()->route('author.index')->with('message', 'Author berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $author = Author::find($id);
        $author->delete();

        return redirect()->route('publisher.index')->with('message', 'Author tersebut berhasil dihapus');
    }
}
