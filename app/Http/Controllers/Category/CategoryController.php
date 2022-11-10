<?php

namespace App\Http\Controllers\Category;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Category\Category;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    public function index()
    {

        $category = Category::orderBy('name')->get();

        return view('Admin.Category.index', compact('category'));
    }

    public function create()
    {

        return view('Admin.Category.form');
    }

    public function store(Request $request)
    {

        $this->validate($request, [
            'name' => 'required'
        ]);

        $data = $request->only('name');
        $data['slug'] = Str::slug($request->name);

        Category::create($data);

        return redirect()->route('category.index')->with('message', 'Kategori berhasil ditambahkan!');
    
    }

    public function edit($id)
    {
        $category = Category::find($id);
        // dd($category);

        return view('Admin.Category.edit', compact('category'));
    }

    public function update(Request $request, $id)
    {    

        $category = Category::find($id);

        $this->validate($request, [
            'name' => 'required'
        ]);

        $data = $request->only('name');
        $data['slug'] = Str::slug($request->name);

       $category->update($data);

        return redirect()->route('category.index')->with('message', 'Kategori berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $category = Category::find($id);
        $category->delete();

        return redirect()->route('category.index')->with('message', 'Kategori tersebut berhasil dihapus');
    }

        
}
