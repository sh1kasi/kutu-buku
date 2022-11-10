<?php

namespace App\Http\Controllers\Publisher;

use Illuminate\Http\Request;
use App\Models\Publisher\Publisher;
use App\Http\Controllers\Controller;

class PublisherController extends Controller
{
    public function index()
    {
        $publisher = Publisher::all();

        return view('Admin.Publisher.index', compact('publisher'));
    }

    public function create()
    {
        
        return view('Admin.Publisher.form');
    }

    public function store(Request $request)
    {

        // dd($request);

        $this->validate($request, [
            'name' => 'required|unique:publishers,name',
            'address' => 'required',
            'phone' => 'required'
        ]);

        $data = $request->all();

        // dd($data);

        Publisher::create($data);

        return redirect()->route('publisher.index')->with('message', 'Publisher berhasil ditambahkan!');
    
    }

    public function edit($id)
    {
        $publisher = Publisher::find($id);
        // dd($category);

        return view('Admin.Publisher.edit', compact('publisher'));
    }

    public function update(Request $request, $id)
    {    
        $publisher = Publisher::find($id);

        $this->validate($request, [
            'name' => 'required',
            'address' => 'required',
            'phone' => 'required'
        ]);

        $data = $request->all();

       $publisher->update($data);

        return redirect()->route('publisher.index')->with('message', 'Publisher berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $publisher = Publisher::find($id);
        $publisher->delete();

        return redirect()->route('publisher.index')->with('message', 'Publisher tersebut berhasil dihapus');
    }
}
