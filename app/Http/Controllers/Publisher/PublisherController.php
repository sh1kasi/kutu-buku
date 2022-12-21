<?php

namespace App\Http\Controllers\Publisher;

use Illuminate\Http\Request;
use App\Models\Author\Author;
use App\Models\Publisher\Publisher;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class PublisherController extends Controller
{
    public function index()
    {
        $connect = Publisher::with('books')->get();

        // dd($connect);

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

        return redirect()->route('publisher.index')->with('success', 'Publisher berhasil ditambahkan!');
    
    }

    public function modalStore(Request $request) {
        // dd($request);    

      $validator = Validator::make($request->all(), [
            'name_publisher' => 'required',
            'address_publisher' => 'required',
            'phone' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status'=>400,
                'errors'=>$validator->messages(),
            ]);
        } else {
            $publisher = new Publisher;
            $publisher->name = $request->name_publisher;
            $publisher->address = $request->address_publisher;
            $publisher->phone = $request->phone;
            $publisher->save();
            return response()->json([
                'status'=>200,
                'message'=>'Publisher Berhasil Ditambahkan',
                'data'=>$publisher,
            ]);
        }


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

        return redirect()->route('publisher.index')->with('success', 'Publisher berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $publisher = Publisher::find($id);
        $publisher->delete();

        return redirect()->route('publisher.index');
    }
}
