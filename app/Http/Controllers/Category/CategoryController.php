<?php

namespace App\Http\Controllers\Category;

use App\Models\Book\Book;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Pivot\Bookcate;
use App\Models\Category\Category;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    public function index()
    {

        $category = Category::get();

        $book = Book::get();
        

        return view('Admin.Category.index', compact('category', 'book'));
    }

    public function create()
    {

        return view('Admin.Category.form');
    }

    public function store(Request $request)
    {
        // dd($request);

        $this->validate($request, [
            'name' => 'required'
        ]);

        $data = $request->only('name');
        $data['slug'] = Str::slug($request->name);

        Category::create($data);

        return redirect()->route('category.index')->with('success', 'Kategori berhasil ditambahkan!');
    
    }

    public function modalStore(Request $request) {
        // dd($request);    

      $validator = Validator::make($request->all(), [
            'name' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status'=>400,
                'errors'=>$validator->messages(),
            ]);
        } else {
            $category = new Category;
            $category->name = $request->name;
            $category->slug = Str::slug($request->name);
            $category->save();
            return response()->json([
                'status'=>200,
                'message'=>'Kategori Berhasil Ditambahkan',
                'data'=>$category,
            ]);
        }


    }

    public function edit($id)
    {
        $category = Category::find($id);
        // dd($category);

        // $pivot = Bookcate::where('category_id', $id)->get();

        // dd($pivot->count());

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

        return redirect()->route('category.index')->with('success', 'Kategori berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $category = Category::find($id);
        $category->delete();

        return redirect()->route('category.index');
    }

        
}
